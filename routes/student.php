<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminProcessController;
use App\Http\Controllers\LoginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




//student

Route::get('/student/subject/{id}', [StudentController::class, 'getSubjectCountForStudent']);

Route::post('/sendemail', [StudentController::class, 'sendEmail']);
Route::post('/loginCode', [StudentController::class, 'loginWithCode']);
Route::middleware('auth:sanctum')->name('student')->group(function () {
  Route::get('/student/profile', [StudentController::class, 'getProfile']);
  Route::get('/student/schedule', [StudentController::class, 'getSchedule']);
  Route::get('/subjects/books', [StudentController::class, 'studentBooks']);
  Route::get('/student/books-by-subject', [StudentController::class, 'studentBooksBySubject']);
  Route::post('/search/books', [StudentController::class, 'studentBooksByTitle']);
  Route::get('/student/contents', [StudentController::class, 'index']);
  Route::get('/student/type', [StudentController::class, 'indexEduction']);
  Route::get('/student/subject', [StudentController::class, 'getStudentSubjects']);
  Route::get('/student/subject/{id}', [StudentController::class, 'getSubjectsForClass']);
  Route::get('/student/teacher', [StudentController::class, 'studentSubjectsWithTeacher']);
  Route::get('/dashBord', [StudentController::class, 'dashboard']);
  Route::post('/homework/submit', [StudentController::class, 'submit']);
  Route::get('/student/marks', [StudentController::class, 'getMyMarks']);
  Route::get('/student/books/purchased', [StudentController::class, 'getPurchasedBooks']);
  Route::get('/student/books/borrowed', [StudentController::class, 'getBorrowedBooks']);
  Route::get('/student/upcoming-tasks', [StudentController::class, 'upcomingTasks']);

  Route::get('/student/Absence', [StudentController::class, 'getAbsenceSummary']);
  Route::get('/student/achievements', [StudentController::class, 'getAchievements']);

  Route::get('/student/submissions-activities', [StudentController::class, 'submittedHomeworksAndActivities']);
});
