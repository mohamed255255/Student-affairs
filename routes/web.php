<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth:user,admin')->group(function () {
    Route::get   ('/profile', [ProfileController::class, 'edit'])   ->name('profile.edit')   ;
    Route::patch ('/profile', [ProfileController::class, 'update']) ->name('profile.update') ;
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/dashboard' , function (){
     if(auth()->guard('user')->check()){
         return Redirect::route('user.dashboard');
     }
     else if(auth()->guard('admin')->check()){
         return Redirect::route('admin.dashboard');
     }
})->middleware(['auth:user,admin'])
->name('dashboard');




Route::get('languageConverter/{locale}', function($locale) {
    if(in_array($locale , ['ar', 'en'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('languageConverter');





require __DIR__.'/auth.php';
require __DIR__.'/user.php';
require __DIR__.'/admin.php';
