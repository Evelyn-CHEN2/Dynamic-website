<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //DB::table('assessments')->truncate();
        DB::table('assessments')->insert([
            [
                'title' => 'Week1 Peer Review',
                'instruction' => 'The student can only review for the others in the same group, and the reviewee in the same group can click the right butto next to the review to rate it, from 0-5!',
                'require_number' => 20,
                'max_score' => 10,
                'due_dateTime' => '2024-10-15 23:59',
                'course_code' => '2703ICT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Week2 Peer Review',
                'instruction' => 'The student can only review for the others in the same group, and the reviewee in the same group can click the right butto next to the review to rate it, from 0-5!',
                'require_number' => 20,
                'max_score' => 10,
                'due_dateTime' => '2024-10-22 23:59',
                'course_code' => '2703ICT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Week3 Peer Review',
                'instruction' => 'The student can only review for the others in the same group, and the reviewee in the same group can click the right butto next to the review to rate it, from 0-5!',
                'require_number' => 20,
                'max_score' => 10,
                'due_dateTime' => '2024-10-29 23:59',
                'course_code' => '2703ICT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Week1 Pear Review',
                'instruction' => 'The student can only review for the others in the same group, and the reviewee in the same group can click the right butto next to the review to rate it, from 0-5!',
                'require_number' => 20,
                'max_score' => 10,
                'due_dateTime' => '2024-10-15 23:59',
                'course_code' => '2810ICT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Week2 Pear Review',
                'instruction' => 'The student can only review for the others in the same group, and the reviewee in the same group can click the right butto next to the review to rate it, from 0-5!',
                'require_number' => 20,
                'max_score' => 10,
                'due_dateTime' => '2024-10-15 23:59',
                'course_code' => '2810ICT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Week3 Peer Review',
                'instruction' => 'The student can only review for the others in the same group, and the reviewee in the same group can click the right butto next to the review to rate it, from 0-5!',
                'require_number' => 20,
                'max_score' => 10,
                'due_dateTime' => '2024-10-15 23:59',
                'course_code' => '2810ICT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
