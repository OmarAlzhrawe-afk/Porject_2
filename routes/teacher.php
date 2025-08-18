<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherControllers\TeacherProcessController;

Route::prefix('/teacher/process')->name('teacher.process')->middleware(['auth:sanctum', 'role:teacher'])->group(function () {
    Route::post('/verify_attendance_for_session', [TeacherProcessController::class, 'verify_attendance_for_session']);
    Route::get('/get_my_student', [TeacherProcessController::class, 'get_my_student']);
    Route::get('/surfing_available_activity', [TeacherProcessController::class, 'surfing_available_activity']);
    Route::post('/register_in_activity', [TeacherProcessController::class, 'register_in_activity']);
    Route::post('/confirm_payment_register_in_avtivity', [TeacherProcessController::class, 'confirm_payment_register_in_avtivity']);
    Route::get('/surfing_salary', [TeacherProcessController::class, 'surfing_salary']);
    Route::get('/view_schedul_table', [TeacherProcessController::class, 'view_schedul_table']);
    Route::post('/enter_education_content', [TeacherProcessController::class, 'enter_education_content']);
    //  WE will add dont add mark if it exist in same type and same year
    Route::post('/enter_marks', [TeacherProcessController::class, 'enter_marks']);
    // we will test add nots for more than one teacher 
    Route::post('/add_nots_for_student', [TeacherProcessController::class, 'add_nots_for_student']);
    Route::post('/add_homework', [TeacherProcessController::class, 'add_homework']);
    // Here we will add prevent to add more tahn one demand in same date or prevent conflicts for leaves demand in date     
    Route::post('/leave_demand', [TeacherProcessController::class, 'leave_demand']);
    // Here We wil add correct solution And pass Notification to student for it & edit solving table for that 
    Route::get('/view_home_work_solution', [TeacherProcessController::class, 'view_home_work_solution']);
    Route::get('/get_last_activity', [TeacherProcessController::class, 'get_last_activity']);
});
