<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Group_MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('group_members')->truncate();
        DB::table('group_members')->insert([
            [
                'student_id' => '1',
                'group_id' => '22',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '2',
                'group_id' => '22',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '3',
                'group_id' => '22',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '4',
                'group_id' => '23',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '5',
                'group_id' => '23',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '6',
                'group_id' => '23',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '9',
                'group_id' => '24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '1',
                'group_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '4',
                'group_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '9',
                'group_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '2',
                'group_id' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '4',
                'group_id' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '3',
                'group_id' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
