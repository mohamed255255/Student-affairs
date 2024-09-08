<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

    public function create(): View{
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse{
        $request->authenticate(); // Authenticates the user based on some logic

        //  Regenerates the session to prevent attackers from hijacking the session.
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }


    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();  /// Logs out the authenticated user

        $request->session()->invalidate(); // Invalidates the session to prevent further use

        $request->session()->regenerateToken();// Generates a new CSRF token for the next session

        return redirect('/'); //// welcome page
    }
}
