<?php

namespace App\Http\Controllers;

use App\Helpers\HelpersFunctions;
use App\Mail\PasswordCodeMail;
use App\Models\Login_code;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    // public function Supervisorentercode(Request $request)
    // {

    //     $request->validate([
    //         'email' => 'required|email',
    //         'code' => 'required',
    //     ]);

    //     $code = Login_code::where('email', $request->email)
    //         ->where('code', $request->code)
    //         ->first();
    //     // verify if code Exist or not  
    //     if (!$code) {
    //         return back()->withErrors(['code' => 'code That you Entered Incorrect']);
    //     }

    //     // verify if code valid or not  
    //     if (now()->diffInMinutes($code->created_at) > 5) {
    //         return back()->withErrors(['code' => 'code That you Entered Invalid']);
    //     }

    //     // Fetch user 
    //     $user = User::where('email', $request->email)->first();

    //     // Login For user 
    //     Auth::login($user, true);
    //     $request->session()->regenerate();
    //     // Delete Code 
    //     $code->delete();
    //     return view('dashboard');
    // }
    // public function SupervisorResendCode(Request $request)
    // {

    //     $request->validate([
    //         'email' => 'required|email',
    //     ]);
    //     // delete old codes 
    //     // Delete All last Login Codes For this User 
    //     Login_code::where('email', $request->email)->delete();

    //     // create code For Login
    //     $code = new Login_code();
    //     $code->code = rand(100000, 999999);
    //     $code->email = $request->email;
    //     $code->created_at = now();
    //     $code->save();
    //     // Send Code To Supervisor Email
    //     Mail::to($request->email)->send(new PasswordCodeMail($code->code));
    //     return view('auth.enter_login_code', ['email' => $request->email]);
    // }
}
