<?php

namespace App\Http\Controllers\SupervisorControllers;

use App\Helpers\HelpersFunctions;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\StoreStudentProfileRequest;
use App\Models\Activity;
use App\Models\Class_room;
use App\Models\Student_profile;
use App\Models\Education_level;
use App\Models\Qr_Code;
use App\Models\Staff_attendance;
use App\Models\Student;
use App\Models\Student_attendance;
use App\Models\Supervisor;
use App\Models\User;
use App\Notifications\NewActivity;
use App\Notifications\StudentAbsencesNotification;
use App\Notifications\SupervisorNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Spatie\Activitylog\Models\Activity as ActivityLog;

class SupervisorProcessesController extends Controller
{
    public function get_last_activity()
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
    public function Add_Activity(StoreActivityRequest $request)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();
            //  Upload Files Of Activity
            $gallery_urls = [];

            if ($request->hasFile('gallery')) {
                $counter = 0;
                foreach ($request->file('gallery') as $file) {

                    $file_name = time() . $counter++ . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/Activity/gallery_urls/'), $file_name);
                    $gallery_urls[] = 'uploads/Activity/gallery_urls/' .  $file_name;
                }
            }
            // Create Record Activity
            $activity = Activity::create([
                'Title' => $data['Title'],
                'class_room_id' => $data['class_room_id'] ?? null,
                'education_level_id' => $data['education_level_id'] ?? null,
                'Description' => $data['Description'],
                'activity_type' => $data['activity_type'],
                'date' => $data['date'],
                'location' => $data['location'] ?? null,
                'target_group' => $data['target_group'],
                'is_paid' => $data['is_paid'],
                'cost' => $data['cost'] ?? null,
                'seats_limit' => $data['seats_limit'] ?? null,
                'registration_deadline' => $data['registration_deadline'],
                'is_open' => $data['is_open'] ?? true,
                'auto_filter_participants' => $data['auto_filter_participants'],
                'required_skills' => $data['required_skills'] ?? null,
            ]);
            $activity->required_skills = $request->has('required_skills')
                ? json_encode($request->required_skills)
                : null;
            $activity->gallery_urls = json_encode($gallery_urls);
            $activity->save();
            $activity->gallery_urls = json_decode($activity->gallery_urls);
            // Here We Will Add Send Notifications For Class Student Users That Is New Activity Is Added
            $requiredSkills = $activity->required_skills ? json_decode($activity->required_skills, true) : [];
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
            return HelpersFunctions::success($activity, "Activity Add Done", 200);
            DB::commit();
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage() . $e->getLine());
        }
    }
    public function Add_student_profile_data(StoreStudentProfileRequest $request)
    {
        try {
            $supervisor = Supervisor::where('user_id', auth()->id())->first();
            $educationLevel = Education_level::findOrFail($request->education_level_id);
            // dd($user . $supervisor  . $educationLevel);
            if ($educationLevel->supervisor_id != $supervisor->id) {
                return HelpersFunctions::error("Access Diened", 403, "you dont have permission to update this user ");
            }
            $profile  = Student_profile::create($request->validated());
            return HelpersFunctions::success($profile, "Added Student_Profile Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage() . $e->getLine());
        }
    }
    // اضافة غياب الطلاب اليومي 
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
                        $studentuser = $student->user;
                        $studentuser->notify(new StudentAbsencesNotification($Attendance));
                        // $parentuser = $student->parent;
                        // $parentuser->notify(new StudentAbsencesNotification($Attendance));
                    }
                }
                DB::commit();
                return HelpersFunctions::success("", "regester Absence Students Done", 200);
            } catch (Exception $e) {
                return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
            }
        }
    }
    public function Show_Reports_For_Students()
    {
        try {
            $reports = Student_profile::all()->map(function ($report) {
                $report->load('student.user');
                return $report;
            });
            return HelpersFunctions::success($reports, "Getting Students Data Done ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function Verify_Qr_Code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unique_code' => 'required|exists:qr_codes,Unique_code',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request", 400, $validator->errors());
        }
        $qr = Qr_Code::where([
            'Unique_code' => $request->input('unique_code'),
            'Code_type' => 'employee'
        ])->first();
        if (!$qr) {
            return HelpersFunctions::error("Sorry Qr Code Is Wrong", 400, "Qr that you Entered Not Found ");
        } elseif ($qr->expires_at < Carbon::now()) {
            return HelpersFunctions::error("Sorry Qr Code Is Expired", 400, "Qr that you Entered is Expired");
        } else {
            DB::beginTransaction();
            $emloyee_attendance = new  Staff_attendance();
            $emloyee_attendance->QR_id = $qr->id;
            $emloyee_attendance->QR_id = auth()->id();
            $emloyee_attendance->Attendance_status = 'present';
            $emloyee_attendance->nots = null;
            $emloyee_attendance->save();
            DB::commit();
            return HelpersFunctions::success($emloyee_attendance, "Regester Attendance Done", 200);
        }
    }
    public function notifications()
    {
        $notifications = auth('sanctum')->user()->notifications;
        return HelpersFunctions::success($notifications, "Getting Notifications Done ", 200);
    }
    public function markAsRead($id)
    {
        $notification = auth('sanctum')->user()->notifications->where('id', $id)->first();
        if (!$notification) {
            return HelpersFunctions::error("bad Request", 400, "Notification not found");
        }
        $notification->markAsRead();
        return HelpersFunctions::success("", "Notification mark As Read Done");
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
}
