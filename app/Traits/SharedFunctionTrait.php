<?php

namespace App\Traits;

use App\Helpers\HelpersFunctions;
use App\Models\Activity;
use App\Models\Activity_participants;
use App\Models\Qr_Code;
use App\Models\Salary;
use App\Models\Staff_attendance;
use App\Models\Staff_leaves;
use App\Models\User;
use App\Notifications\LeaveOrderNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Activitylog\Models\Activity as ActivityLog;
use Stripe\PaymentIntent;
use Stripe\Stripe;

trait SharedFunctionTrait
{
    public function verifyQrCodeRequest(Request $request, $type)
    {
        $validator = Validator::make($request->all(), [
            'unique_code' => 'required|exists:qr_codes,Unique_code',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request", 400, $validator->errors());
        }
        $qr = Qr_Code::where([
            'Unique_code' => $request->input('unique_code'),
            'Code_type' => $type // 'employee'
        ])->first();
        if (!$qr) {
            return HelpersFunctions::error("Sorry Qr Code Is Wrong", 400, "Qr that you Entered Not Found ");
        } elseif ($qr->expires_at < Carbon::now()) {
            return HelpersFunctions::error("Sorry Qr Code Is Expired", 400, "Qr that you Entered is Expired");
        } else {
            DB::beginTransaction();
            $emloyee_attendance = new  Staff_attendance();
            $emloyee_attendance->QR_id = $qr->id;
            $emloyee_attendance->user_id = auth('sanctum')->user()->id;
            $emloyee_attendance->Attendance_status = 'present';
            $emloyee_attendance->nots = null;
            $emloyee_attendance->save();
            DB::commit();
            return HelpersFunctions::success($emloyee_attendance, "Regester Attendance Done", 200);
        }
    }
    public function surfing_salary_for_all()
    {
        try {
            $user =  User::find(auth('sanctum')->user()->id);
            $salary = Salary::where(['user_id' => $user->id])
                ->whereYear('date', now()->year)
                ->whereMonth('date', now()->month)
                ->first();
            if (!$salary) {
                return HelpersFunctions::error("Your Salary Does not Exist Yet PLease Wait Some Days", 200, "");
            }
            activity()->causedBy($user)->withProperties([
                'Process_type' => "surfing salary",
            ])->log("Teacher "  . $user->name  . "surfing salary ");
            return HelpersFunctions::success($salary, "Getting Salary Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error In : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function get_last_activity_for_all()
    {
        try {
            $user = auth()->user();
            $activities = ActivityLog::causedBy($user)
                ->latest()
                ->take(5)
                ->get();
            return HelpersFunctions::success($activities, "Getting Activity Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function leave_demand_for_all(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'leave_date' => 'required|date',
            'period' => 'required|in:day,3day,week,2week,month,year',
            'leave_type' => 'required|in:sick,personal,unpaid,emergency',
            // 'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string|max:2048',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request ", 400, $validator->errors());
        }
        try {
            DB::beginTransaction();
            $leave = new  Staff_leaves();
            $leave->user_id = auth('sanctum')->user()->id;
            $leave->leave_date = $request->leave_date;
            $leave->period = $request->period;
            $leave->leave_type = $request->leave_type;
            $leave->status = 'pending';
            $leave->notes = $request->notes;
            $leave->save();
            $admin = User::where('role', 'admin')->first();
            $user  = auth('sanctum')->user();
            $admin->notify(new LeaveOrderNotification($user, $leave));
            // Notification::send($users, new HomeworkAddedNotification($homwork));
            DB::commit();
            return HelpersFunctions::success("", "Leave Demand Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function register_in_activity_for_all(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activity_id' => 'required|exists:activities,id',
            'notes' => 'nullable|exists:activities,id'
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request ", 400, $validator->errors());
        }
        try {
            DB::beginTransaction();
            $user = User::find(auth('sanctum')->user()->id);
            if ($user->activities()->where('activities.id', $request->activity_id)->exists()) {
                return HelpersFunctions::error("logical Error", 400, "you Are already registered in this activity");
            }
            $activity = Activity::find($request->activity_id);

            $register_in_activity = new Activity_participants();
            $register_in_activity->user_id = auth('sanctum')->user()->id;
            $register_in_activity->activity_id = $request->activity_id;
            if ($activity->is_paid) {
                $register_in_activity->payment_status = 'pending';
            } else {
                $register_in_activity->payment_status = 'free_activity';
            }
            $register_in_activity->attendance = false;
            $register_in_activity->payment_method = 'OnLine';
            if ($request->notes) {
                $register_in_activity->notes = $request->notes  ?? null;
            }
            $register_in_activity->save();
            if ($activity->is_paid) {
                Stripe::setApiKey(config('services.stripe.secret'));
                $paymentIntent = PaymentIntent::create([
                    'amount' => $activity->cost * 100,
                    'currency' => 'usd',
                    'metadata' => [
                        'teacher_id' => $user->teacher->id,
                        'activity_id' => $request->activity_id,
                    ],
                ]);
                $register_in_activity->update([
                    'payment_reference' => $paymentIntent->id
                ]);
                $register_in_activity->save();
                Artisan::call('activities:check-seats');
                $data = [
                    'client_secret' => $paymentIntent->client_secret,
                    'message' => 'Creating Registering in Activity Done Please Process Payment cost',
                ];
                DB::commit();
                return HelpersFunctions::success($data, "please Continue Payment", 200);
            } else {
                DB::commit();
                return HelpersFunctions::success($register_in_activity, "register_in_activity done", 200);
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error In : " . $e->getLine(), 500, $e->getMessage());
        }
    }
}
