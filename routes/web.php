
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CelebrityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('students', StudentController::class);

Route::post('/discover-celebrities', [CelebrityController::class, 'getCelebritiesByBirthdate'])->name('discover.celebrities');


// Example route to handle language selection
Route::get("locale/{lang}",[\App\Http\Controllers\LocalizationController::class , 'setLang']);

Route::get('languageConverter/{locale}', function($locale) {
    if(in_array($locale , ['ar', 'en'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('languageConverter');
