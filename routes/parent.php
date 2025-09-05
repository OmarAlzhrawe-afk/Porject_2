<?php

use App\Http\Controllers\ParentProcessController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherControllers\TeacherProcessController;

Route::prefix('/parent/process')->name('parent.process')->middleware(['auth:sanctum', 'role:parent'])->group(function () {
    // Route::prefix('/process')->name('process.')->middleware(['auth:sanctum', 'role:librarian'])->group(function () {
    Route::get('Show_installment_for_my_students', [ParentProcessController::class, 'Show_installment_for_my_students']);
    Route::get('Show_attendance_for_my_students', [ParentProcessController::class, 'Show_attendance_for_my_students']);
    Route::get('Show_marks_for_my_students', [ParentProcessController::class, 'Show_marks_for_my_students']);
    Route::get('/log_out', [ParentProcessController::class, 'logout']);

    // Notifications Process 
    Route::get('/notifications', [ParentProcessController::class, 'notificationss']);
    Route::get('/notifications/read/{id}', [ParentProcessController::class, 'markAsReads']);
    // });
});
// 6