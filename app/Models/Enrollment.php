<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'enrollments';
    protected $fillable = [
        'student_id',
        'course_code',
    ];

    //functions to indicate one to many relationship between other models and enrollments
    public function course(){
        return $this->belongsTo('App\Models\Course');
    }

    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }

    public function scores(){
        return $this->hasMany('App\Models\Score');
    }

}
