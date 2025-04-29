<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $table = 'assessment_score';
    protected $fillable = [
        'score',
    ];

    //functions to indicate one to many relationship between other models and assessment_score
    public function enrollment(){
        return $this->belongsTo('App\Models\Enrollment');
    }

    public function assessment(){
        return $this->belongsTo('App\Models\Assessment');
    }
}
