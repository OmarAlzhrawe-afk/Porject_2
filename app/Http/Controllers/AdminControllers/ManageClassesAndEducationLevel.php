<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Class_room;
use App\Models\Class_session;
use App\Models\Education_level;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Supervisor;
use Exception;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Helpers\HelpersFunctions;
use Dompdf\Helpers;
use Spatie\Activitylog\Models\Activity as ActivityLogs;

class ManageClassesAndEducationLevel extends Controller
{
    public function Get_dash_data()
    {
        try {
            $students = Student::count();
            $teachers = Teacher::count();
            $supervisors = Supervisor::count();

            $user = auth('sanctum')->user(); // 
            if (!$user) {
                return HelpersFunctions::error("Unauthorized", 401, "No user authenticated");
            }

            $recent_activity = ActivityLogs::where('causer_type', User::class)
                ->where('causer_id', $user->id)
                ->latest()
                ->take(4)
                ->get();

            $data = [
                'students' => $students,
                'teachers' => $teachers,
                'supervisors' => $supervisors,
                'recent_activity' => $recent_activity
            ];
            //Enrolling Admin Log
            return HelpersFunctions::success($data, "Getting data Done ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("internal Server Error ", 500, $e->getMessage());
        }
    }
    public function get_All_education_level()
    {
        try {
            $el = Education_level::all();
            // Add Process To Recent 
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "get all education level",
            ])->log("Get All Education Level");
            return HelpersFunctions::success($el, "Getting Education Levels Successfully", 200);
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error ", 500, $e->getMessage());
        }
    }
    public function get_education_level_data($id)
    {
        $el = Education_level::findOrFail($id);
        $subjects = $el->subjects;
        $Regesterations = $el->Regesterations;
        $classes = Class_room::where('education_level_id', $id)->get();
        $supervisor =  Supervisor::find($el->supervisor_id);
        // Get All Teachers IN Specific Education Level
        $teachers = collect();
        foreach ($classes as $class) {
            $class_sessions = Class_session::where('class_room_id', $class->id)->get();
            foreach ($class_sessions as $session) {
                $teacher = Teacher::find($session->teacher_id);
                if ($teacher && !$teachers->contains('id', $teacher->id)) {
                    $teachers->push($teacher);
                }
            }
        }
        $data =  [
            "education_Level" => $el,
            'supervisor' => $supervisor->user,
            "subjects" => $subjects,
            "regesterations" => $Regesterations,
            "Classes" => $classes,
            "Teachers" => $teachers
        ];
        //Enrolling Admin Log
        $admin = auth()->user('sanctum');
        activity()->causedBy($admin)->withProperties([
            'Process_type' => "get_education_level_data",
        ])->log("get_education_level_data");
        return HelpersFunctions::success($data, "Getting Education Level Data", 200);
    }
    public function create_education_level(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255 ',
                'description' => 'max:1024',
                'supervisor_id' => 'required | exists:supervisors,id'
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            } else {
                $el = new Education_level();
                $el->name = $request->input('name');
                $el->description = $request->input('description');
                $el->supervisor_id = $request->input('supervisor_id');
                $el->save();
                // Add Process To Recent 
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "Send Forget Password Code",
                ])->log("Admin Send Forget Password Code");
                return HelpersFunctions::success($el, "Created Education Level Successfully", 200);
            }
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error ", 500, $e->getMessage());
        }
    }
    public function delete_education_level($id)
    {

        try {
            $education_level = Education_level::find($id);
            if (!$education_level) {
                return HelpersFunctions::error("Education Level Not Found", 404, "");
            } else {
                $education_level->delete();
                return HelpersFunctions::success("", "Deleted Education Level Done", 200);
            }
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function add_class_for_education_level(Request $request)
    {
        try {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'level_id' => 'required | exists:education_levels,id',
                'name' => 'required',
                'capacity' => 'required', //',
                'current_count' => 'required',
                'floor' => 'required'
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            } else {
                $class = new Class_room();
                $class->education_level_id = $request->input('level_id');
                $class->name = $request->input('name');
                $class->capacity = $request->input('capacity');
                $class->current_count = $request->input('current_count');
                $class->floor = $request->input('floor');
                $class->save();
                // Add Process To Recent 
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => " Add class Education Level ",
                ])->log(" Add class Education Level ");
                return HelpersFunctions::success($class, "Created Class Successfully", 200);
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error ", 500, $e->getMessage());
        }
    }
    public function delete_class_for_education_level($id)
    {

        try {
            $class = Class_room::find($id);
            if (!$class) {
                return HelpersFunctions::error("Class Not Found", 404, "");
            } else {
                $class->delete();
                return HelpersFunctions::success("", "Deleted Class Done", 200);
            }
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function add_subject_for_education_level(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'level_id' => 'required | exists:education_levels,id',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->fails());
            } else {
                $subject = new Subject();
                $subject->name = $request->input('name');
                $subject->save();
                $subject->educationalLevels()->attach($request->level_id);
                // Add Process To Recent 
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => " Add class Education Level ",
                ])->log(" Add class Education Level ");
                return HelpersFunctions::success($subject, "Created Class Successfully", 200);
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error ", 500, $e->getMessage());
        }
    }
    public function  delete_subject($id)
    {

        try {
            $subject = Subject::find($id);
            if (!$subject) {
                return HelpersFunctions::error("Subject Not Found", 404, "");
            } else {
                $subject->delete();
                return HelpersFunctions::success("", "Deleted Subject Done", 200);
            }
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }

    public function get_all_subjects_with_his_data()
    {
        try {
            $subjects = Subject::with(['teachers.user', 'educationalLevels'])->get();
            // dd($subjects);
            return response()->json([
                "data" => $subjects,
                "message" => "Getting Subjects Done"
            ], 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error ", 500, $e->getMessage());
        }
    }
    public function add_session_for_class_room(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'teacher_id' =>  'required|exists:teachers,id',
                'class_id' =>  'required|exists:class_rooms,id',
                'start_time' =>  'required|date_format:H:i',
                'end_time' =>  'required|date_format:H:i|after:start_time ',
                'day' =>  'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'Failed' => "Error",
                    'message' => $validator->errors()
                ]);
            } else {
                // Chech If Teacher Is Available At Same (Time && day)
                $teacher_Av = true;
                $Teacher = Teacher::where('id', $request->input('teacher_id'))->first();
                $teacher_sessions = $Teacher->sessions;
                // dd($teacher_sessions);
                foreach ($teacher_sessions as $session) {
                    if (
                        $session->session_day === $request->input('day') &&
                        $session->start_time == Carbon::parse($request->input('start_time'))->format('H:i:s')
                    ) {
                        $teacher_Av = false;
                        break;
                    }
                }
                // Chech If Class Is Available At Same (Time && day)
                $class_Av = true;
                $Class = Class_room::where('id', $request->input('class_id'))->first();
                $class_sessions = $Class->sessions;
                foreach ($class_sessions as $session) {
                    if (
                        $session->session_day ==  $request->input('day') &&
                        $session->start_time == Carbon::parse($request->input('start_time'))->format('H:i:s')
                    ) {
                        $class_Av = false;
                        break;
                    }
                }
                if ($class_Av == false) {
                    return response()->json([
                        'message' => "Add Session Failed",
                        'reason' => "Class That You Entered Have Another Session in This Time "
                    ]);
                } else if ($teacher_Av == false) {
                    return response()->json([
                        'message' => "Add Session Failed",
                        'reason' => "Teacher That You Entered Have Another Session in This Time "
                    ]);
                } else {
                    $class_session = new Class_session();
                    $class_session->teacher_id = $request->input('teacher_id');
                    $class_session->class_room_id = $request->input('class_id');
                    $class_session->session_day = $request->input('day');
                    $class_session->start_time = $request->input('start_time');
                    $class_session->end_time = $request->input('end_time');
                    $class_session->save();
                    // Add Process To Recent 
                    $user = auth('sanctum')->user();

                    $teacher = Teacher::findOrFail($class_session->teacher_id);
                    $subject = subject::findOrFail($teacher->subject_id);
                    $class_session_data = [
                        'session_day' => $class_session->session_day,
                        'start_time' =>    $class_session->start_time,
                        'end_time' =>   $class_session->end_time,
                        'teacher' =>    $teacher,
                        'subject' =>  $subject
                    ];
                    activity()->causedBy($user)->withProperties([
                        'Process_type' => " Add Session ",
                    ])->log("Admin Add Session ");
                    return HelpersFunctions::success($class_session_data, "Add Session Successfully", 200);
                }
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error  ", 500, $e->getMessage());
        }
    }
    public function get_all_sessions($class_id)
    {
        try {
            $sessions = Class_session::where('class_room_id', $class_id)->get();
            return HelpersFunctions::success($sessions, "Getting Sessions Done ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function  delete_session($id)
    {
        try {
            $session = Class_session::find($id);
            if (!$session) {
                return HelpersFunctions::error("Session Not Found", 404, "");
            } else {
                $session->delete();
                return HelpersFunctions::success("", "Deleted Session Done", 200);
            }
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
}
