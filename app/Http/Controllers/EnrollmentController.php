<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;

class EnrollmentController extends Controller
{
    public function enroll(Request $request)
    {
        $course = Course::find($request->course_id);
        $student = Student::find($request->student_id);

        if ($course && $student) {
            $student->courses()->syncWithoutDetaching($request->course_id);
            return response()->json(['message' => 'Courses are added successfully']);
        }

        return response()->json(['message' => 'Course or student not found'], 404);
    }
}
