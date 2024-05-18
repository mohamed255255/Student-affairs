<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyEmail;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Student::latest()->paginate(5);

        return view('index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_name'          =>  'required',
            'student_birthdate'     =>  'required',
            'student_phone'         =>  ['required', 'regex:/^01[0-9]{9}$/'],
            'student_address'       =>  'required',
            'student_username'      =>  'required|unique:students',
            'student_email'         =>  'required|email|unique:students',
            'student_password'       => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/'
            ],'student_image'         =>  'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ], [
            'student_phone.regex'  => 'The phone number must be 11 digits (e.g., 01123456789).',
            'student_password.min' => 'The password must be at least :min characters.',
            'student_password.regex' => 'The password must contain at least 1 number and 1 special character (!@#$%^&*).',
        ]);

        $file_name = time() . '.' . request()->student_image->getClientOriginalExtension();

        request()->student_image->move(public_path('images'), $file_name);


        $student = new Student();
        $student->student_name = $request->student_name;
        $student->student_email = $request->student_email;
        $student->student_phone = $request->student_phone;
        $student->student_birthdate = $request->student_birthdate;
        $student->student_address = $request->student_address;
        $student->student_username = $request->student_username;
        $student->student_password = Hash::make($request->student_password); // Encrypt the password
        $student->student_image = $file_name;

        $student->save();

        $this->sendNewUserRegisteredEmail($student->student_name, $student->student_email);
        return redirect()->route('students.index')->with('success', trans('public.added'));
    }


    /**
     * Send new user registered email notification.
     *
     * @param string $name
     * @param string $email
     * @return void
     */
    public function sendNewUserRegisteredEmail(string $name, string $email)
    {
        // Prepare and send the email
        Mail::to("fcailavarelsendemail@gmail.com")->send(new MyEmail($name));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_name' => 'required',
            'student_email' => 'required|email',
            'student_username' => 'required',
            'student_phone' => 'required|regex:/01[0-9]{9}/', // Validate Egyptian phone number format
            'student_address' => 'required',
            'student_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'old_password' => 'nullable|required_with:new_password',
            'new_password' => [
                'nullable',
                'min:8',
                'different:old_password',
                'confirmed',
                'regex:/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/'
            ],
        ]);

        // Update student details
        $student->update([
            'student_name' => $request->student_name,
            'student_email' => $request->student_email,
            'student_username' => $request->student_username,
            'student_phone' => $request->student_phone,
            'student_address' => $request->student_address,
        ]);

        // Handle image upload if a new image is provided
        if ($request->hasFile('student_image')) {
            $image = $request->file('student_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $student->update(['student_image' => $imageName]);
        }



        // Check and update password if provided
        if ($request->filled('new_password')) {
            // Check if old password matches
            if (!Hash::check($request->old_password, $student->student_password)) {
                return redirect()->back()->with('error', 'Old password is incorrect.');
            }
            // Update password
            $student->update(['password' => Hash::make($request->new_password)]);
        }

        return redirect()->route('students.index')->with('success', trans('public.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', trans('public.deleted'));
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('student_image')) {
            $image = $request->file('student_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            return response()->json(['filename' => $filename]);
        }
    }
}

