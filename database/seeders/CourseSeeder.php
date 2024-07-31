<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run()
    {
        DB::table('courses')->insert([
            [
                'CourseName' => 'Introduction to Laravel',
                'AuthorName' => 'John Doe',
                'description' => 'A beginner-friendly course on Laravel.',
                'price' => 99.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'CourseName' => 'Advanced Laravel Techniques',
                'AuthorName' => 'Jane Smith',
                'description' => 'A deep dive into advanced Laravel features.',
                'price' => 149.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more courses as needed
        ]);
    }
}
