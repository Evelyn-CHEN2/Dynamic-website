<?php

namespace App\Http\Controllers;
use App\Models\Score;
use App\Models\User;
use App\Models\Enrollment;

use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function create(Request $request)
    {
        $assessment_id = $request->input('assessment_id');
        $student_id = $request->input('student_id');
        $student = User::find($student_id);   //get $student to retrive reviews and reviewsReceived on assessment_score page
        $course_code = $request->input('course_code');
        //get enrollment for this student and course
        $enrollment = $student->enrollments()->where('course_code', $course_code)->first();
        return view('assessment_score')->with('student', $student)->with('assessment_id', $assessment_id)->with('enrollment_id', $enrollment->id);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'score' => 'required|min:1|max:100',
        ]);
        $student_name = $request->input('student_name'); 
        $enrollment_id = $request->input('enrollment_id');
        $assessment_id = $request->input('assessment_id');
        //check if the student within this assessemnt scored or not
        $existing_score = Score::where('enrollment_id', $enrollment_id)
                                ->where('assessment_id', $assessment_id)
                                ->first();
        if ($existing_score){
            return back()->with('score-alert', 'Score for '.$student_name.' has already been submitted!');
        }
        //if not scored, create a new score
        $score = new Score();
        $score->enrollment_id = $request->input('enrollment_id');
        $score->assessment_id = $request->input('assessment_id');
        $score->score = $request->score;
        $score->save();
        return redirect()->back()->with('score-success', 'Score submitted successfully!');
    }
}
