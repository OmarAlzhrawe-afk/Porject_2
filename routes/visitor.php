<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorControllers\VisitorProcessController as  VisitorController;

Route::prefix('/visitor/process')->name('visitor.process.')->group(function () {
    Route::post('/pre_register', [VisitorController::class, 'preRegister']);
    Route::post('/create_payment_intent', [VisitorController::class, 'create_payment_intent']);
    Route::post('/confirm_payment', [VisitorController::class, 'confirmPayment']);
    Route::get('/view_posts', [VisitorController::class, 'view_posts']);
    Route::get('/view_public_content', [VisitorController::class, 'view_public_content']);
    Route::get('/view_education_level', [VisitorController::class, 'view_education_level']);
    // Login For { Parent,Student,Teacher,librarian}
    Route::post('/send_passcode', [VisitorController::class, 'send_passcode']);
    Route::post('/verify_passcode', [VisitorController::class, 'verify_passcode']);
});
// 8