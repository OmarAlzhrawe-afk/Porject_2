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
        // api for last activity for supervisor 
        Route::get('/get_last_activity', [SupervisorProcessesController::class, 'get_last_activity']);
        // Api For get my Education Levell Data Make Method In helper it exist same method with admin apis *****
        Route::get('/get_Education_level', [SupervisorProcessesController::class, 'get_Education_level']);
        // Api For get all activities that supervisor add it 
        Route::get('/get_activities', [SupervisorProcessesController::class, 'get_activities']);
        // Get all Installment For my students 
        Route::get('/get_all_installment', [SupervisorProcessesController::class, 'get_all_installment']);
        // pay Installment for student 
        Route::get('/pay_Installment/{payment_id}', [SupervisorProcessesController::class, 'pay_Installment']);
        Route::get('/surfing_salary', [SupervisorProcessesController::class, 'surfing_salary']);
        Route::post('/leave_demand', [SupervisorProcessesController::class, 'leave_demand']);
    });
});
