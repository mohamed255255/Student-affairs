<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth:admin', 'verified'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');})->name('dashboard');

        Route::post('/send-notification', [NotificationController::class, 'sendNotification'])
            ->name('send.notification');

        Route::get('/websocket' , function (){return view('websocket');});


    });


//Broadcast::routes();  put it inside  web socket url
