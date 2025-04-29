<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $table = 'assessments';
    protected $fillable = [
        'title',
        'instruction',
        'require_number',
        'max_score',
        'due_dateTime',
        'course_code',
    ];

    // functions to indicate one to many relationship between assessments and other models
    public function reviews(){
        return $this->hasMany('App\Models\Review');
    }

    public function groups(){
        return $this->hasMany('App\Models\Group');
    }

    public function courses(){
        return $this->belongsTo('App\Models\Course', 'course_code', 'course_code');
    }

    public function scores(){
        return $this->hasMany('App\Models\Score');
    }
}
