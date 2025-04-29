<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'course_code' => '2703ICT',
                'course_name' => 'Web Application',
                'course_content' => 'Web applications interact with users, connecting to back-end databases and dynamically generating results to the browser through a web server. This course presents a systematic introduction to the development of dynamic, community-based, Web applications through the integration of HTML/CSS, with server-side scripting languages, database systems, modern web frameworks and other related technologies.',
            ],
            [
                'course_code' => '2810ICT',
                'course_name' => 'Software Technology',
                'course_content' => 'Organisations typically use many disparate technologies to achieve their business objectives. This course first gives an overview of low-level technologies such as programming with a focus on code reuse, scripting techniques and software configuration tools. This is followed by a practical presentation of software packages commonly used for handling data and producing reports and presentations.',
            ],
            [
                'course_code' => '2814ICT',
                'course_name' => 'Database Design',
                'course_content' => 'Information derived from data is important to the management, productivity and competitive advantage of an organisation. Data must be efficiently collected, organized, retrieved and managed to make it meaningful to the organisation. It is the role of the IT professional to develop, deploy, manage and integrate data and information systems to support the organisation. This course includes the organisation, modeling, transformation and presentation of data.',
            ],
            [
                'course_code' => '1803ICT',
                'course_name' => 'Information Systems',
                'course_content' => 'This course introduces aspiring IT professionals to two topic areas that are critical to your working life. First, we will help you to unravel the ways in which information underpins business and organisational activity. Second, you will explore ways in which information systems are now critically important for managing activities and relationships with customers and suppliers. ',
            ],
            [
                'course_code' => '1701ICT',
                'course_name' => 'Creative Coding',
                'course_content' => 'This course will cover concepts such as the drawing plane and drawing simple shapes, responding to user input, understanding physics required to produce simple simulations, applying filters to video and images in real-time, sound, and the third dimension. At the end of this course you will have a strong understanding of the fundamentals of coding as well as the ability to apply them to generative art, data visualisation, and interactive animations.',
            ],
            [
                'course_code' => '2807ICT',
                'course_name' => 'Programming Principles',
                'course_content' => 'Programming is a foundational skill for all computing disciplines. This course develops skills and concepts that are essential to good programming practice and problem solving. It covers fundamental programming concepts, event-driven programming, object-oriented programming, basic data structures, and algorithmic processes.',
            ],
        ]);
    }
}
