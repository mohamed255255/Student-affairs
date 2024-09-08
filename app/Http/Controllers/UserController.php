<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getStudentData()
    {
        $data = User::latest()->paginate(5);  // Changed 'Student' to 'User'
        return view('studentCRUD', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'birthdate'     => 'required',
            'phone'         => ['required', 'regex:/^01[0-9]{9}$/'],
            'address'       => 'required',
            'username'      => 'required|unique:users',
            'email'         => 'required|email|unique:users',
            'password'      => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/'
            ],
            'image'         => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ], [
            'phone.regex'  => 'The phone number must be 11 digits (e.g., 01123456789).',
            'password.min' => 'The password must be at least :min characters.',
            'password.regex' => 'The password must contain at least 1 number and 1 special character (!@#$%^&*).',
        ]);

        $file_name = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $file_name);

        User::create([
            'name' => $request->name,
            'birthdate' => $request->birthdate,
            'phone' => $request->phone,
            'address' => $request->address,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $file_name
        ]);

        return redirect()->route('users.index')->with('success', trans('public.added'));
    }

    public function show(User $user)
    {
        return view('show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/01[0-9]{9}/',
            'address' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'old_password' => 'nullable|required_with:new_password',
            'new_password' => [
                'nullable',
                'min:8',
                'different:old_password',
                'confirmed',
                'regex:/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/'
            ]
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->update(['image' => $imageName]);
        }

        if ($request->filled('new_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with('error', 'Old password is incorrect.');
            }
            $user->update(['password' => Hash::make($request->new_password)]);
        }

        return redirect()->route('users.index')->with('success', trans('public.updated'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', trans('public.deleted'));
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            return response()->json(['filename' => $filename]);
        }
    }
}
