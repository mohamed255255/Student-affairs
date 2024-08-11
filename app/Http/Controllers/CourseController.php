<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
   public function index(){
       $courses = Course::all();
       return view('Course.index', ['courses' => $courses]);
   }

   public function create(Course $course){
         return view('Course.create' , compact('course'));
   }

   public function store(Request $request){
        $course = new Course();
        $course->fill($request->only([
            'CourseName',
            'DoctorName',
            'description',
            'pre-requisites',
            'max_students',
        ]));
       $course->save();
       return redirect()->route('course.index')->with('success', 'Course created successfully!');

   }
   public function  show(Course $course){
        return view('Course.show' , compact('course'));
   }

   public function edit(Course $course){
         return view('Course.edit' , compact('course'));
   }

    public function update(Request $request , Course $course){
        $course->update($request->only([
            'CourseName',
            'DoctorName',
            'description',
            'pre-requisites',
            'max_students',
        ]));
    }


    public function destroy(Course $course){
        $course->delete();
        return redirect()->route('Course.index')->with('success', trans('public.deleted'));
    }
}
