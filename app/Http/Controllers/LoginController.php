<?php

namespace App\Http\Controllers;

use App\Mail\PasswordCodeMail;
use App\Models\Login_code;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLoginViewforadmin()
    {
        return view('auth.adminlogin');
    }
    public function GetLoginViewForSupervisor()
    {
        return view('auth.supervisorlogin');
    }


    public function AdminLogin(Request $request)
    {
        // verify Request data 
        $request->validate([
            'email' => 'required | email',
            'password' => 'required',
            'role' => 'required | exists:users,role',
        ]);
        // Fetch User From database 
        $user = User::where('email', $request->email)->first();
        //verify If User Exist with Same Password
        if (!$user || $request->input('password') != $user->password) {
            return back()->withErrors([
                'message' => 'Invalid Email Or password'
            ]);
        }
        // Verify The Role Admin
        if ($user->role != $request->input('role')) {
            return back()->withErrors([
                'message' => 'you Dont have permission to Acess with this Role Select Role As ' . $user->role
            ]);
        } else {
            Auth::login($user, true);
            $request->session()->regenerate();
            return view('dashboard');
        }
    }
    public function Supervisorcreatecode(Request $request)
    {
        // verify Request data 
        $request->validate([
            'email' => 'required | email',
            'role' => 'required | in:admin,supervisor',
        ]);
        // Fetch User From database 
        $user = User::where('email', $request->email)->first();
        //verify If User Exist with same Email
        if (!$user) {
            return back()->withErrors([
                'message' => 'Invalid Email '
            ]);
        }
        // Verify The Role Admin
        if ($user->role != $request->input('role')) {
            return back()->withErrors([
                'message' => 'you Dont have permission to Acess with this Role Select Role As ' . $user->role
            ]);
        }
        // Delete All last Login Codes For this User 
        Login_code::where('email', $request->email)->delete();

        // create code For Login
        $code = new Login_code();
        $code->code = rand(100000, 999999);
        $code->email = $user->email;
        $code->created_at = now();
        $code->save();
        // Send Code To Supervisor Email
        Mail::to($request->email)->send(new PasswordCodeMail($code->code));
        return view('auth.enter_login_code', ['email' => $code->email]);
    }


    public function Supervisorentercode(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'code' => 'required',
        ]);

        $code = Login_code::where('email', $request->email)
            ->where('code', $request->code)
            ->first();
        // verify if code Exist or not  
        if (!$code) {
            return back()->withErrors(['code' => 'code That you Entered Incorrect']);
        }

        // verify if code valid or not  
        if (now()->diffInMinutes($code->created_at) > 5) {
            return back()->withErrors(['code' => 'code That you Entered Invalid']);
        }

        // Fetch user 
        $user = User::where('email', $request->email)->first();

        // Login For user 
        Auth::login($user, true);
        $request->session()->regenerate();
        // Delete Code 
        $code->delete();
        return view('dashboard');
    }
    public function SupervisorResendCode(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);
        // delete old codes 
        // Delete All last Login Codes For this User 
        Login_code::where('email', $request->email)->delete();

        // create code For Login
        $code = new Login_code();
        $code->code = rand(100000, 999999);
        $code->email = $request->email;
        $code->created_at = now();
        $code->save();
        // Send Code To Supervisor Email
        Mail::to($request->email)->send(new PasswordCodeMail($code->code));
        return view('auth.enter_login_code', ['email' => $request->email]);
    }
}
