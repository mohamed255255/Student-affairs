<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{

    public function create(): View
    {
        return view('auth.forgot-password');
    }


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $brokers = ['users' , 'admins'];

        foreach($brokers as $broker){
           $status = password::broker($broker)->sendResetLink($request->only('email'));
           if($status == Password::RESET_LINK_SENT )
               break;
        }

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
