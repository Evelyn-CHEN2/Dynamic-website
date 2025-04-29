<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function reviewerRates()
    {
        // Get users who are students and sort them by their already calculated avg_rate
        $sortedStudents = User::where('user_type', 'student')
                                ->orderByDesc('avg_rate')
                                ->take(5) // pick the top 5 students
                                ->get();
        return view('reviewer_rates_list')->with('sortedStudents',$sortedStudents);
    }

    public function allstudentsList()
    {
        $students = User::where('user_type', 'student')->paginate(10);
        return view('all_students_list')->with('students', $students);
    }
}
