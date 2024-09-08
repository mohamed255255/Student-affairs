<?php

use Illuminate\Support\Facades\Route;

Route::prefix('user')
    ->name('user.')
    ->middleware(['auth:user', 'verified'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');  // Both roles use the same dashboard view
        })->name('dashboard');




    });

