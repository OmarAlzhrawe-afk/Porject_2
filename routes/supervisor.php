<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupervisorControllers\SupervisorAuth;
use App\Http\Controllers\SupervisorControllers\SupervisorProcessesController;

Route::prefix('/supervisor')->name('supervisor.')->group(function () {
    // Login Supervisor
    Route::post('/send_passcode', [SupervisorAuth::class, 'send_passcode']);
    Route::post('/verify_passcode', [SupervisorAuth::class, 'verify_passcode']);
    Route::prefix('/process')->middleware(['auth:sanctum', 'role:supervisor'])->group(function () {
        Route::post('/log_out', [SupervisorAuth::class, 'logout']);
        Route::post('/Add_Activity', [SupervisorProcessesController::class, 'Add_Activity']); // Send Notification To Students
        Route::post('/Add_student_profile_data', [SupervisorProcessesController::class, 'Add_student_profile_data']);
        Route::post('/Add_daily_student_absences', [SupervisorProcessesController::class, 'Add_daily_student_absences']);
        Route::get('/Show_Reports_For_Students', [SupervisorProcessesController::class, 'Show_Reports_For_Students']);
    });
});
