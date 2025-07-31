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
