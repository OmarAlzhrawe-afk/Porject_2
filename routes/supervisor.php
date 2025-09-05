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


        // Activity Crud
        // Notification for All Student who are related for Activity Done
        Route::post('/Add_Activity', [SupervisorProcessesController::class, 'Add_Activity']); // Send Notification To Students
        Route::post('/edit_Activity', [SupervisorProcessesController::class, 'edit_Activity']); // Send Notification To Students
        Route::get('/delete_Activity/{id}', [SupervisorProcessesController::class, 'delete_Activity']); // Send Notification To Students
        Route::get('/get_activities', [SupervisorProcessesController::class, 'get_activities']);



        Route::post('/Add_student_profile_data', [SupervisorProcessesController::class, 'Add_student_profile_data']);
        // Notification for All parent that there children is abscence today Done 
        Route::post('/Add_daily_student_absences', [SupervisorProcessesController::class, 'Add_daily_student_absences']);
        Route::get('/Show_Reports_For_Students', [SupervisorProcessesController::class, 'Show_Reports_For_Students']);
        Route::post('/Verify_Qr_Code', [SupervisorProcessesController::class, 'Verify_Qr_Code']);


        // Api For get my Education Level Data Make Method In helper it exist same method with admin apis *****
        // here Add student in Education Level
        Route::get('/get_Education_level', [SupervisorProcessesController::class, 'get_Education_level']);
        // Get all Installment For my students 
        Route::get('/get_all_installment', [SupervisorProcessesController::class, 'get_all_installment']);
        // pay Installment for student 
        Route::get('/pay_Installment/{payment_id}', [SupervisorProcessesController::class, 'pay_Installment']);
        Route::get('/surfing_salary', [SupervisorProcessesController::class, 'surfing_salary']);
        Route::post('/leave_demand', [SupervisorProcessesController::class, 'leave_demand']);
        // api for last activity for supervisor 
        Route::get('/get_last_activity', [SupervisorProcessesController::class, 'get_last_activity']);
        // Extra Api 
        Route::get('/Check_if_attendance_student_done', [SupervisorProcessesController::class, 'Check_if_attendance_student_done']);
        // Notifications Process 
        Route::get('/notifications', [SupervisorProcessesController::class, 'notificationss']);
        Route::get('/notifications/read/{id}', [SupervisorProcessesController::class, 'markAsReads']);
        Route::post('/SendSpecificNotificationForUser', [SupervisorProcessesController::class, 'SendSpecificNotificationForUser']);
    });
});
// 22