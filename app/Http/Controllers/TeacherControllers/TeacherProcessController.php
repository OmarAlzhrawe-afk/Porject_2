<?php

namespace App\Http\Controllers\TeacherControllers;

use App\Events\StudentProfileUpdatedEvent;
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
use App\Traits\SharedFunctionTrait;

class TeacherProcessController extends Controller
{
    use SharedFunctionTrait;
    public function get_my_student()
    {
        try {
            $teacher = auth('sanctum')->user()->teacher;
            $class_ids = Class_session::where('teacher_id', $teacher->id)
                ->pluck('class_room_id')
                ->unique();
            $students = Student::whereIn('class_id', $class_ids)
                ->with([
                    'profile',
                    'marks' => function ($query) use ($teacher) {
                        $query->where('teacher_id', $teacher->id);
                    },
                    'user',
                    'class',
                    'intstallments',
                ])
                ->get()
                ->unique('id')
                ->values();
            $result = $students->map(function ($student) use ($teacher) {
                $profile = $student->profile;
                $feedbacks = $profile?->teacher_feedback ?? [];
                $teacherNote = $feedbacks[$teacher->user->name] ?? null;
                return [
                    // User Data
                    'student_ID' => $student->id,
                    'student_number' => $student->Student_number,
                    'student_name'   => $student->user?->name,
                    'phone_number'   => $student->user?->phone_number,
                    'class_name'     => $student->class?->name,
                    // Installment data
                    'installment_total_amount'  => $student->installment_total_amount,
                    'installment_count'         => $student->installment_count,
                    'installment_interval_days' => $student->installment_interval_days,
                    'status'                    => $student->status,
                    // Profile data
                    'total_absences'   => $profile?->total_absences,
                    'behavior_notes'   => $profile?->behavior_notes,
                    'health_notes'     => $profile?->health_notes,
                    'interests'        => $profile?->interests,
                    'guardian_feedback' => $profile?->guardian_feedback,
                    'teacher_feedback' => $teacherNote,
                    // marks Data
                    'marks' => $student->marks->map(function ($mark) {
                        return [
                            'exam_type' => $mark->exam_type,
                            'score'     => $mark->score,
                            'max_score' => $mark->max_score,
                            'date'      => $mark->date,
                        ];
                    }),
                ];
            });
            // $class_sessions = Class_session::where('teacher_id', $teacher->id)
            //     ->with('class.students.profile')
            //     ->with('class.students.user')
            //     ->get();
            // $students = $class_sessions->pluck('class.students')
            //     ->flatten()
            //     ->unique('id')
            // ->values();
            return HelpersFunctions::success($result, "Getting Students Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN  : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function get_last_activity()
    {
        return   $this->get_last_activity_for_all();
    }
    public function verify_attendance_for_session(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unique_code' => 'required|exists:qr_codes,Unique_code',
            'class_id' => 'required|exists:class_rooms,id',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request", 400, $validator->errors());
        }
        $qr = Qr_Code::where([
            'Unique_code' => $request->input('unique_code'),
            'Code_type' => 'teacher',
        ])->first();
        if ($qr->expires_at < Carbon::now()) {
            return HelpersFunctions::error("Sorry Qr Code Is Expired", 400, "Qr that you Entered is Expired");
        } else {
            // Fetching Session data 
            $teacher = auth('sanctum')->user()->teacher;
            $sessions = $teacher->sessions;
            // processing logical  validation for teacher session 
            // condition 1 : if teacher have session in this day 
            // condition 2 : if class Id For Session is Equal to Class Id That Entered With Qr Code   
            // condition 3 : if Start Time Of Session Is Equal To Now Time Or less it 10 minutes
            $dayName = Carbon::now()->format('l');
            $timeNow = Carbon::now();
            $have_session = false;
            foreach ($sessions as $session) {
                $sessionStartTime = Carbon::createFromFormat('H:i:s', $session->start_time);
                if (
                    $session->session_day == $dayName &&
                    $session->class_room_id == $request->class_id &&
                    $timeNow->between($sessionStartTime, $sessionStartTime->copy()->addMinutes(10))
                ) {
                    $have_session = true;
                } else {
                    continue;
                }
            }
            // If Validation True Register Attendance For Teacher
            if ($have_session) {
                DB::beginTransaction();
                $emloyee_attendance = new  Staff_attendance();
                $emloyee_attendance->QR_id = $qr->id;
                $emloyee_attendance->user_id = auth('sanctum')->user()->id;
                $emloyee_attendance->Attendance_status = 'present';
                $emloyee_attendance->nots = null;
                $emloyee_attendance->save();
                DB::commit();
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "making Scan For  Attendance",
                ])->log("making Scan For My Attendance");
                return HelpersFunctions::success($emloyee_attendance, "Regester Attendance Done", 200);
            } else {
                return HelpersFunctions::success("", "Oooh You Are wrong Our teacher Today IS your Holiday Or You are Too late to the session  ", 200);
            }
        }
    }
    public function surfing_available_activity()
    {
        try {
            $user = auth('sanctum')->user();
            $activities = Activity::where('is_open', true)->get(); //where('is_open', true)->get();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "surfing activity",
            ])->log("Teacher "  . $user->name  . "surfing activity");
            return HelpersFunctions::success($activities, "Getting Activities Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function register_in_activity(Request $request)
    {
        return  $this->register_in_activity_for_all($request);
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
        return $this->surfing_salary_for_all();
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
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,mp4|max:20480',
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
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Enter Education Level",
            ])->log("Teacher "  . $user->name  . "Enter Education Level");
            Notification::send($users, new EducationContentNotification($education_content));
            DB::commit();
            return HelpersFunctions::success($education_content, "Adding  Education Content Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function view_my_education_content()
    {
        try {
            $user = auth('sanctum')->user();
            $education_contents = Education_content::where('teacher_id', $user->teacher->id)->get()->map(function ($education_content) use ($user) {
                return [
                    'teacher_name' => $user->name,
                    'class_name' => Class_room::where('id', $education_content->class_id)->pluck('name')->first(),
                    'title' => $education_content?->title,
                    'description' => $education_content?->description,
                    'content_type' => $education_content->content_type,
                    'date' => $education_content->created_at->format('Y-m-d'),
                    'file_url' => url($education_content?->file_url)
                ];
            });
            return HelpersFunctions::success($education_contents, "Getting Salary Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
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
            $mark->term_id = HelpersFunctions::getCurrentTermId();
            $mark->save();
            $user = Student::where('id', $request->student_id)
                ->with('user')
                ->first()
                ->user;
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Enter Marks",
            ])->log("Teacher "  . $user->name  . "Enter Marks");

            $user->notify(new MarkNotification($mark));
            DB::commit();
            return HelpersFunctions::success($mark, "Enterring Mark Done", 200);
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
            $education_level_id = Student::find($request->student_id)->class->education_level->id;
            $student_profile = Student_profile::firstOrCreate(
                ['student_id' => $request->student_id],
                [
                    'teacher_feedback' => [],
                    'education_level_id' => $education_level_id,
                ]
            );
            $feedback = $student_profile->teacher_feedback ?? [];
            $feedback[$user->name][] = $request->teacher_feedback;
            $student_profile->teacher_feedback = $feedback;
            $student_profile->save();
            // Broadcast Event
            event(new StudentProfileUpdatedEvent($student_profile));
            // save activity
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Enter Marks",
            ])->log("Teacher "  . $user->name  . "Enter Marks");
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
                $file->move(public_path('uploads/Homeworks/'), $filename);
                $homwork->homework_url = 'uploads/Homeworks/' . $filename;
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
            // save activity
            activity()->causedBy(auth('sanctum')->user())->withProperties([
                'Process_type' => "Enter Marks",
            ])->log("Teacher "  . auth('sanctum')->user()->name  . "Enter Marks");

