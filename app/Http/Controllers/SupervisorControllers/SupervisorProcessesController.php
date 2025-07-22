<?php

namespace App\Http\Controllers\SupervisorControllers;

use App\Helpers\HelpersFunctions;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\StoreStudentProfileRequest;
use App\Models\Activity;
use App\Models\Student_profile;
use App\Models\Student;
use App\Models\Education_level;
use App\Models\Student_attendance;
use App\Models\Supervisor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SupervisorProcessesController extends Controller
{

    public function Add_Activity(StoreActivityRequest $request)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();
            //  Upload Files Of Activity
            if ($request->hasFile('gallery')) {
                $gallery_urls = [];
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
            return HelpersFunctions::success($activity, "Activity Add Done", 200);
            DB::commit();
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
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
                // dd($request->all());
                foreach ($request->all() as $ClassID => $AbsentStudents) {
                    foreach ($AbsentStudents as $student) {
                        $Attendance = new Student_attendance();
                        $Attendance->student_id = $student['student_id'];
                        $Attendance->class_room_id = $ClassID;
                        $Attendance->date = now()->toDateString();
                        $Attendance->excused = $student['excused'];
                        // dd("before save");
                        $Attendance->save();
                        // dd("after save");
                        $student_profile = Student_profile::where('student_id', $Attendance->student_id)->first();
                        $student_profile->total_absences++;
                        $student_profile->unexcused_absences = !$Attendance->excused ? $student_profile->unexcused_absences = $student_profile->unexcused_absences + 1 : $student_profile->unexcused_absences;
                        $student_profile->save();
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
}
