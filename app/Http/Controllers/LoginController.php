<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    public function CheckStudent(Request $request)
    {
        $student = Student::find($request->id);
        if (!$student) {
            return redirect()->back()->withErrors(['error' => 'Student not found.']);
        }else {
            session(['user_id' => $student->id]);
            return redirect()->route('students.index')->with('success', 'Login successful!');
        }
    }
}
