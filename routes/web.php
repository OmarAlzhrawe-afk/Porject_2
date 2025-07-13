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

// Route::get('/test-email', function () {
//     Mail::to('omar@gmail.com')->send(new AcceptedSchoolMail("Test email message"));
//     return 'Email Sent';
// });
