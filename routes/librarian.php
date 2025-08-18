<?php

use App\Http\Controllers\LibrarianControllers\LibrarianAuthController;
use App\Http\Controllers\LibrarianControllers\LibrarianProcessController;
use Illuminate\Support\Facades\Route;

Route::prefix('/librarian')->name('librarian.')->group(function () {
    Route::prefix('/process')->name('process.')->middleware(['auth:sanctum', 'role:librarian'])->group(function () {
        Route::post('/log_out', [LibrarianAuthController::class, 'logout']);
        Route::get('/get_last_activity', [LibrarianAuthController::class, 'get_last_activity']);
        // CRUD Textual_Books
        Route::post('/Add_Textual_book', [LibrarianProcessController::class, 'Add_Textual_book']);
        Route::post('/edit_Textual_book', [LibrarianProcessController::class, 'edit_Textual_book']);
        Route::get('/get_Textual_book', [LibrarianProcessController::class, 'get_Textual_book']);
        Route::delete('/delete_Textual_book/{id}', [LibrarianProcessController::class, 'delete_Textual_book']);
        // CRUD Cultural_Books
        Route::post('/Add_cultural_book', [LibrarianProcessController::class, 'Add_cultural_book']);
        Route::post('/edit_cultural_book', [LibrarianProcessController::class, 'edit_cultural_book']);
        Route::get('/get_cultural_book', [LibrarianProcessController::class, 'get_cultural_book']);
        Route::delete('/delete_cultural_book/{id}', [LibrarianProcessController::class, 'delete_cultural_book']);
        // Make Book Loan For User with Send Notification To user  
        Route::post('/Make_Book_Loan', [LibrarianProcessController::class, 'Make_Book_Loan']);
        // Make Book Buy For Student  with Send Notification To His Parent
        Route::post('/Make_Book_Buy', [LibrarianProcessController::class, 'Make_Book_Buy']);
        // Make Check For QR Code Attendance For Librarian
        Route::post('/Verify_Qr_Code', [LibrarianProcessController::class, 'Verify_Qr_Code']);
        // get students
        Route::get('/get_students', [LibrarianProcessController::class, 'get_students']);
        // get All loans Processes
        Route::get('/get_loans', [LibrarianProcessController::class, 'get_loans']);
        // get All Sales Processes
        Route::get('/get_sales', [LibrarianProcessController::class, 'get_sales']);
        // return All Loans And Sales For User // Done
        Route::get('/get_loans_Sales_For_user/{id}', [LibrarianProcessController::class, 'get_loans_Sales_For_user']);
        // return Book To library
        Route::post('/return_book', [LibrarianProcessController::class, 'return_book']);
        // Return All Loans And Sales For User
        Route::get('/get_monthly_report', [LibrarianProcessController::class, 'get_monthly_report']);
        Route::get('/surfing_salary', [LibrarianProcessController::class, 'surfing_salary']);
        Route::get('/get_last_activity', [LibrarianProcessController::class, 'get_last_activity']);
        Route::post('/leave_demand', [LibrarianProcessController::class, 'leave_demand']);


        // Extra Apis 
        Route::get('/get_subjects', [LibrarianProcessController::class, 'get_subjects']);
    });
});
