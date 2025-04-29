<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //DB::table('groups')->truncate();
        DB::table('groups')->insert([
            [
                'group_name' => 'A',
                'group_type' => 'student_select',
                'assessment_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'B',
                'group_type' => 'student_select',
                'assessment_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'C',
                'group_type' => 'student_select',
                'assessment_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'A',
                'group_type' => 'student_select',
                'assessment_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'B',
                'group_type' => 'student_select',
                'assessment_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'C',
                'group_type' => 'student_select',
                'assessment_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'A',
                'group_type' => 'student_select',
                'assessment_id' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'B',
                'group_type' => 'student_select',
                'assessment_id' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'C',
                'group_type' => 'student_select',
                'assessment_id' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'A',
                'group_type' => 'student_select',
                'assessment_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'B',
                'group_type' => 'student_select',
                'assessment_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'C',
                'group_type' => 'student_select',
                'assessment_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'A',
                'group_type' => 'student_select',
                'assessment_id' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'B',
                'group_type' => 'student_select',
                'assessment_id' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'C',
                'group_type' => 'student_select',
                'assessment_id' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'A',
                'group_type' => 'student_select',
                'assessment_id' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'B',
                'group_type' => 'student_select',
                'assessment_id' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_name' => 'C',
                'group_type' => 'student_select',
                'assessment_id' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
