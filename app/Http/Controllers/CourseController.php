<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Assessment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if($user->user_type == 'student')
        {
            $courses = $user->enrolledCourses;
        }elseif($user->user_type == 'teacher')
        {
            $courses = $user->taughtCourses;
        }
        return view('home')->with('courses', $courses);
    }

    // retrieves the course by course_code and pass value to the course_details page
    public function show(string $course_code)
    {
        $course = Course::find($course_code);
        $teachers = $course->teachers;
        $assessments = $course->assessments;
        return view('course_details')->with('course',$course)->with('teachers',$teachers)->with('assessments', $assessments);
    }

}
