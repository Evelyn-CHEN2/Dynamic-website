<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\User;

class EnrollmentController extends Controller
{
    public function enrollStudent(Request $request)
    {
        $student_id = $request->input('student_id');
        $student = User::find($student_id);
        $course_code = $request->input('course_code');
        //check if the student is registered 
        if ($student->is_registered){
            $enrollment = new Enrollment();
            $enrollment->student_id = $student_id;
            $enrollment->course_code = $course_code;
            $enrollment->save();
            return back()->with('enroll-success', $student->name.' successfully enrolled!');
        }else{
            return back()->with('enroll-alert', $student->name.' is not registered yet!');
        }
    }  
}
