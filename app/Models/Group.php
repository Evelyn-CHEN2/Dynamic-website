<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';
    protected $fillable = [
        'group_name',
        'assessment_id',
    ];

    // functions to indicate one to many relationship between groups and other models
    public function assessments(){
        return $this->belongsTo('App\Models\Assessment');
    }

    public function students(){
        return $this->belongsToMany(User::class, 'group_members', 'group_id', 'student_id');
    }
}
