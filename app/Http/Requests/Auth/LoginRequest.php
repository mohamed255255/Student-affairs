<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }


    public function authenticate(): void{
        // Rate limiter definition : Tracks the number of failed attempts and temporarily
        // locks users out after a certain number of failures,

        $this->ensureIsNotRateLimited();
        // prevents a user from making further login attempts
        // if they have exceeded the allowed number of failed attempts.

        $guard = $this->request->get('guard');

        if (!Auth::guard($guard)->attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }



    public function ensureIsNotRateLimited(): void{
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));
        // Calculate remaining lockout time
        $seconds = RateLimiter::availableIn($this->throttleKey());

        // ValidationException, preventing further login attempt
        // and show how long they need to wait before trying again
        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }


    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
        //{Generates a unique key}
        // to track number of failed attempts based on email/ip combination
    }
}
