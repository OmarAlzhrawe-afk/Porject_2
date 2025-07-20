<?php

namespace App\Http\Controllers\SupervisorControllers;

use App\Helpers\HelpersFunctions;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Login_code;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordCodeMail;
use Exception;

class SupervisorAuth extends Controller
{
    public function send_passcode(Request $request)
    {
        try {
            // verify Request data 
            $validator = Validator::make($request->all(), [
                'email' => 'required |exists:users,email',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            } else {
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
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal server Error", 500, $e->getMessage());
        }
    }
    public function verify_passcode(Request $request)
    {
        // I send Email Here Because maybe Code is repeated  
        // verify Request data 
        $validator = Validator::make($request->all(), [
            'email' => 'required |exists:users,email',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request", 400, $validator->errors());
        }
        $code = Login_code::where([
            'code' => $request->code,
            'email' => $request->email,
        ])->first();

        // verify if code expired or Not  
        if (now()->diffInMinutes($code->created_at) > 5) {
            return HelpersFunctions::error("Bad Request", 400, "Code That you Entered Expired");
        }
        $code->delete();
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken($user->name)->plainTextToken;
        $data = [
            'token' =>  $token,
            'admin data' =>  $user,
        ];
        //Enrolling Admin Log
        activity()->causedBy($user)->withProperties([
            'Process_type' => "Log_In Supervisor",
        ])->log("Admin Loged In");
        return HelpersFunctions::success($data, " Login Done ", 200);
    }
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return HelpersFunctions::success("", "log out Done ", 201);
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
}
