<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Course;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{

    public function store(Request $request)
    {
        //validate the assessment 
        $validate = $request->validate([
            'title' => 'required|string|max:20',
            'instruction' => 'required|string',
            'require_number' => 'required|integer|min:1',
            'max_score' => 'required|integer|min:1|max:10',
            'due_dateTime' => 'required|date',
            'group_number' => 'required|integer|min:1',
        ]);
        // create a new assessment
        $assessment = new Assessment();
        $assessment->title = $request->title;
        $assessment->instruction = $request->instruction;
        $assessment->require_number = $request->require_number;
        $assessment->max_score = $request->max_score;
        $assessment->due_dateTime = $request->due_dateTime;
        $assessment->course_code = $request->course_code;
        $assessment->save();

        // create a number of groups related with the newly created assessment
        $group_number = $request->group_number;
        for ($i = 0; $i < $group_number; $i++) {
            $group = new Group();
            $group->group_name = chr(65 + $i);
            $group->assessment_id = $assessment->id;
            $group->save();
        }
        return redirect()->route('course.show', $assessment->course_code)->with('assessment-success' ,'Assessment created successfully!');
    }

    public function show(string $id)
    {
        $user = Auth::user();
        $assessment = Assessment::find($id);
        // get groups within this assessment along with students in those groups and reviews written by those students
        $groups = $assessment->groups()->with('students.reviews')->get();
        if (!$assessment) {
            return abort(404, 'Assessment not found');
        }
        $course_code = $assessment->course_code;
        $course = Course::find($course_code);
        // get students who are enrolled in this course and not enrolled in this course
        $enrolled_students = $course->students()->with(['reviews', 'reviewsReceived', 'enrollments'])->get();//get students enrolled in this course along with reviews submitted and received
        $allstudents = User::where('user_type', 'student')->get();
        $notenrolled_students = $allstudents->diff($enrolled_students);
        if ($user && $user->user_type == 'student')
            return view('assessment_details')->with('assessment', $assessment)->with('groups',$groups);
        else
            return view('course_students_list')->with('enrolled_students', $enrolled_students)->with('assessment_id', $assessment->id )->with('course_code', $course_code)->with('notenrolled_students', $notenrolled_students);  //only teacher can access to assessment marking page
    }      
    
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:20',
            'instruction' => 'required|string',
            'require_number' => 'required|integer|min:1',
            'max_score' => 'required|integer|min:1|max:100',
            'due_dateTime' => 'required|date',
            'group_number' => 'required|integer|min:1',
        ]);
        $newGroup_number = $request->input('group_number');
        $course_code = $request->input('course_code');
        $assessment = Assessment::find($id);
        //delete old groups in the assessment, add new groups with the input numbers
        $assessment->groups()->delete();
        $this->addGroups($assessment, $newGroup_number);
        //check if there's review submitted 
        $reviews = $assessment->reviews;
        if ($reviews->isEmpty()){
            $assessment->title = $request->title;
            $assessment->instruction = $request->instruction;
            $assessment->require_number = $request->require_number;
            $assessment->max_score = $request->max_score;
            $assessment->due_dateTime = $request->due_dateTime;
            $assessment->save();
            return redirect()->route('course.show', $assessment->course_code)->with('edit-success', 'Assessment updated successfully!');
        }else{
            return back()->with('edit-alert', 'There is review submitted, can not update this assessment!');
        }
    }

    //function to add groups into the assessment
    private function addGroups(Assessment $assessment, $group_number)
    {
        for ($i = 0; $i < $group_number; $i++) {
            $group = new Group();
            $group->group_name = chr(65 + $i);
            $group->assessment_id = $assessment->id;
            $group->save();
        }
    }
}
