<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $fillable = [
        'text',
        'assessment_id',
        'reviewer_id',
        'reviewee_id',
        'review_rate',
    ];

    protected function casts(): array
    {
        return [
            'review_rate' => 'integer',
        ];
    }

    // functions to indicate one to many relationship between reviews and other models
    public function reviewer(){
        return $this->belongsTo('App\Models\User', 'reviewer_id');
    }

    public function reviewee(){
        return $this->belongsTo('App\Models\User', 'reviewee_id');
    }

    public function assessments(){
        return $this->belongsTo('App\Models\Assessment');
    }
}
