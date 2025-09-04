<?php

use App\Http\Controllers\StudentControllers\StudentController;
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

Route::prefix('/student')->name('student.')->group(function () {
  Route::prefix('/process')->name('process.')->middleware(['auth:sanctum', 'role:student'])->group(function () {
    Route::get('profile', [StudentController::class, 'getProfile']);
    Route::get('/schedule', [StudentController::class, 'getSchedule']); //
    Route::get('/contents', [StudentController::class, 'contents']); //
    Route::get('/get_text_books', [StudentController::class, 'get_text_books']); //
    Route::get('/getCulturalBooks', [StudentController::class, 'getCulturalBooks']); //
    // Route::get('/get_cultural_books', [StudentController::class, 'get_cultural_books']); //
    Route::get('/get_activities', [StudentController::class, 'get_activities']); //
    Route::post('/register_in_activity', [StudentController::class, 'register_in_activity']); // here creating Transaction after stripe process
    Route::get('/get_daily_homwork', [StudentController::class, 'get_daily_homwork']); // 
    Route::post('/solve_homwork', [StudentController::class, 'solve_homwork']); // 
    // Notifications Process 
    Route::get('/notifications', [StudentController::class, 'notifications']);
    Route::get('/notifications/read/{id}', [StudentController::class, 'markAsRead']);
    // Route::get('/student/books-by-subject', [StudentController::class, 'studentBooksBySubject']);
    // Route::post('/search/books', [StudentController::class, 'studentBooksByTitle']);
    // Route::get('/student/type', [StudentController::class, 'indexEduction']);
    // Route::get('/student/subject', [StudentController::class, 'getStudentSubjects']);
    // Route::get('/student/subject/{id}', [StudentController::class, 'getSubjectsForClass']);
    // Route::get('/student/teacher', [StudentController::class, 'studentSubjectsWithTeacher']);
    // Route::get('/dashBord', [StudentController::class, 'dashboard']);
    // Route::post('/homework/submit', [StudentController::class, 'submit']);
    // Route::get('/student/marks', [StudentController::class, 'getMyMarks']);
    // Route::get('/student/books/purchased', [StudentController::class, 'getPurchasedBooks']);
    // Route::get('/student/books/borrowed', [StudentController::class, 'getBorrowedBooks']);
    // Route::get('/student/upcoming-tasks', [StudentController::class, 'upcomingTasks']);

    // Route::get('/student/Absence', [StudentController::class, 'getAbsenceSummary']);
    // Route::get('/student/achievements', [StudentController::class, 'getAchievements']);

    // Route::get('/student/submissions-activities', [StudentController::class, 'submittedHomeworksAndActivities']);
  });
});
