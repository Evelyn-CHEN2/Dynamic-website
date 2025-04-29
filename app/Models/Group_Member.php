<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_Member extends Model
{
    use HasFactory;

    protected $table = 'group_members';
    protected $fillable = [
        'group_id',
        'student_id',
    ];

    // functions to indicate one to many relationship between group_members and other models
    public function group(){
        return $this->belongsTo('App\Models\Group');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
