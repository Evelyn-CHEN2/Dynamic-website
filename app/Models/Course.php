<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    protected $table = 'courses';
    protected $primaryKey = 'course_code'; // Set the primary key
    public $incrementing = false; // The primary key is not auto-incrementing
    protected $fillable = [
        'course_code',
        'course_name',
        'course_content',
    ];
    // functions to indicate one to many relationship between course and other models
    public function students(){
        return $this->belongsToMany(User::class, 'enrollments', 'course_code', 'student_id')->where('user_type', 'student');
    }

    public function teachers(){
        return $this->belongsToMany(User::class, 'course_teacher', 'course_code', 'teacher_id')->where('user_type', 'teacher');
    }

    public function enrollments(){
        return $this->hasMany(Enrollment::class);
    }

    public function assessments(){
        return $this->hasMany(Assessment::class, 'course_code', 'course_code');
    }
}
