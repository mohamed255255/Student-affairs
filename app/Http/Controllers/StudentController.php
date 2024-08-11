<?php
namespace App\Http\Controllers;
use App\Mail\VerificationEmail;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyEmail;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller{

    public function index(){
        return view('admin.index');
    }

    public function GetStudentData(){
        $data = Student::latest()->paginate(5);
        return view('admin.studentCRUD', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function create(){
        return view('admin.create');
    }


    public function store(Request $request){
        $request->validate([
            'student_name'          =>  'required',
            'student_birthdate'     =>  'required',
            'student_phone'         =>  ['required', 'regex:/^01[0-9]{9}$/'],
            'student_address'       =>  'required',
            'student_username'      =>  'required|unique:students',
            'student_email'         =>  'required|email|unique:students',
            'student_password'      => [
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

//        $message = 'THAT IS DIABOLICAL';
//        $subject = "OPEN ME HUGHIE";
//        Mail::to($student->student_email)->send(new VerificationEmail($message , $subject));

        return redirect()->route('students.index')->with('success', trans('public.added'));
    }


    public function show(Student $student){
        return view('admin.show', compact('student'));
    }



    public function edit(Student $student){
        return view('admin.edit', compact('student'));
    }


    public function update(Request $request, Student $student){
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

                $student->update([
                    'student_name' => $request->student_name,
                    'student_email' => $request->student_email,
                    'student_username' => $request->student_username,
                    'student_phone' => $request->student_phone,
                    'student_address' => $request->student_address,
                ]);

                if ($request->hasFile('student_image')) {
                    $image = $request->file('student_image');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $imageName);
                    $student->update(['student_image' => $imageName]);
                }



                if ($request->filled('new_password')) {

                    if (!Hash::check($request->old_password, $student->student_password)) {
                        return redirect()->back()->with('error', 'Old password is incorrect.');
                    }
                    $student->update(['password' => Hash::make($request->new_password)]);
                }

                return redirect()->route('students.index')->with('success', trans('public.updated'));
    }


    public function destroy(Student $student){
        $student->delete();
        return redirect()->route('admin.index')->with('success', trans('public.deleted'));
    }


    public function uploadImage(Request $request){
        if ($request->hasFile('student_image')) {
            $image = $request->file('student_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            return response()->json(['filename' => $filename]);
        }
    }


}

