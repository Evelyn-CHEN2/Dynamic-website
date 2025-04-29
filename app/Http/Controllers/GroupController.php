<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Group_Member;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    // store the user to the group and show the group member names 
    public function joinGroup(Request $request)
    {
        $user = Auth::user();
        $group = Group::find($request->group_id);
        $assessment_id = $group->assessment_id;
        $member_number = $group->students()->count();
        if ($member_number >=4){
            return redirect()->back()->with('group-error', 'The '.$group->group_name.' already has 4 members, please choose another group!');
        }
        // check the current group and group_type for user within this assessment
        $current_group = $user->groups()->where('assessment_id',$assessment_id)->first();
        if($current_group && $current_group->group_type == 'student_select'){
            $current_group->students()->detach($user->id);
            $group->students()->attach($user->id);
        }elseif($current_group && $current_group->group_type == 'teacher_assign'){
            return back()->with('group_change-error', 'You are not allowed to change group!');
        }
        return redirect("assessment/{$group->assessment_id}")->with('group-success', 'You have joined the '.$group->group_name.' sucessfully!');
    }

    public function assignStudent(Request $request)
    {
        $student_name = $request->input('student_name');
        $student_number = $request->input('student_number');
        $student = User::where('name', $student_name)
                       ->where('s_number', $student_number)
                       ->first();
        $course_code = $request->input('course_code');
        // Check if the student exists and enrolled in this course
        if (!$student) {
            return redirect()->back()->with('assign-error', 'Student '.$student_name.' not found');
        }
        //check if student enrolled in this course
        $enrollment = Enrollment::where('student_id', $student->id)
                                ->where('course_code', $course_code)
                                ->first();
        if(!$enrollment){
            return redirect()->back()->with('assign-error', 'Student '.$student_name.' not enrolled in this course!');
        }
        //check if the student is already in this group
        $group_id = $request->input('group_id');
        $group_member = Group_Member::where('student_id', $student->id)
                                    ->where('group_id', $group_id)
                                    ->first();
        if ($group_member){
            return redirect()->back()->with('assign-error', 'Student '.$student->name. ' has already in this group!');
        }else{
            //create a new group_member (assign the student in the group)
            $group_member = New Group_Member();
            $group_member->student_id = $student->id;
            $group_member->group_id = $group_id;
            $group_member->save();
            //update the group_type to be 'teacher_assign'
            $group = Group::find($group_id);
            $group->group_type = 'teacher_assign';
            $group->save();
            return redirect()->back()->with('assign-success', 'Student ' . $student->name . ' assigned to the group successfully!');
        }
        
    }

}
