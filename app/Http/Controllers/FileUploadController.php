<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Course;
use App\Models\User;
use App\Models\Assessment;

class FileUploadController extends Controller
{
    public function uploadFile(Request $request)
    {
        $validate = $request->validate([
            'file' => 'required|mimes:csv,txt,pdf|max:2048',
        ]);
        if($request->hasFile('file')){
            $file_path = request()->file('file')->store('files','public'); //store the file under 'public/files'
            //open the file
            $file = fopen(storage_path('app/public/' . $file_path), 'r');
            //skip headers
            fgetcsv($file);
            //retrieve data from the file
            while (($row = fgetcsv($file)) != false){
                $course_code = $row[0];
                $course_name = trim($row[1],'"');
                $course_content = trim($row[2],'"');
                $teachers = explode(',', trim($row[3],'"')); //trim "
                $assessments = explode(',', trim($row[4],'"'));
                $students = explode(',', trim($row[5],'"'));
                //store data to database
                $course = Course::where('course_code', $course_code)
                                ->first(); //check if the course_code exists
                if (!$course){
                    $course = Course::create(['course_code' => $course_code, 'course_name' => $course_name, 'course_content' => $course_content]);
                }
                //store related teachers, assessments and students
                //check if teacher already exists in database
                foreach ($teachers as $teacher_name){
                    $teacher = User::where('name', trim($teacher_name)) 
                                   ->where('user_type', 'teacher')
                                   ->first();
                    if($teacher){
                        $course->teachers()->attach($teacher->id);
                    }
                }
                //add assessments, title could be same
                foreach ($assessments as $assessment_title){
                    $assessment = new Assessment();
                    $assessment->fill(['title' => $assessment_title, 'course_code' => $course_code]);
                    $assessment->save();
                }
                //if student exist, add to course, if not, create a new student
                foreach ($students as $student_name){
                    $student = User::where('name', trim($student_name))
                                   ->first();
                    if ($student){
                        $course->students()->attach($student->id);
                    }else{
                        $student = User::create(['name' => $student_name, 'user_type' => 'student']);
                        $course->students()->attach($student->id);
                    }
                }
            }
            fclose($file);
            return back()->with('file-success', 'Filed uploaded successfully!');
        }
        return back()->with('file-alert', 'File not exists!');
    }
}
