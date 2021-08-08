<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentResponseController;
use App\Http\Controllers\StudentVerificationController;
use App\Http\Controllers\ResultController;
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
    return view('auth.login');
});


Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('questions', QuestionController::class);

    Route::resource('courses', CourseController::class);

    Route::get('students/create',[StudentController::class,'create'])->name('create');
    Route::get('students/{user}',[StudentController::class,'show'])->name('show-result');
    Route::delete('students/{user}',[StudentController::class, 'destroy'])->name('invite.destroy');
    Route::resource('students', StudentController::class);

    Route::get('student-responses/{course}', [StudentResponseController::class, 'show'])->name('show');
    Route::resource('student-responses', StudentResponseController::class);

    Route::get('/show-result', [StudentResponseController::class,'showResult'])->name('result');

    Route::get('/verify/{token}', [StudentVerificationController::class, 'studentVerification'])->name('token');

    Route::get('/export/result',[StudentController::class, 'export'])->name('export');
});
