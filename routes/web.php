
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CelebrityController;


Route::get('/', function () {
    return view('welcome');
});


Route::resource('students', StudentController::class);

Route::post('/discover-celebrities', [CelebrityController::class, 'getCelebritiesByBirthdate'])->name('discover.celebrities');

Route::get('languageConverter/{locale}', function($locale) {
    if(in_array($locale , ['ar', 'en'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('languageConverter');


Route::post('/students/upload-image', 'App\Http\Controllers\StudentController@uploadImage')->name('students.uploadImage');


