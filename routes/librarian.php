<?php

use App\Http\Controllers\LibrarianControllers\LibrarianAuthController;
use App\Http\Controllers\LibrarianControllers\LibrarianProcessController;
use Illuminate\Support\Facades\Route;

Route::prefix('/librarian')->name('librarian.')->group(function () {
    // Login librarian
    Route::post('/send_passcode', [LibrarianAuthController::class, 'send_passcode']);
    Route::post('/verify_passcode', [LibrarianAuthController::class, 'verify_passcode']);
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
    });
});
