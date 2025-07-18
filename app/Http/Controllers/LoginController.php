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
    public function AdminLogin(Request $request)
    {
        // verify Request data 

        $validator = Validator::make($request->all(), [
            'email' => 'required |exists:users,email',
            'password' => 'required',
            'role' => 'required | exists:users,role',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request Invalid Data", 400, $validator->errors());
        }
        // Fetch User From database 
        $user = User::where('email', $request->email)->first();

        // Verify The Role Admin
        if ($user->role != $request->input('role')) {
            return response()->json([
                'Error' => 'Failed Login',
                'message' => 'You Do Not Have Permission To Login As Admin Please Login As ' . $user->role
            ]);
        } else {
            $token = $user->createToken($user->name)->plainTextToken;
            //Enrolling Admin Log
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Log_In",
            ])->log("Admin Loged In");
            return HelpersFunctions::success($token, " Login Done ", 200);
        }
    }
    // This 3Three Function For Admin If He Forget His Account Password
    //1
    public function SendForgetPasswordCodeAdmin(Request $request)
    {
        // verify Request data 
        $validator = Validator::make($request->all(), [
            'email' => 'required |exists:users,email',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request", 400, $validator->errors());
        }
        // Fetch User From database 
        $user = User::where('email', $request->email)->first();

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
        activity()->causedBy($user)->withProperties([
            'Process_type' => "Send Forget Password Code",
        ])->log("Admin Send Forget Password Code");
        return HelpersFunctions::success("", "Sending Password Code  Successfully ", 201);
    }
    //2
    public function VerifyPasswordCodeAdmin(Request $request)
    {

        $request->validate([
            'code' => 'required',
            'email' => 'required|exists:users,email',
        ]);

        $code = Login_code::where([
            'code' => $request->code,
            'email' => $request->email,
        ])->first();
        // verify if code Exist or not  
        if (!$code) {
            return HelpersFunctions::error("Bad Request", 400, "Code That you Entered Not Found");
        }

        // verify if code valid or not  
        if (now()->diffInMinutes($code->created_at) > 5) {
            return HelpersFunctions::error("Bad Request", 400, "Code That you Entered Expired");
        }
        $code->delete();
        return HelpersFunctions::success("", "Code Verify Successfully ", 200);
    }
    //3
    public function UpdatePasswordAdmin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:6|confirmed',
                'email' => 'required|exists:users,email',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            }
            $user = User::where('email', $request->email)->first();
            $user->password = $request->password;
            $user->save();
            return HelpersFunctions::success("", "Update Password Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
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
