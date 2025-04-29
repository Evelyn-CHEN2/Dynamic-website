<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        's_number',
        'user_type',
        'avg_rate',
        'is_registered',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'avg_rate' => 'decimal:2',
            'is_registered' => 'boolean',
        ];
    }
    // functions to indicates one to many relationship between user and other models
    public function taughtCourses(){
        return $this->belongsToMany(Course::class, 'course_teacher', 'teacher_id', 'course_code');
    }

    public function enrolledCourses(){
        return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_code');
    }

    public function enrollments(){
        return $this->hasMany(Enrollment::class, 'student_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function reviewsReceived(){
        return $this->hasMany(Review::class, 'reviewee_id');
    }

    public function groups(){
        return $this->belongsToMany(Group::class, 'group_members', 'student_id','group_id');
    }
}
