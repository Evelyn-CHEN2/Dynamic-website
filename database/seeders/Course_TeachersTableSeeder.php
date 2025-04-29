<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Course_TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('course_teacher')->truncate();
        DB::table('course_teacher')->insert([
            [
                'teacher_id' => '16',
                'course_code' => '2703ICT',
            ],
            [
                'teacher_id' => '17',
                'course_code' => '2703ICT',
            ],
            [
                'teacher_id' => '16',
                'course_code' => '2810ICT',
            ],
            [
                'teacher_id' => '17',
                'course_code' => '2810ICT',
            ],
            [
                'teacher_id' => '18',
                'course_code' => '2814ICT',
            ],
            [
                'teacher_id' => '19',
                'course_code' => '2814ICT',
            ],
            [
                'teacher_id' => '18',
                'course_code' => '1803ICT',
            ],
            [
                'teacher_id' => '19',
                'course_code' => '1803ICT',
            ],
            [
                'teacher_id' => '20',
                'course_code' => '1701ICT',
            ],
            [
                'teacher_id' => '21',
                'course_code' => '1701ICT',
            ],
            [
                'teacher_id' => '20',
                'course_code' => '2807ICT',
            ],
            [
                'teacher_id' => '21',
                'course_code' => '2807ICT',
            ],

        ]);
    }
}
