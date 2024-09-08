<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        $courses = course::paginate(20);
        return view('course.index', ['courses' => $courses]);
    }

    public function create(course $course){
        return view('course.create', compact('course'));
    }

    public function store(Request $request){
        course::create($request->only([
            'CourseName',
            'DoctorName',
            'description',
            'pre_requisites',
            'max_students',
        ]));
        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    public function show(course $course){
        return view('course.show', compact('course'));
    }

    public function edit(course $course){
        return view('course.edit', compact('course'));
    }

    public function update(Request $request, course $course){
        $course->update($request->only([
            'CourseName',
            'DoctorName',
            'description',
            'pre_requisites',
            'max_students',
        ]));
        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    public function destroy(course $course){
        $course->delete();
        return redirect()->route('courses.index')->with('success', trans('public.deleted'));
    }
}
