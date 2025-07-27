<?php

namespace App\Http\Controllers\LibrarianControllers;

use App\Helpers\HelpersFunctions;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Login_code;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordCodeMail;
use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity as ActivityLog;

class LibrarianAuthController extends Controller
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
                    'Process_type' => "Send login Code for librarian Code",
                ])->log("Librarian" . $user->name  . " Send Forget Password Code");
                return HelpersFunctions::success("", "Sending log in Code  Successfully ", 201);
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
            'code' => 'required |exists:login_codes,code',
            'email' => 'required |exists:users,email',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request Wrong code Or Email", 400, $validator->errors());
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
        //Enrolling librarian Log in 
        activity()->causedBy($user)->withProperties([
            'Process_role' => "Librarian",
            'Process_type' => "Log_In Librarian",
        ])->log("Librarian" . $user->name . "Loged In");
        return HelpersFunctions::success($data, " Login Done ", 200);
    }
    public function logout(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->user()->currentAccessToken()->delete();
            //Enrolling librarian Log in 
            activity()->causedBy($request->user)->withProperties([
                'Process_role' => "Librarian",
                'Process_type' => "Log_Out Librarian",
            ])->log("Librarian " . $request->user()->name .  "log Out");
            DB::commit();
            return HelpersFunctions::success($request->user()->name, "log out Done ", 201);
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function get_last_activity()
    {
        try {
            $user = auth('sanctum')->user();
            $activities = ActivityLog::causedBy($user)
                ->latest()
                ->take(5)
                ->get();
            return HelpersFunctions::success($activities, "Getting Activity Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
}
