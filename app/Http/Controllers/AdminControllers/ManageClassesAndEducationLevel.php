<?php

namespace App\Http\Controllers\AdminControllers;

use App\Events\ClassRoomCreated;
use App\Events\ClassRoomDeleted;
use App\Events\EducationLevelCreated;
use App\Events\EducationLevelDeleted;
use App\Events\SubjectCreated;
use App\Events\SubjectDeletedFromEducationLevel;
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
use App\Models\Academic_year;
use App\Models\Educationlevelsubject;
use App\Models\Installment_Plan;
use App\Models\Term;
use App\Notifications\SessionNotification;
use Dompdf\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity as ActivityLogs;

use function PHPUnit\Framework\isEmpty;

class ManageClassesAndEducationLevel extends Controller
{
    public function store_academic_year(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            Academic_year::where('is_current', true)->update(['is_current' => false]);

            $data['is_current'] = true;
            $academicYear = Academic_year::create($data);

            return HelpersFunctions::success($academicYear, "Creating acadimic year Done", 201);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error In  : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function store_term(Request $request)
    {
        try {
            $data = $request->validate([
                'academic_year_id' => 'required|exists:academic_years,id',
                'name' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date'
            ]);
            Term::where('is_current', true)->update(['is_current' => false]);
            $data['is_current'] = true;

            $term = Term::create($data);

            return HelpersFunctions::success($term, "Creating Term Done", 201);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error In  : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function make_installment_plan(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255 ',
                'education_level_id' => 'required|exists:education_levels,id',
                'number_of_installments' => 'required|integer',
                'count_of_days_per_each_installment' => 'required|integer',
                'description' => 'required|string'
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            }
            $plane = new  Installment_Plan();
            $plane->name = $request->name;
            $plane->education_level_id = $request->education_level_id;
            $plane->number_of_installments = $request->number_of_installments;
            $plane->count_of_days_per_each_installment = $request->count_of_days_per_each_installment;
            $plane->total_amount = Education_level::where('id', $request->education_level_id)->value('price');
            $plane->description = $request->description;
            $plane->save();
            return HelpersFunctions::success($plane, "Creating Plan Done", 200);
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error ", 500, $e->getMessage());
        }
    }
    public function edit_installment_plan(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'plan_id' => 'required|exists:installment_plans,id',
                'name' => 'nullable|max:255 ',
                'education_level_id' => 'nullable|exists:education_levels,id',
                'number_of_installments' => 'nullable|integer',
                'count_of_days_per_each_installment' => 'nullable|integer',
                'description' => 'nullable|string'
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            }
            $plane = Installment_Plan::find($request->plan_id);
            $plane->name = $request->name ?? $plane->name;
            $plane->education_level_id = $request->education_level_id ?? $plane->education_level_id;
            $plane->number_of_installments = $request->number_of_installments ?? $plane->number_of_installments;
            $plane->count_of_days_per_each_installment = $request->count_of_days_per_each_installment ?? $plane->count_of_days_per_each_installment;
            if ($request->education_level_id) {
                $plane->total_amount = Education_level::where('id', $request->education_level_id)->value('price');
            }
            $plane->description = $request->description ?? $plane->description;
            $plane->save();
            return HelpersFunctions::success($plane, "updating Plan Done", 200);
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error ", 500, $e->getMessage());
        }
    }
    public function get_installment_plans()
    {
        try {
            $plans = Installment_Plan::all();
            return HelpersFunctions::success($plans, "Getting Plans Done", 200);
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error ", 500, $e->getMessage());
        }
    }
    public function delete_installment_plan($id)
    {
        try {
            $plan = Installment_Plan::find($id);
            if (!$plan) {
                return HelpersFunctions::error("Bad Request", 400, "Plan You Entered Not Exist");
            }
            $plan->delete();
            return HelpersFunctions::success("", "Deleting Plan Done", 200);
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal Server Error ", 500, $e->getMessage());
        }
    }


    public function Get_dash_data()
    {
        try {
            // $students = Student::count();
            // $teachers = Teacher::count();
            // $supervisors = Supervisor::count();

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
                // 'students' => $students,
                // 'teachers' => $teachers,
                // 'supervisors' => $supervisors,
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
            $el = Education_level::where('academic_year_id', HelpersFunctions::getCurrentAcademicYearId())->get();
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
        $el = Education_level::find($id);
        // dd($el);
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
                // 'Acadimic_year' => 'required|date',
                'description' => 'max:1024',
                'price' => 'required|integer',
                'supervisor_id' => 'required | exists:supervisors,id'
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            } else {
                $el = new Education_level();
                $el->name = $request->input('name');
                $el->description = $request->input('description');
                // $el->Acadimic_year = $request->input('Acadimic_year');
                $el->price = $request->input('price');
                $el->supervisor_id = $request->input('supervisor_id');
                $el->is_fully = false;
                $el->academic_year_id = HelpersFunctions::getCurrentAcademicYearId();
                $el->save();
                // Release Event 
                event(new EducationLevelCreated($el));
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
                event(new EducationLevelDeleted($id));
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
                // broad cast event() 
                event(new ClassRoomCreated($class));
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
    public function get_classes()
    {
        try {
            $classes = Class_room::all();
            return HelpersFunctions::success($classes, "Getting classes Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
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
                event(new ClassRoomDeleted($id, $class->education_level_id));
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
                event(new SubjectCreated($subject));
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
    public function  delete_subject_from_education_level(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|exists:subjects,id',
            'education_level_id' => 'required|exists:education_levels,id',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request", 400, $validator->errors());
        }
        try {
            Educationlevelsubject::where([
                'education_level_id' => $request->education_level_id,
                'subject_id' => $request->subject_id
            ])->delete();
            event(new SubjectDeletedFromEducationLevel(Subject::find($request->subject_id), $request->education_level_id));
            return HelpersFunctions::success("", "deleting subject done", 200);
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
                return HelpersFunctions::error('Bad Request', 400, $validator->errors());
            } else {
                // Check If Teacher is  have fully slessons 
                $Teacher = Teacher::where('id', $request->input('teacher_id'))->first();
                $count_lessons = $Teacher->sessions->count();
                if ($Teacher->number_of_lesson_in_week <= $count_lessons) {
                    return HelpersFunctions::success(null, "I dont Add The Session Because Teacher Have Fully Sessions", 200);
                }
                // Chech If Teacher Is Available At Same (Time && day)
                $teacher_Av = true;
                $teacher_sessions = $Teacher->sessions;
                // dd($teacher_sessions);
                foreach ($teacher_sessions as $session) {
                    if (
                        $session->session_day === $request->input('day') &&
                        Carbon::parse($request->input('start_time'))->lt(Carbon::parse($session->end_time)) &&
                        Carbon::parse($request->input('end_time'))->gt(Carbon::parse($session->start_time)) //->format('H:i:s')
                    ) {
                        $teacher_Av = false;
                        break;
                    }
                }
                // Check If Class Is Available At Same (Time && day)
                $class_Av = true;
                $Class = Class_room::where('id', $request->input('class_id'))->first();
                $class_sessions = $Class->sessions;
                foreach ($class_sessions as $session) {
                    if (
                        $session->session_day ==  $request->input('day') &&
                        Carbon::parse($request->input('start_time'))->lt(Carbon::parse($session->end_time)) &&
                        Carbon::parse($request->input('end_time'))->gt(Carbon::parse($session->start_time))
                    ) {
                        $class_Av = false;
                        break;
                    }
                }
                if ($class_Av == false) {
                    return HelpersFunctions::error('Add Session Failed', 400, "Class That You Entered Have Another Session in This Time ");
                } else if ($teacher_Av == false) {
                    return HelpersFunctions::error('Add Session Failed', 400, "Teacher That You Entered Have Another Session in This Time ");
                } else {
                    DB::beginTransaction();
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
                    $teacher->number_of_lesson_in_week++;
                    $teacher->save();
                    $subject = subject::findOrFail($teacher->subject_id);
                    activity()->causedBy($user)->withProperties([
                        'Process_type' => " Add Session ",
                    ])->log("Admin Add Session ");
                    // Send Notifications To Users For Updated Data 
                    $students = Student::where('class_id', $request->input('class_id'))->get();
                    $studentUsers = $students->map(function ($student) {
                        return $student->user;
                    })->filter();
                    $class_session_data = [
                        'session_day' => $class_session->session_day,
                        'start_time' =>    $class_session->start_time,
                        'end_time' =>   $class_session->end_time,
                        'teacher' =>    $teacher,
                        'subject' =>  $subject
                    ];
                    $teacher->user->notify(new SessionNotification($class_session_data));
                    Notification::send($studentUsers, new SessionNotification($class_session_data));

                    DB::commit();
                    return HelpersFunctions::success($class_session_data, "Add Session Successfully", 200);
                }
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error  ", 500, $e->getMessage());
        }
    }
    public function get_all_sessions()
    {
        try {
            $sessions = Class_session::with(['class', 'teacher.user', 'teacher.subject'])->get()->map(function ($session) {
                return [
                    'id' => $session->id,
                    'day' => $session->session_day,
                    'start' => $session->start_time,
                    'end' => $session->end_time,
                    'class_name' => optional($session->class)->name,
                    'teacher_name' => optional(optional($session->teacher)->user)->name,
                    'subject_name' => optional(optional($session->teacher)->subject)->name,
                ];
            });
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
