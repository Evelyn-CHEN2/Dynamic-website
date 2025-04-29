<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_Teacher extends Model
{
    use HasFactory;

    protected $table = 'course_teacher';
    protected $fillable = [
        'course_code',
        'teacher_id',
    ];

    //functions to indicate one to many relationship between other models and course_teacher
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function course(){
        return $this->belongsTo('App\Models\Course');
    }

}
