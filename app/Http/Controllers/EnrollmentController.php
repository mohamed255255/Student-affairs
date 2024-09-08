<?php
namespace App\Http\Controllers;
use App\Models\course;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function enroll(Request $request)
    {
        $course = course::find($request->course_id);
        $student = User::find($request->user_id);

        if ($course && $student) {
            $student->courses()->syncWithoutDetaching($request->course_id);
            return response()->json(['message' => 'Courses are added successfully']);
        }

        return response()->json(['message' => 'course or student not found'], 404);
    }
}
