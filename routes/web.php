
<?php

use Illuminate\Support\Facades\Broadcast;
use  Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CelebrityController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LoginController;
use App\Models\Student;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login' , function (){return view('login');})->name('login.index');


Route::post('/login', [LoginController::class, 'CheckStudent'])->name('login.check');

Route::get('/students', function () {
    $userId = session('user_id');
    $user = Student::find($userId); // Assuming you have a Student model

    return view('students', ['user' => $user]);
})->name('students.index');


////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/admin', [StudentController::class, 'index'])->name('admin.index');

Route::get('/admin/create', [StudentController::class, 'create'])->name('admin.create');

Route::post('/admin', [StudentController::class, 'store'])->name('admin.store');

Route::get('/admin/{student}', [StudentController::class, 'show'])->name('admin.show');

Route::get('/admin/{student}/edit', [StudentController::class, 'edit'])->name('admin.edit');

Route::put('/admin/{student}', [StudentController::class, 'update'])->name('admin.update');

Route::delete('/admin/{student}', [StudentController::class, 'destroy'])->name('admin.destroy');

////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('languageConverter/{locale}', function($locale) {
    if(in_array($locale , ['ar', 'en'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('languageConverter');


////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::post('/students/upload-image', 'App\Http\Controllers\StudentController@uploadImage')->name('students.uploadImage');

Route::get('/course' , [CourseController::class,'index'])->name('course.index');

Route::get('/lesson/{course_id}' , [LessonController::class,'index'])->name('lesson.index') ;



///////////////////////////////////////////////////////////////////////////////////////////////////////


Route::post('/send-notification', [NotificationController::class, 'sendNotification'])->name('send.notification');

Route::get('/websocket' , function (){return view('websocket');});
Broadcast::routes();
