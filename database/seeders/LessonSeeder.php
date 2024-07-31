<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    public function run()
    {
        DB::table('lessons')->insert([
            [
                'video_path' => 'path/to/intro_video.mp4',
                'course_id' => 1, // ID of the course this lesson belongs to
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'video_path' => 'path/to/advanced_tips.mp4',
                'course_id' => 2, // ID of the course this lesson belongs to
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more lessons as needed
        ]);
    }
}
