<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\admins;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{


    public function create(): View
    {
        return view('auth.register');
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'unique:admins,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

      $data = [
          'name' => $request->name ,
          'email' =>$request->email,
          'password'=>Hash::make($request->password),
      ];

      $user = null ;
      if($request->get('guard') === 'user'){
          $user = User::create($data);
      }
      if($request->get('guard') === 'admin'){
          $user = admins::create($data);
      }
        event(new Registered($user));

        Auth::login($user);  /// Creating a session for the user

        return redirect(RouteServiceProvider::HOME);
    }
}
