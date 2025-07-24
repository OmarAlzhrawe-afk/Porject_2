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
        // Notification for All Student who are related for Activity Done
        Route::post('/Add_Activity', [SupervisorProcessesController::class, 'Add_Activity']); // Send Notification To Students
        Route::post('/Add_student_profile_data', [SupervisorProcessesController::class, 'Add_student_profile_data']);
        // Notification for All parent that there children is abscence today Done 
        Route::post('/Add_daily_student_absences', [SupervisorProcessesController::class, 'Add_daily_student_absences']);
        Route::get('/Show_Reports_For_Students', [SupervisorProcessesController::class, 'Show_Reports_For_Students']);
        Route::post('/Verify_Qr_Code', [SupervisorProcessesController::class, 'Verify_Qr_Code']);
        // Notifications Process 
        Route::get('/notifications', [SupervisorProcessesController::class, 'notifications']);
        Route::get('/notifications/read/{id}', [SupervisorProcessesController::class, 'markAsRead']);
        Route::post('/SendSpecificNotificationForUser', [SupervisorProcessesController::class, 'SendSpecificNotificationForUser']);
    });
});
