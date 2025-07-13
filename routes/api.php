<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('dash', function () {
    return view('dashboard');
});
Route::prefix('admin/')->name('admin.')->middleware('api')->group(function () {
    // Admin Login 
    Route::post('login', [LoginController::class, 'AdminLogin'])->name('login');
    Route::prefix('process/')->name('process.')->middleware('auth:sanctum')->group(function () {
        //Create Education Level 
        Route::post('create_education_level', [AdminProcessController::class, 'create_education_level'])->name('create_education_level');
        // Create Class Room For Specific Education Levels
        Route::post('add_class_for_education_level', [AdminProcessController::class, 'add_class_for_education_level'])->name('add_class');
        // Create subject For Specific Education Level
        Route::post('add_subject_for_education_level', [AdminProcessController::class, 'add_subject_for_education_level'])->name('add_subject');
        // Create Class_Session For Specific Education Level
        Route::post('add_session_for_class_room', [AdminProcessController::class, 'add_session_for_class_room'])->name('add_session');
        // CRUD Post
        Route::get('get_all_posts', [AdminProcessController::class, 'get_Posts']);
        Route::post('add_Post', [AdminProcessController::class, 'add_Post'])->name('add_Post');
        Route::post('update_Post', [AdminProcessController::class, 'update_Post'])->name('update_Post');
        Route::delete('delete_Post/{post_id}', [AdminProcessController::class, 'delete_Post'])->name('delete_Post');
        // CRUD Public_Content
        Route::get('get_all_public_content', [AdminProcessController::class, 'get_public_content']);
        Route::post('add_PublicContent', [AdminProcessController::class, 'add_PublicContent'])->name('add_PublicContent');
        Route::post('update_PublicContent', [AdminProcessController::class, 'update_PublicContent'])->name('update_PublicContent');
        Route::delete('delete_PublicContent/{public_content_id}', [AdminProcessController::class, 'delete_PublicContent'])->name('delete_PublicContent');
        // CRUD each other User
        Route::get('get_all_Users/{type}', [AdminProcessController::class, 'get_all_users']);
        Route::post('add_User', [AdminProcessController::class, 'add_User'])->name('add_User');
        Route::post('update_User', [AdminProcessController::class, 'update_User'])->name('update_User');
        Route::get('delete_User/{id}', [AdminProcessController::class, 'delete_User']);
        // Handle Pre_Registeration For Students
        Route::get('get_all_pre_registeration', [AdminProcessController::class, 'get_all_pre_registeration']);
        Route::get('Accept_pre_registeration/{id}', [AdminProcessController::class, 'Accept_pre_registeration']);
        Route::get('Reject_pre_registeration/{id}', [AdminProcessController::class, 'Reject_pre_registeration']);
        // Handle Staff Leaves
        Route::get('get_all_Leaves_order', [AdminProcessController::class, 'get_all_Leaves_order']);
        Route::post('Accept_Leave', [AdminProcessController::class, 'Accept_Leave'])->name('Accept_Leave');
        Route::get('Reject_Leave/{id}', [AdminProcessController::class, 'Reject_Leave']);
        // Generate Qr Codes 
        Route::get('Generate_QR_For_Specific_Class', [AdminProcessController::class, 'Generate_QR_For_Specific_Class_get_page']);
        Route::post('Generate_QR_For_Specific_Class', [AdminProcessController::class, 'Generate_QR_For_Specific_Class'])->name('Generate_QR_For_Specific_Class');
    });
});

Route::get('supervisor/login', [LoginController::class, 'GetLoginViewForSupervisor'])->name('supervisor.loginpage')->middleware('web');

Route::post('supervisor/login/createcode', [LoginController::class, 'Supervisorcreatecode'])->name('supervisor.login.createcode')->middleware('web');

Route::post('supervisor/login/entercode', [LoginController::class, 'Supervisorentercode'])->name('supervisor.login.entercode')->middleware('web');
Route::post('supervisor/login/resendcode', [LoginController::class, 'SupervisorResendCode'])->name('supervisor.login.resendcode')->middleware('web');
