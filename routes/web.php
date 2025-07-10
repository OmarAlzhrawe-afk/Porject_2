<?php

use App\Http\Controllers\AdminProcessController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\AcceptedSchoolMail;

use App\Http\Controllers\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin/')->name('admin.')->middleware('web')->group(function () {
    // Admin Login 
    Route::get('login', [LoginController::class, 'getLoginViewforadmin'])->name('loginpage');
    Route::post('login', [LoginController::class, 'AdminLogin'])->name('login');
    Route::prefix('process/')->name('process.')->middleware('auth')->group(function () {
        //Create Education Level 
        Route::get('get_education_level_create_page', [AdminProcessController::class, 'get_education_level_create_page']);
        Route::post('create_education_level', [AdminProcessController::class, 'create_education_level'])->name('create_education_level');
        // Create Class Room For Specific Education Levels
        Route::get('add_class_for_education_level/{level_id}', [AdminProcessController::class, 'add_class_for_education_level_page']);
        Route::post('add_class_for_education_level', [AdminProcessController::class, 'add_class_for_education_level'])->name('add_class');
        // Create subject For Specific Education Level
        Route::get('add_subject_for_education_level/{level_id}', [AdminProcessController::class, 'add_subject_for_education_level_page']);
        Route::post('add_subject_for_education_level', [AdminProcessController::class, 'add_subject_for_education_level'])->name('add_subject');
        // Create Class_Session For Specific Education Level
        Route::get('add_session_for_class_room', [AdminProcessController::class, 'add_session_for_class_room_page']);
        Route::post('add_session_for_class_room', [AdminProcessController::class, 'add_session_for_class_room'])->name('add_session');
        // CRUD Post
        Route::get('get_all_posts', [AdminProcessController::class, 'get_Posts']);
        Route::get('get_Post_page', [AdminProcessController::class, 'get_Post_page']);
        Route::post('add_Post', [AdminProcessController::class, 'add_Post'])->name('add_Post');
        Route::get('update_Post_get/{post_id}', [AdminProcessController::class, 'get_update_Post_page']);
        Route::post('update_Post', [AdminProcessController::class, 'update_Post'])->name('update_Post');
        Route::get('delete_Post/{post_id}', [AdminProcessController::class, 'delete_Post'])->name('delete_Post');
        // CRUD Public_Content
        Route::get('get_all_public_content', [AdminProcessController::class, 'get_public_content']);
        Route::get('get_PublicContent_page', [AdminProcessController::class, 'get_PublicContent_page']);
        Route::post('add_PublicContent', [AdminProcessController::class, 'add_PublicContent'])->name('add_PublicContent');
        Route::get('update_PublicContent_get/{public_content_id}', [AdminProcessController::class, 'get_update_Public_content_page']);
        Route::post('update_PublicContent', [AdminProcessController::class, 'update_PublicContent'])->name('update_PublicContent');
        Route::get('delete_PublicContent/{public_content_id}', [AdminProcessController::class, 'delete_PublicContent'])->name('delete_PublicContent');
        // CRUD Teachers
        Route::get('get_all_Teacher', [AdminProcessController::class, 'get_all_Teacher']);
        Route::get('get_page_AddTeacher', [AdminProcessController::class, 'get_page_AddTeacher']);
        Route::post('add_Teacher', [AdminProcessController::class, 'add_Teacher'])->name('add_Teacher');
        Route::get('get_page_UpdateTeachers/{id}', [AdminProcessController::class, 'get_page_UpdateTeachers']);
        Route::post('update_teacher', [AdminProcessController::class, 'update_teacher'])->name('update_teacher');
        Route::get('delete_Teacher/{id}', [AdminProcessController::class, 'delete_Teacher']);
        // CRUD Supervisor
        Route::get('get_all_SuperVisor', [AdminProcessController::class, 'get_all_SuperVisor']);
        Route::get('get_page_AddSupervisor', [AdminProcessController::class, 'get_page_AddSupervisor']);
        Route::post('add_Supervisor', [AdminProcessController::class, 'add_Supervisor'])->name('add_Supervisor');
        Route::get('get_page_UpdateSupervisor/{id}', [AdminProcessController::class, 'get_page_UpdateSupervisor']);
        Route::post('update_supervisor', [AdminProcessController::class, 'update_supervisor'])->name('update_supervisor');
        Route::get('delete_Supervisor/{id}', [AdminProcessController::class, 'delete_Supervisor']);
        // CRUD student
        Route::get('get_all_students', [AdminProcessController::class, 'get_all_students']);
        Route::get('get_page_AddStudent', [AdminProcessController::class, 'get_page_AddStudent']);
        Route::post('add_Student', [AdminProcessController::class, 'add_Student'])->name('add_Student');
        Route::get('get_page_UpdateStudent/{id}', [AdminProcessController::class, 'get_page_UpdateStudent']);
        Route::post('update_Student', [AdminProcessController::class, 'update_Student'])->name('update_Student');
        Route::get('delete_Student/{id}', [AdminProcessController::class, 'delete_Student']);
        // CRUD each other User
        Route::get('get_all_Users/{type}', [AdminProcessController::class, 'get_all_users']);
        Route::get('get_page_AddUser/{type}', [AdminProcessController::class, 'get_page_AddUser']);
        Route::post('add_User', [AdminProcessController::class, 'add_User'])->name('add_User');
        Route::get('get_page_UpdateUser/{id}', [AdminProcessController::class, 'get_page_UpdateUser']);
        Route::post('update_User', [AdminProcessController::class, 'update_User'])->name('update_User');
        Route::get('delete_User/{id}', [AdminProcessController::class, 'delete_User']);
        // Handle Pre_Registeration For Students
        Route::get('get_all_pre_registeration', [AdminProcessController::class, 'get_all_pre_registeration']);
        Route::get('Accept_pre_registeration/{id}', [AdminProcessController::class, 'Accept_pre_registeration']);
        Route::get('Reject_pre_registeration/{id}', [AdminProcessController::class, 'Reject_pre_registeration']);
        // Handle Staff Leaves
        Route::get('get_all_Leaves_order', [AdminProcessController::class, 'get_all_Leaves_order']);
        Route::get('Accept_Leave_page/{id}', [AdminProcessController::class, 'Accept_Leave_page']);
        Route::post('Accept_Leave', [AdminProcessController::class, 'Accept_Leave'])->name('Accept_Leave');
        Route::get('Reject_Leave/{id}', [AdminProcessController::class, 'Reject_Leave']);
    });
});

Route::get('supervisor/login', [LoginController::class, 'GetLoginViewForSupervisor'])->name('supervisor.loginpage')->middleware('web');

Route::post('supervisor/login/createcode', [LoginController::class, 'Supervisorcreatecode'])->name('supervisor.login.createcode')->middleware('web');

Route::post('supervisor/login/entercode', [LoginController::class, 'Supervisorentercode'])->name('supervisor.login.entercode')->middleware('web');
Route::post('supervisor/login/resendcode', [LoginController::class, 'SupervisorResendCode'])->name('supervisor.login.resendcode')->middleware('web');

// Route::get('/test-email', function () {
//     Mail::to('omar@gmail.com')->send(new AcceptedSchoolMail("Test email message"));
//     return 'Email Sent';
// });
