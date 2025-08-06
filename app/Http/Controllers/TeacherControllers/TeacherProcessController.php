<?php

namespace App\Http\Controllers\TeacherControllers;

use App\Helpers\HelpersFunctions;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Activity_participants;
use App\Models\Class_room;
use App\Models\Class_session;
use App\Models\Education_content;
use App\Models\Home_work;
use App\Models\Homework;
use App\Models\Homeworksolving;
use App\Models\Mark;
use App\Models\Qr_Code;
use App\Models\Salary;
use App\Models\Staff_attendance;
use App\Models\Staff_leaves;
use App\Models\Student;
use App\Models\Student_attendance;
use App\Models\Student_profile;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\ActivityEnrollNotification;
use App\Notifications\EducationContentNotification;
use App\Notifications\HomeworkAddedNotification;
use App\Notifications\LeaveNotification;
use App\Notifications\LeaveOrderNotification;
use App\Notifications\MarkNotification;
use Carbon\Carbon;
use Dompdf\Helpers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class TeacherProcessController extends Controller
{
    public function verify_attendance_for_session(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'unique_code' => 'required|exists:qr_codes,Unique_code'
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request ", 400, $validator->errors());
            }
            $qr = Qr_Code::where([
                'Unique_code' => $request->input('unique_code'),
                'Code_type' => 'teacher'
            ])->first();
            if (!$qr) {
                return HelpersFunctions::error("Sorry Qr Code Is Wrong", 400, "Qr that you Entered Not Found ");
            } elseif ($qr->expires_at < Carbon::now()) {
                return HelpersFunctions::error("Sorry Qr Code Is Expired", 400, "Qr that you Entered is Expired");
            } else {
                $teacher = Teacher::where('user_id', auth('sanctum')->user()->id)->first();
                $now = now()->format('h:i');
                // Debug 
                // dd(
                //     "Teacher ID :  " . $teacher->id,
                //     "  Class ID :  " . $qr->class_id,
                //     " Session_day : " . now()->dayName,
                //     " Time : " . $now
                // );
                $session = Class_session::where('teacher_id', $teacher->id)
                    ->where('class_room_id', $qr->class_id)
                    ->where('session_day', now()->dayName)
                    ->where('start_time', '<=', $now)
                    ->where('end_time', '>=', $now)
                    ->first();
                if (!$session) {
                    return HelpersFunctions::error("Sorry You Dont Have Session For This Class Now You are Wrong", 400, "");
                } else {
                    DB::beginTransaction();
                    $attendance = new Staff_attendance();
                    $attendance->QR_id = $qr->id;
                    $attendance->user_id = auth('sanctum')->user()->id;
                    $attendance->Attendance_status = 'present';
                    $attendance->nots = '';
                    $attendance->save();
                    DB::commit();
                    return HelpersFunctions::success($attendance, "Registering Attendance Done", 200);
                }
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function surfing_available_activity()
    {
        try {
            $activities = Activity::where('is_open', true)->get(); //where('is_open', true)->get();
            return HelpersFunctions::success($activities, "Getting Activities Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function register_in_activity(Request $request)
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
    public function confirm_payment_register_in_avtivity(Request $request)
    {
        $request->validate([
            'payment_intent_id' => 'required|string',
        ]);
        try {
            DB::beginTransaction();
            $user = User::find(auth('sanctum')->user()->id);
            Stripe::setApiKey(config('services.stripe.secret'));
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);
            $activity_registeration = Activity_participants::where('payment_reference', $request->payment_intent_id)->first();
            if ($activity_registeration) {
                $activity_registeration->update(['payment_status' => true]);
            }
            // Make transaction 
            $transaction =   Transaction::create([
                'user_id' => $user->id,
                'payment_method' => 'visa',
                'amount' => $activity_registeration->activity->cost,
                'type' => 'in',
                'transaction_source' => 'Enroll_activity',
                'status' => 'paid',
                'is_installment' => false,
                'payment_reference' => $paymentIntent->id,
            ]);
            $user->notify(new ActivityEnrollNotification($transaction, $activity_registeration->activity));
            DB::commit();
            return HelpersFunctions::success("", "Confirming paying Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function surfing_salary()
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
            return HelpersFunctions::success($salary, "Getting Salary Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error In : " . $e->getLine(), 500, $e->getMessage());
        }
    }

    public function view_schedul_table()
    {
        try {
            $user =  User::find(auth('sanctum')->user()->id);
            $sessions = Class_session::where('teacher_id', $user->teacher->id)
                ->orderBy('session_day')
                ->get()->map(function ($session) {
                    return [
                        'class_Name' => $session->class->name,
                        'subject' => $session->teacher->subject->name,
                        'day' => $session->session_day,
                        'start_time' => $session->start_time,
                        'end_time' => $session->end_time,
                    ];
                })
                ->groupBy('day');
            return HelpersFunctions::success($sessions, "Getting Salary Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function enter_education_content(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class_room_id' => 'required|exists:class_rooms,id',
            'title' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:2048',
            'content_type' => 'required|in:video,pdf,link,image,text,quiz',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request ", 400, $validator->errors());
        }
        try {
            DB::beginTransaction();
            $user =  User::find(auth('sanctum')->user()->id);
            // Creating & saving E_C
            $education_content = new Education_content();
            $education_content->teacher_id = $user->teacher->id;
            $education_content->class_room_id = $request->class_room_id;
            $education_content->title = $request->title ?? "";
            $education_content->description = $request->description ?? "";
            $education_content->content_type = $request->content_type;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $file_name = time() . " _ " . $file->getClientOriginalName();
                $file->move(public_path('uploads/Education_Contents/'), $file_name);
                $education_content->file_url = 'uploads/Education_Contents/' . $file_name;
            }
            $education_content->save();
            // Send Not.. To all users in class 
            $users = Student::where('class_id', $request->class_room_id)
                ->with('user')
                ->get()
                ->pluck('user')
                ->filter();
            Notification::send($users, new EducationContentNotification($education_content));
            DB::commit();
            return HelpersFunctions::success($education_content, "Adding  Education Content Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function enter_marks(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'exam_type' => 'required|in:quiz,midterm,final,homework,activity',
            'score' => 'required|integer',
            'max_score' => 'required|integer',
            // 'date' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'teacher_note' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error(" Bad Request ", 400, $validator->errors());
        }
        try {
            $user =  User::find(auth('sanctum')->user()->id);
            DB::beginTransaction();
            $mark = new Mark();
            $mark->teacher_id = $user->teacher->id;
            $mark->student_id = $request->student_id;
            $mark->exam_type = $request->exam_type;
            $mark->score = $request->score;
            $mark->max_score = $request->max_score;
            $mark->date = now()->format('y-m-d');
            $mark->teacher_note = $request->teacher_note;
            $mark->save();
            $user = Student::where('id', $request->student_id)
                ->with('user')
                ->first()
                ->user;
            $user->notify(new MarkNotification($mark));
            DB::commit();
            return HelpersFunctions::success($mark, "Getting Salary Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    // here We has edit make it array 
    public function add_nots_for_student(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'teacher_feedback' => 'required|string',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request ", 400, $validator->errors());
        }
        try {
            $user =  User::find(auth('sanctum')->user()->id);
            $student_profile = Student_profile::where('student_id', $request->student_id)->first();
            $feedback = $student_profile->teacher_feedback ?? [];

            $feedback[$user->name][] = $request->teacher_feedback;
            $student_profile->teacher_feedback = $feedback;


            $student_profile->save();
            return HelpersFunctions::success("", "adding Note Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function add_homework(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class_id' => 'required|exists:class_rooms,id',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'last_date' => 'required|date',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request ", 400, $validator->errors());
        }
        try {
            DB::beginTransaction();
            $homwork = new Home_work();
            $homwork->teacher_id = auth('sanctum')->user()->teacher->id;
            $homwork->class_id = $request->class_id;
            $homwork->description = $request->description;
            $homwork->last_date = $request->last_date;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/Homeworks'), $filename);
                $homwork->homework_url = 'uploads/Homeworks' . $filename . ".pdf";
            }
            $homwork->save();
            $users = Student::where('class_id', $homwork->class_id)
                ->with('user')
                ->get()
                ->pluck('user')
                ->filter();
            // $homwork->homework_url = $request->homework_url;
            Notification::send($users, new HomeworkAddedNotification($homwork));
            DB::commit();
            return HelpersFunctions::success("", "adding Home work Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function leave_demand(Request $request)
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
    public function view_home_work_solution()
    {
        try {
            $solves = Homeworksolving::all();
            return HelpersFunctions::success($solves, "Getting Solved Home Work Done ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
}