            return HelpersFunctions::success("", "adding Home work Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function get_my_homeworks()
    {
        try {
            $user =  auth('sanctum')->user();
            $homeworks = Home_work::where('teacher_id', $user->teacher->id)
                ->where('last_date', '<=', Carbon::today())
                ->get()
                ->map(function ($homwork) {
                    return [
                        'class_name' => Class_room::where('id', $homwork->class_id)->first()->value('name'),
                        'description' => $homwork->description,
                        'homework_url' => url($homwork->homework_url),
                        'last_date' => $homwork->last_date,
                    ];
                });
            return HelpersFunctions::success($homeworks, "Getting Homeworks Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function get_homeworks_solvings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'homework_id' => 'required|exists:home_works,id',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request ", 400, $validator->errors());
        }
        try {

            $homeworks = Homeworksolving::where([
                'homework_id' => $request->homework_id,
                'solved' => false
            ])
                ->get()
                ->map(function ($homwork) {
                    return [
                        'student_id' => Student::find($homwork->student_id),
                        'solve_url' => url($homwork->solve_url),
                    ];
                });
            return HelpersFunctions::success($homeworks, "Getting Homeworks Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function solve_homework(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'homework_solving_id' => 'required|exists:homework_solvings,id',
            'nots' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request ", 400, $validator->errors());
        }
        try {
            $homework_solving = Homeworksolving::find($request->homework_solving_id);
            $homework_solving->nots = $request->nots ?? null;
            $homework_solving->solved = true;
            $homework_solving->save();
            // save activity
            activity()->causedBy(auth('sanctum')->user())->withProperties([
                'Process_type' => "Solve HomeWork",
            ])->log("Teacher "  . auth('sanctum')->user()->name  . "Solve HomeWork");

            return HelpersFunctions::success("", "Solving Homework Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function leave_demand(Request $request)
    {
        return $this->leave_demand_for_all($request);
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
    public function notifications()
    {
        $notifications = auth('sanctum')->user()->notifications;
        return HelpersFunctions::success($notifications, "Getting Admin Notifications Done ", 200);
    }
    public function markAsRead($id)
    {
        $notification = auth('sanctum')->user()->notifications->where('id', $id)->first();

        if (!$notification) {
            return HelpersFunctions::error("bad Request", 400, "Notification not found");
        }
        $notification->markAsRead();
        return HelpersFunctions::success("", "Admin Notification mark As Read Done");
    }
}
