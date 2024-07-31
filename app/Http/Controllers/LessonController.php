<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index($course_id)
    {
        // Fetch lessons related to the selected course
        $lessons = Lesson::where('course_id', $course_id)->get();
        return view('lesson.index', ['lessons' => $lessons]);
    }
}
