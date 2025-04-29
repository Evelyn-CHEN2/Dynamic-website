<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->call(AssessmentsTableSeeder::class);
        $this->call(Course_TeachersTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(EnrollmentsTableSeeder::class);
        $this->call(Group_MembersTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
