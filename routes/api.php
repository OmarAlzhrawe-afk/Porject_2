<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllers\PostCrud;
use App\Http\Controllers\AdminControllers\PublicContentCrud;
use App\Http\Controllers\AdminControllers\AdminAuth;
use App\Http\Controllers\AdminControllers\ManageClassesAndEducationLevel;
use App\Http\Controllers\AdminControllers\ManageUsers;
use App\Http\Controllers\AdminControllers\AdminProcessController;
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




Route::prefix('admin/')->name('admin.')->middleware('api')->group(function () {
    // Admin Login  
    Route::post('login', [AdminAuth::class, 'AdminLogin'])->name('loginpage');
    // Route To Forget  Admin Password
    // 1  Send VerifyCode email
    Route::post('SendForgetPasswordCodeAdmin', [AdminAuth::class, 'SendForgetPasswordCodeAdmin']);
    // 2  Entered VerifyCode Code verify
    Route::post('VerifyPasswordCodeAdmin', [AdminAuth::class, 'VerifyPasswordCodeAdmin']);
    // 3  Update Password 
    Route::post('UpdatePasswordAdmin', [AdminAuth::class, 'UpdatePasswordAdmin']);
    Route::prefix('process/')->name('process.')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
        //4 Get dashboard data
        Route::get('Get_dash_data', [ManageClassesAndEducationLevel::class, 'Get_dash_data']);
        //Create Education Level 
        Route::post('create_education_level', [ManageClassesAndEducationLevel::class, 'create_education_level']);
        Route::get('delete_education_level/{id}', [ManageClassesAndEducationLevel::class, 'delete_education_level']);
        // Get All Education level 
        Route::get('get_All_education_level', [ManageClassesAndEducationLevel::class, 'get_All_education_level']);
        // Get Data For Specific Education Level 
        Route::get('get_education_level_data/{education_level_id}', [ManageClassesAndEducationLevel::class, 'get_education_level_data']);
        // Create Class Room For Specific Education Levels
        Route::post('add_class_for_education_level', [ManageClassesAndEducationLevel::class, 'add_class_for_education_level'])->name('add_class');
        Route::get('delete_class/{id}', [ManageClassesAndEducationLevel::class, 'delete_class_for_education_level']);
        // Manage Sessions
        Route::post('add_session_for_class_room', [ManageClassesAndEducationLevel::class, 'add_session_for_class_room'])->name('add_session');
        Route::get('get_all_sessions', [ManageClassesAndEducationLevel::class, 'get_all_sessions']);
        Route::get('delete_session/{id}', [ManageClassesAndEducationLevel::class, 'delete_session']);
        // Create Subject For Specific Education Level
        Route::post('add_subject_for_education_level', [ManageClassesAndEducationLevel::class, 'add_subject_for_education_level'])->name('add_subject');
        Route::get('delete_subject/{id}', [ManageClassesAndEducationLevel::class, 'delete_subject'])->name('delete_subject');
        Route::get('get_all_subjects_with_his_data', [ManageClassesAndEducationLevel::class, 'get_all_subjects_with_his_data'])->name('add_subject');
        // CRUD Post
        Route::get('get_all_posts', [PostCrud::class, 'get_Posts']);
        Route::post('add_Post', [PostCrud::class, 'add_Post'])->name('add_Post');
        Route::post('update_Post', [PostCrud::class, 'update_Post'])->name('update_Post');
        Route::delete('delete_Post/{post_id}', [PostCrud::class, 'delete_Post'])->name('delete_Post');
        // CRUD Public_Content
        Route::get('get_all_public_content', [PublicContentCrud::class, 'get_public_content']);
        Route::post('add_PublicContent', [PublicContentCrud::class, 'add_PublicContent'])->name('add_PublicContent');
        Route::post('update_PublicContent', [PublicContentCrud::class, 'update_PublicContent'])->name('update_PublicContent');
        Route::delete('delete_PublicContent/{public_content_id}', [PublicContentCrud::class, 'delete_PublicContent'])->name('delete_PublicContent');
        // CRUD  User
        Route::get('get_all_Users', [ManageUsers::class, 'get_all_users']);
        Route::post('add_User', [ManageUsers::class, 'add_User'])->name('add_User');
        Route::post('update_User', [ManageUsers::class, 'update_User'])->name('update_User');
        Route::get('delete_User/{id}', [ManageUsers::class, 'delete_User']);
        // Handle Pre_Registeration For Students
        Route::get('get_all_pre_registeration', [AdminProcessController::class, 'get_all_pre_registeration']);
        Route::get('Accept_pre_registeration/{id}', [AdminProcessController::class, 'Accept_pre_registeration']);
        Route::get('Reject_pre_registeration/{id}', [AdminProcessController::class, 'Reject_pre_registeration']);
        // Handle Staff Leaves
        Route::get('get_all_Leaves_order', [AdminProcessController::class, 'get_all_Leaves_order']);
        Route::post('Accept_Leave', [AdminProcessController::class, 'Accept_Leave'])->name('Accept_Leave');
        Route::get('Reject_Leave/{id}', [AdminProcessController::class, 'Reject_Leave']);
        // Generate Qr Codes 
        Route::post('Generate_QR_For_Specific_Class', [AdminProcessController::class, 'Generate_QR_For_Specific_Class']);
        Route::get('Generate_QR_For_All_Staff', [AdminProcessController::class, 'Generate_QR_For_All_Staff']);
        Route::get('Generate_QR_SVG_For_All_Classes', [AdminProcessController::class, 'Generate_QR_SVG_For_All_Classes']);
    });
});

// Route::get('supervisor/login', [LoginController::class, 'GetLoginViewForSupervisor'])->name('supervisor.loginpage')->middleware('web');

// Route::post('supervisor/login/createcode', [LoginController::class, 'Supervisorcreatecode'])->name('supervisor.login.createcode')->middleware('web');

// Route::post('supervisor/login/entercode', [LoginController::class, 'Supervisorentercode'])->name('supervisor.login.entercode')->middleware('web');
// Route::post('supervisor/login/resendcode', [LoginController::class, 'SupervisorResendCode'])->name('supervisor.login.resendcode')->middleware('web');
