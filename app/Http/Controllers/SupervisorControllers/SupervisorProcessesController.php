<?php

namespace App\Http\Controllers\SupervisorControllers;

use App\Events\AddedActivityEvent;
use App\Events\updatedActivityEvent;
use App\Helpers\HelpersFunctions;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\StoreStudentProfileRequest;
use App\Models\Activity;
use App\Models\Class_room;
use App\Models\Class_session;
use App\Models\Student_profile;
use App\Models\Education_level;
use App\Models\Installment_payment;
use App\Models\Installment_Plan;
use App\Models\Qr_Code;
use App\Models\Staff_attendance;
use App\Models\Student;
use App\Models\Student_attendance;
use App\Models\Supervisor;
use App\Models\Teacher;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\NewActivity;
use App\Notifications\StudentAbsencesNotification;
use App\Notifications\SupervisorNotification;
use App\Notifications\UpdatedActivityNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Spatie\Activitylog\Models\Activity as ActivityLog;
use App\Traits\SharedFunctionTrait;
use Maatwebsite\Excel\Facades\Excel;

class SupervisorProcessesController extends Controller
{
    use SharedFunctionTrait;
    public function Check_if_attendance_student_done()
    {
        try {
            $supervisor = auth('sanctum')->user()->supervisor;
            $today = now()->toDateString();
            $attendanceExists = Student_attendance::whereDate('date', $today)
                ->whereHas('class', function ($query) use ($supervisor) {
                    $query->where('education_level_id', $supervisor->education_level->id);
                })->exists();
            if ($attendanceExists) {
                return HelpersFunctions::success(true, "Attendance Is Done", 200);
            } else {
                return HelpersFunctions::success(false, "Attendance Is Not Done", 200);
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function leave_demand(Request $request)
    {
        return $this->leave_demand_for_all($request);
    }
    public function surfing_salary()
    {
        return $this->surfing_salary_for_all();
    }
    public function get_last_activity()
    {
        return  $this->get_last_activity_for_all();
    }
    public function Add_Activity(StoreActivityRequest $request)
    {


        try {
            $data = $request->validated();
            DB::beginTransaction();
            // Create Record Activity
            $activity = new Activity();
            $activity->Title = $data['Title'];
            $activity->class_room_id = $data['class_room_id'] ?? null;
            $activity->education_level_id = $data['education_level_id'] ?? null;
            $activity->Description = $data['Description'];
            $activity->activity_type = $data['activity_type'];
            $activity->date = $data['date'];
            $activity->location = $data['location'] ?? null;
            $activity->target_group = $data['target_group'];
            $activity->is_paid = $data['is_paid'];
            $activity->cost = $data['cost'] ?? null;
            $activity->seats_limit = $data['seats_limit'] ?? null;
            $activity->registration_deadline = $data['registration_deadline'];
            $activity->is_open = $data['is_open'] ?? true;
            $activity->auto_filter_participants = $data['auto_filter_participants'];
            $activity->required_skills = $data['required_skills'] ?? null;
            $activity->term_id = HelpersFunctions::getCurrentTermId();
            // 'gallery_urls' => $data['gallery'] ?? null,
            //  Upload Files Of Activity
            $gallery_urls = [];
            if ($request->hasFile('gallery')) {
                $counter = 0;
                foreach ($request->file('gallery') as $key =>  $file) {
                    $file_name = time() . $counter++ . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/Activity/gallery_urls/'), $file_name);
                    $gallery_urls[$key] = 'uploads/Activity/gallery_urls/' .  $file_name;
                }
            }
            // dd($gallery_urls);

            $activity->gallery_urls = $gallery_urls;
            $activity->save();
            $activity->required_skills = $request->has('required_skills')
                ? $request->required_skills
                : null;
            $requiredSkills = $activity->required_skills;
            $activity->save();
            // $activity->gallery_urls = json_decode($activity->gallery_urls);
            // Here We Will Add Send Notifications For Class Student Users That Is New Activity Is Added

            $student = collect();
            switch ($activity->target_group) {
                case 'all':
                    $student = Student_profile::with('student.user')->get();
                    break;
                case 'class':
                    $student = Student_profile::whereHas('student', function ($query) use ($activity) {
                        $query->where('class_id', $activity->class_room_id);
                    })->with('student.user')->get();
                    break;
                case 'stage':
                    $student = Student_profile::where('education_level_id', $activity->education_level_id)
                        ->with('student.user')->get();
                    break;
                case 'specific':
                    // Supervisor will send Ids For users want to notify them 
                    break;
            }
            // Filter Students As There Skills
            $filtered_students = $student->filter(function ($profile) use ($requiredSkills) {
                if (empty($requiredSkills)) {
                    return true;
                }
                $student_skills = $profile->skills ?? [];
                return !empty(array_intersect($requiredSkills, $student_skills));
            });
            // 
            $users = $filtered_students->pluck('student.user')->filter();
            if ($users->isNotEmpty()) {
                Notification::send($users, new NewActivity($activity));
            }
            // Send Event 
            event(new AddedActivityEvent($activity));

            DB::commit();
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Adding Activity",
                'date' => now()->format('Y-m-h'),
            ])->log("Adding Activity");
            return HelpersFunctions::success($activity, "Activity Add Done", 200);
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage() . $e->getLine());
        }
    }
    public function edit_Activity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activity_id' => 'required|exists:activities,id',
            'Title' => 'nullable|string|max:255',
            'class_room_id' => 'nullable|exists:class_rooms,id',
            'education_level_id' => 'nullable|exists:education_levels,id',
            'Description' => 'nullable|string',
            'activity_type' => 'nullable|in:trip,sports,art,competition,course,other',
            'date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'target_group' => 'nullable|in:all,class,stage,specific',
            'is_paid' => 'nullable|boolean',
            'cost' => 'nullable|integer',
            'seats_limit' => 'nullable|integer',
            'registration_deadline' => 'nullable|date',
            'is_open' => 'boolean',
            'auto_filter_participants' => 'nullable|boolean',
            'required_skills' => 'nullable|array',
            'required_skills.*' => 'string',
            'gallery' => 'nullable|array',
            'gallery.*' => 'file|mimes:mp4,jpeg,jpg,png,pdf|max:20480|max:20480',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request ", 400, $validator->errors());
        }
        try {
            DB::beginTransaction();
            // Create Record Activity
            $activity = Activity::find($request->activity_id);
            $activity->Title = $request->Title ??  $activity->Title;
            $activity->class_room_id = $request->class_room_id ??  $activity->class_room_id;
            $activity->education_level_id = $request->education_level_id ??  $activity->education_level_id;
            $activity->Description = $request->Description ??  $activity->Description;
            $activity->activity_type = $request->activity_type ??  $activity->activity_type;
            $activity->date = $request->date ??  $activity->date;
            $activity->location = $request->location ??  $activity->location;
            $activity->target_group = $request->target_group ??  $activity->target_group;
            $activity->is_paid = $request->is_paid ??  $activity->is_paid;
            $activity->cost = $request->cost ??  $activity->cost;
            $activity->seats_limit = $request->seats_limit ??  $activity->seats_limit;
            $activity->registration_deadline = $request->registration_deadline ??  $activity->registration_deadline;
            $activity->is_open = $request->is_open ??  $activity->is_open;
            $activity->auto_filter_participants = $request->auto_filter_participants ??  $activity->auto_filter_participants;
            $activity->required_skills = $request->required_skills ??  $activity->required_skills;
            $activity->term_id = HelpersFunctions::getCurrentTermId();
            // 'gallery_urls' => $data['gallery'] ?? null,
            //  Upload Files Of Activity
            $gallery_urls = [];
            if ($request->hasFile('gallery')) {
                $counter = 0;
                foreach ($request->file('gallery') as $key =>  $file) {
                    $file_name = time() . $counter++ . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/Activity/gallery_urls/'), $file_name);
                    $gallery_urls[$key] = 'uploads/Activity/gallery_urls/' .  $file_name;
                }
                $activity->gallery_urls = $gallery_urls;
            }
            // dd($gallery_urls);
            $activity->save();
            // $activity->required_skills = $request->has('required_skills')
            //     ? $request->required_skills
            //     : null;
            $requiredSkills = $activity->required_skills;
            // $activity->save();
            // $activity->gallery_urls = json_decode($activity->gallery_urls);
            // Here We Will Add Send Notifications For Class Student Users That Is New Activity Is Added

            $student = collect();
            switch ($activity->target_group) {
                case 'all':
                    $student = Student_profile::with('student.user')->get();
                    break;
                case 'class':
                    $student = Student_profile::whereHas('student', function ($query) use ($activity) {
                        $query->where('class_id', $activity->class_room_id);
                    })->with('student.user')->get();
                    break;
                case 'stage':
                    $student = Student_profile::where('education_level_id', $activity->education_level_id)
                        ->with('student.user')->get();
                    break;
                case 'specific':
                    // Supervisor will send Ids For users want to notify them 
                    break;
            }
            // Filter Students As There Skills
            $filtered_students = $student->filter(function ($profile) use ($requiredSkills) {
                if (empty($requiredSkills)) {
                    return true;
                }
                $student_skills = $profile->skills ?? [];
                return !empty(array_intersect($requiredSkills, $student_skills));
            });
            // 
            $users = $filtered_students->pluck('student.user')->filter();
            if ($users->isNotEmpty()) {
                Notification::send($users, new UpdatedActivityNotification($activity));
            }
            // Send Event 
            event(new updatedActivityEvent($activity));

            DB::commit();
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Editing Activity",
                'date' => now()->format('Y-m-h'),
            ])->log("Editing Activity");
            return HelpersFunctions::success($activity, "Activity Add Done", 200);
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage() . $e->getLine());
        }
    }
    public function delete_Activity($id)
    {
        try {
            $activity = Activity::find($id);
            if (!$activity) {
                return HelpersFunctions::error("bad Request", 400, "Activity Not Found");
            }
            $activity->delete();
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "deleteing Activity",
                'date' => now()->format('Y-m-h'),
            ])->log("deleteing Activity");

            return HelpersFunctions::success("", "deleting  Activity Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage() . $e->getLine());
        }
    }
    public function Add_student_profile_data(StoreStudentProfileRequest $request)
    {
        try {
            $supervisor = Supervisor::where('user_id', auth('sanctum')->id())->first();
            $student = Student::find($request->student_id);
            // $educationLevel = Education_level::findOrFail($request->education_level_id);
            // dd($user . $supervisor  . $educationLevel);
            if ($student->profile->education_level_id != $supervisor->education_level->id) {
                return HelpersFunctions::success("Access Diened", "you dont have permission to update this user", 200);
            }
            // updating data IN student profile record 
            $profile = Student_profile::updateOrCreate(
                ['student_id' => $request->student_id],
                [
                    'behavior_notes' => $request->behavior_notes,
                    'health_notes' => $request->health_notes,
                    'interests' => $request->interests,
                    'activities_participated' => $request->activities_participated,
                    'achievements' => $request->achievements,
                    'skills' => $request->skills,
                    'education_level_id' => $student->profile->education_level_id, // تضمن بقاء المستوى كما هو
                ]
            );
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Add student profile data",
                'date' => now()->format('Y-m-h'),
            ])->log("Add_student_profile_data");
            return HelpersFunctions::success($profile, "Added Student_Profile Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage() . $e->getLine());
        }
    }
    public function Add_daily_student_absences(Request $request)
    {

        $validate = Validator::make($request->all(), [
            '*' => 'array',
            '*.*.student_id' => 'required|integer|exists:students,id',
            '*.*.excused' => 'required|boolean',
        ]);
        if ($validate->fails()) {
            return HelpersFunctions::error(" Invalid Data  Bad Request", 400, $validate->errors());
        } else {
            try {
                DB::beginTransaction();
                foreach ($request->all() as $ClassID => $AbsentStudents) {
                    foreach ($AbsentStudents as $student) {
                        $Attendance = new Student_attendance();
                        $Attendance->student_id = $student['student_id'];
                        $Attendance->class_room_id = $ClassID;
                        $Attendance->date = now()->toDateString();
                        $Attendance->excused = $student['excused'];
                        $Attendance->term_id = HelpersFunctions::getCurrentTermId();
                        $Attendance->save();
                        $student = Student::find($Attendance->student_id);
                        $student_profile = Student_profile::firstOrCreate(
                            ['student_id' => $Attendance->student_id],
                            ['student_id' => $student->id, 'education_level_id' => $student->class->education_level_id, 'total_absences' => 0, 'unexcused_absences' => 0]
                        );
                        $student_profile->total_absences++;
                        $student_profile->unexcused_absences = !$Attendance->excused ? $student_profile->unexcused_absences = $student_profile->unexcused_absences + 1 : $student_profile->unexcused_absences;
                        $student_profile->save();
                        // dd($student);
                        // $studentuser = $student->user;
                        // $studentuser->notify(new StudentAbsencesNotification($Attendance));
                        $parentuser = $student->parent;
                        $parentuser->notify(new StudentAbsencesNotification($Attendance->excused, $student->user->name));
                    }
                }
                DB::commit();
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "Add Daily Absences",
                    'date' => now()->format('Y-m-h'),
                ])->log("Add Daily Absences");
                return HelpersFunctions::success("", "regester Absence Students Done", 200);
            } catch (Exception $e) {
                return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
            }
        }
    }
    public function Show_Reports_For_Students()
    {
        try {
            $user = auth('sanctum')->user();
            // dd($user);
            $supervisoe_user = Supervisor::where('user_id', $user->id)->first();
            // dd($supervisoe_user);

            $reports = Student_profile::with('student.user')
                ->where('education_level_id', $supervisoe_user->education_level->id)
                ->get()
                ->map(function ($report) {
                    $studentData = $report->makeHidden(['student_id', 'education_level_id']);
                    return [
                        'Student_ID' => $report->student_id,
                        'education_level_ID' => $report->education_level_id,
                        [
                            "Student_data" => $studentData
                        ]
                    ];
                });
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Show Reports For Students",
                'date' => now()->format('Y-m-h'),
            ])->log("Show Reports For Students");

            return HelpersFunctions::success($reports, "Getting Students Data Done ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function Verify_Qr_Code(Request $request)
    {
        return $this->verifyQrCodeRequest($request, 'employee');
    }
    public function SendSpecificNotificationForUser(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'message' => 'required|string|max:1000',
            ]);
            $supervisor = auth('sanctum')->user();
            $user = User::find($request->user_id);
            $user->notify(new SupervisorNotification($request->message, $supervisor->naem));
            return HelpersFunctions::success("", "Notification mark As Read Done");
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error ", 500, $e->getMessage());
        }
    }
    public function get_Education_level()
    {
        try {
            $supervisor = auth('sanctum')->user()->supervisor->id;
            $education_level = Education_level::where('supervisor_id', $supervisor)->first();
            $subjects = $education_level->subjects;
            $Regesterations = $education_level->Regesterations;
            $classes = Class_room::where('education_level_id', $education_level->id)
                ->get();
            // Get All students IN Specific Education Level
            $students = collect();
            foreach ($classes as $class) {
                foreach ($class->students as $student) {
                    if (!$students->contains('id', $student->id)) {
                        $student->load('user');
                        $students->push($student);
                    }
                }
                unset($class->students);
            }
            // Get All Teachers IN Specific Education Level
            $teachers = collect();
            foreach ($classes as $class) {
                $class_sessions = Class_session::where('class_room_id', $class->id)->get();
                foreach ($class_sessions as $session) {
                    $teacher = Teacher::with('user')->where('id', $session->teacher_id)->first();
                    if ($teacher && !$teachers->contains('id', $teacher->id)) {
                        $teachers->push($teacher);
                    }
                }
            }
            $data =  [
                "education_Level" => $education_level,
                "subjects" => $subjects,
                "regesterations" => $Regesterations,
                "Teachers" => $teachers,
                "Classes" => $classes,
                "Students" => $students
            ];
            return HelpersFunctions::success($data, "Gettinf Education Level Data", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function get_activities()
    {
        try {
            $super = auth('sanctum')->user()->supervisor;
            $classes =  $super->education_level->classes;
            $activities = collect();
            $activities = Activity::where('education_level_id', $super->education_level->id)->get();
            foreach ($classes as $class) {
                $activities = $activities->merge($class->activities ?? []);
            }
            return HelpersFunctions::success($activities, "Activities fetched successfully", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function get_all_installment()
    {
        try {
            $supervisor = Supervisor::find(auth('sanctum')->user()->supervisor->id);
            $supervisor_education_level_id  = $supervisor->education_level->id;
            //  here I will get Array Of plan_Ids
            $plan_ids = Installment_Plan::where('education_level_id', $supervisor_education_level_id)->pluck('id');
            $installment_payments = Installment_payment::whereIn('installment_plan_id', $plan_ids)
                ->where('paid', 0)
                ->get();

            return HelpersFunctions::success($installment_payments, "Activities fetched successfully", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function pay_Installment($id)
    {
        try {
            DB::beginTransaction();
            $payment = Installment_payment::find($id);
            if (!$payment) {
                return HelpersFunctions::error("Installment payment not found", 404);
            }
            if ($payment->paid) {
                return HelpersFunctions::error("This installment has already been paid", 400);
            }
            $payment = Installment_payment::find($id);
            $payment->paid = true;
            $payment->payment_date = Carbon::now()->toDateString();
            $payment->save();
            $transaction = new Transaction();
            $transaction->payment_method = 'cash';
            $transaction->amount = $payment->amount;
            $transaction->type = 'in';
            $transaction->transaction_source = 'installment_student';
            $transaction->status = 'paid';
            $transaction->is_installment = true;
            $transaction->user_id = auth('sanctum')->user()->id;
            $transaction->save();
            DB::commit();
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Pay Installment",
                'date' => now()->format('Y-m-h'),
            ])->log("Pay Installment");
            return HelpersFunctions::success("", "pay Installment successfully", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    //  Notifications
    public function notificationss()
    {
        return $this->notifications();
    }
    public function markAsReads($id)
    {
        return $this->markAsRead($id);
    }
}
