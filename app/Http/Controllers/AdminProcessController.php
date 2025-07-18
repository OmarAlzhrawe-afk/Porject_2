<?php

namespace App\Http\Controllers;

use SimpleXMLElement;

use Illuminate\Support\Facades\DB;
use App\Mail\AcceptedSchoolMail;
use App\Mail\RejectedSchoolMail;
use App\Models\Class_room;
use App\Models\Class_session;
use App\Models\Education_level;
use App\Models\Pre_registration;
use App\Models\Public_content;
use App\Models\Qr_Code;
use App\Models\School_post;
use App\Models\Staff_leaves;
use App\Models\Staff_salary_deductions;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Supervisor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Barryvdh\DomPDF\Facade\Pdf;
// use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Helpers\ApiResponse;
use App\Helpers\HelpersFunctions;
use App\Models\Activity;
use App\Models\Class_teacher;
use Sabberworm\CSS\Value\Size;
use Spatie\Activitylog\Models\Activity as ActivityLogs;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\at;

class AdminProcessController extends Controller
{


    // Test 
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
        $classes = Class_room::where('education_level_id', $id);
        // Get All Teachers IN Specific Education Level
        $teachers = collect();
        foreach ($classes as $class) {
            $class_sessions = Class_session::where('class_id', $class->id)->get();
            foreach ($class_sessions as $session) {
                $teacher = Teacher::find($session->teacher_id);
                if ($teacher && !$teachers->contains('id', $teacher->id)) {
                    $teachers->push($teacher);
                }
            }
        }
        $data =  [
            "education_Level" => $el,
            'supervisor' => $el->supervisor,
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
                return HelpersFunctions::error("Bad Request", 400, $validator->fails());
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
    // CRUD Public Content
    public function get_public_content()
    {
        try {
            $public_content = Public_content::all();
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "get_public_content",
            ])->log("Admin get_public_content");
            return HelpersFunctions::success($public_content, "Getting posts Successfully", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function add_PublicContent(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'content_type' =>  'required|in:about,vision,Frequently_asked_questions',
                'content' =>  'required',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Validation Error Bad Request", 400, $validator->errors());
            } else {
                $public_content = new Public_content();
                $public_content->content_type = $request->input('content_type');
                $public_content->content = $request->input('content');
                $public_content->save();
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "add_PublicContent",
                ])->log("Admin add_PublicContent");
                return HelpersFunctions::success(null, 'Content Added Successfully', 201);
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function update_PublicContent(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'content_id' =>  'required|exists:public_contents,id',
                'content_type' =>  'required|in:about,vision,Frequently_asked_questions',
                'content' =>  'required',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Validation Error Bad Request", 400, $validator->errors());
            } else {
                $public_content = Public_content::find($request->content_id)->first();
                $public_content->content_type = $request->input('content_type');
                $public_content->content = $request->input('content');
                $public_content->save();
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "update_PublicContent",
                ])->log("Admin update_PublicContent");
                return HelpersFunctions::success(null, 'Content Updated Successfully', 201);
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function delete_PublicContent($public_content_id)
    {
        try {
            $public_content = Public_content::where('id', $public_content_id)->first();
            if ($public_content) {
                $public_content->delete();
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "delete_PublicContent",
                ])->log("Admin delete_PublicContent");
                return HelpersFunctions::success(null, '', 204);
            } else {
                return HelpersFunctions::error("Bad Request", 400, "public Content that You Entered Is Not Found");
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    // CRUD Post
    public function get_Posts()
    {
        try {
            $posts = School_post::all();
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "get_Posts",
            ])->log("Admin get_Posts");
            return HelpersFunctions::success($posts, "Getting posts Successfully", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error ", $e->getMessage(), 500);
        }
    }
    public function add_Post(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' =>  'required',
                'description' =>  'required',
                'post_type' =>  'required|in:lesson,news,event',
                'file_url' =>  'required|file|mimes:jpg,jpeg,png,pdf,docx,mp4,mov,avi,wmv|max:2048 ',
                'is_public' =>  'required|in:true,false',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", $validator->errors(), 400);
            } else {
                $post = new School_post();
                $post->title = $request->input('title');
                $post->description = $request->input('description');
                $post->post_type = $request->input('post_type');
                if ($request->input('is_public' == 'true')) {
                    $post->is_public = true;
                } else {
                    $post->is_public = false;
                }
                if ($request->hasFile('file_url')) {
                    $file = $request->file('file_url');
                    $file_Name = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/Posts/'), $file_Name);
                    $post->file_url = 'uploads/Posts/' . $file_Name;
                }
                $post->save();
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "add_Post",
                ])->log("Admin add_Post");
                return HelpersFunctions::success(null, "Added Post Successfully", 200);
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error ", $e->getMessage(), 500);
        }
    }
    public function update_Post(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'post_id' =>  'required|exists:school_posts,id',
                'title' =>  'required',
                'description' =>  'required',
                'post_type' =>  'required|in:lesson,news,event',
                'file_url' =>  'required|file|mimes:jpg,jpeg,png,pdf,docx,mp4,mov,avi,wmv|max:2048 ',
                'is_public' =>  'required|in:true,false',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", $validator->errors(), 400);
            } else {

                $post = School_post::find($request->post_id)->first();
                $post->title = $request->input('title');
                $post->description = $request->input('description');
                $post->post_type = $request->input('post_type');
                if ($request->input('is_public' == 'true')) {
                    $post->is_public = true;
                } else {
                    $post->is_public = false;
                }
                if ($request->hasFile('file_url')) {
                    //Delete old File
                    $path = public_path($post->file_url);
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    //Store new file 
                    $file = $request->file('file_url');
                    $file_Name = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/Posts/'), $file_Name);
                    $post->file_url = 'uploads/Posts/' . $file_Name;
                }
                $post->save();
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "update_Post",
                ])->log("Admin update_Post");
                return HelpersFunctions::success(null, "Update Post Successfully", 200);
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error ", $e->getMessage(), 500);
        }
    }
    public function delete_Post($post_id)
    {
        try {
            $post = School_post::findOrFail($post_id);
            if ($post) {
                $post->delete();
                //Delete old File
                $path = public_path($post->file_url);
                if (File::exists($path)) {
                    File::delete($path);
                }
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "delete_Post",
                ])->log("Admin delete_Post");
                return HelpersFunctions::success(null, "", 204);
            } else {
                return HelpersFunctions::error("Bad Request", 400, "Post that you Eant Not Found ");
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error ", 500, $e->getMessage());
        }
    }
    // CRUD Any User
    public function get_all_users($type)
    {
        try {

            $users = User::all();
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "get_all_users",
            ])->log("Admin get_all_users");
            return HelpersFunctions::success($users, "Getting Users Successfully", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 400, $e->getMessage());
        }
    }
    public function add_User(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // User Data
                'name' =>  'required|string',
                'email' =>  'required|unique:users,email',
                'phone_number' =>  'required',
                'role' =>  'required',
                'birth_date' =>  'required|date',
                'address' =>  'required|string',
                'gender' =>  'required|in:male,Female',
                'ID_documents' =>  'required|array',
                'ID_documents.*' =>  'file|mimes:jpg,jpeg,png,pdf',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request Invalid data", 400, $validator->errors());
            } else {
                DB::beginTransaction();
                // Store User Data
                $user = new User();
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->phone_number = $request->input('phone_number');
                $user->birth_date = $request->input('birth_date');
                $user->role = $request->input('role');
                $user->address = $request->input('address');
                $user->gender = $request->input('gender');
                $user->save();
                // Store Id Files
                $docs = [];
                $counter = 0;
                foreach ($request->file('ID_documents') as $key => $file) {
                    $file_name = time() . $counter++ . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/users/IDs/' . $user->id . '/'), $file_name);
                    $docs[$key] = 'uploads/users/IDs/' . $user->id . '/' . $file_name;
                }
                $user->ID_documents = $docs;
                $user->save();
                $admin = auth('sanctum')->user();
                activity()->causedBy($admin)->withProperties([
                    'Process_type' => "add" .  $request->role,
                ])->log("add" .  $request->role); // 'admin', 'teacher', 'librarian', 'supervisor', 'student', 'parent'
                if ($request->role == 'teacher') {
                    $validatorteacher = Validator::make($request->all(), [
                        //  Teacher Data
                        'subject_id' =>  'required|exists:subjects,id',
                        'Academic_qualification' =>  'required',
                        'Employment_status' =>  'required|in:active,suspended,resigned',
                        'Payment_type' =>  'required|in:monthly,hourly',
                        'Contract_type' =>  'required|in:permanent,temporary,part_time',
                        'The_beginning_of_the_contract' =>  'required|date',
                        'End_of_contract' =>  'required|date',
                        'number_of_lesson_in_week' =>  'required',
                        'wages_per_lesson' =>  'required',
                    ]);
                    if ($validatorteacher->fails()) {
                        return HelpersFunctions::error("Bad Request Invalid data", 400, $validatorteacher->errors());
                    } else {
                        $teacher = new Teacher();
                        $teacher->user_id = $user->id;
                        $teacher->subject_id = $request->subject_id;
                        $teacher->Academic_qualification = $request->Academic_qualification;
                        $teacher->Employment_status = $request->Employment_status;
                        $teacher->Payment_type = $request->Payment_type;
                        $teacher->Contract_type = $request->Contract_type;
                        $teacher->The_beginning_of_the_contract = $request->The_beginning_of_the_contract;
                        $teacher->End_of_contract = $request->End_of_contract;
                        $teacher->number_of_lesson_in_week = $request->number_of_lesson_in_week;
                        $teacher->wages_per_lesson = $request->wages_per_lesson;
                        $teacher->save();
                    }
                } elseif ($request->role == 'supervisor') {
                    $validatorteacher = Validator::make($request->all(), [
                        //  Supervisor Data
                        'status' =>  'required|in:active,on_leave,resigned',
                    ]);
                    if ($validatorteacher->fails()) {
                        return HelpersFunctions::error("Bad Request Invalid data", 400, $validatorteacher->errors());
                    } else {
                        //  Store Supervisor Data
                        $supervisor = new Supervisor();
                        $supervisor->user_id = $user->id;
                        $supervisor->status = $request->status;
                        $supervisor->save();
                    }
                } elseif ($request->role == 'student') {
                    $validatorstudent = Validator::make($request->all(), [
                        //  Student Data
                        'status' =>  'required|in:active,suspended,graduated,left',
                        'class_id' =>  'required|exists:class_rooms,id',
                    ]);
                    if ($validatorstudent->fails()) {
                        return HelpersFunctions::error("Bad Request Invalid data", 400, $validatorstudent->errors());
                    } else {
                        //  Store Student Data
                        $student = new Student();
                        $student->user_id = $user->id;
                        $student->status = $request->status;
                        $student->save();
                    }
                }
                // Assign role based on type
                $user->assignRole($request->role);
                DB::commit();
                return HelpersFunctions::success("OK", " Created " . $user->role . " Successfully ", 201);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function update_User(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                //  User Data
                'user_id' =>  'required|exists:users,id',
                'email' =>  'required|email',
                'phone_number' =>  'required',
                'role' =>  'required|in:admin,teacher,librarian,supervisor,student,parent',
                'address' =>  'required|string',
                'ID_documents' =>  'required|array',
                'ID_documents.*' =>  'file|mimes:jpg,jpeg,png,pdf',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            } else {
                DB::beginTransaction();
                $user = User::findOrFail($request->user_id);
                $user->email = $request->input('email');
                $user->phone_number = $request->input('phone_number');
                $user->address = $request->input('address');
                // Store Id Files
                $docs = [];
                $counter = 0;
                $files_array = $user->ID_documents ?? [];
                foreach ($request->file('ID_documents') as $key => $file) {
                    if (isset($files_array[$key]) && file_exists(public_path($files_array[$key]))) {
                        unlink(public_path($files_array[$key]));
                    }
                    $file_name = time() . $counter++ . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/users/IDs/' . $user->id . '/'), $file_name);
                    $docs[$key] = 'uploads/users/IDs/' . $user->id . '/' . $file_name;
                }
                $user->ID_documents = $docs;
                $user->save();
                $admin = auth('sanctum')->user();
                activity()->causedBy($admin)->withProperties([
                    'Process_type' => "update" .  $request->role,
                ])->log("update" .  $request->role);
                if ($request->role == 'teacher') {
                    $validatorteacher = Validator::make($request->all(), [
                        //  Teacher Data
                        'Academic_qualification' =>  'required',
                        'Employment_status' =>  'required|in:active,suspended,resigned',
                        'Payment_type' =>  'required|in:monthly,hourly',
                        'Contract_type' =>  'required|in:permanent,temporary,part_time',
                        'The_beginning_of_the_contract' =>  'required|date',
                        'End_of_contract' =>  'required|date',
                        'number_of_lesson_in_week' =>  'required',
                        'wages_per_lesson' =>  'required',
                    ]);
                    if ($validatorteacher->fails()) {
                        return HelpersFunctions::error("Bad Request Invalid data", 400, $validatorteacher->errors());
                    } else {
                        $teacher = Teacher::where('user_id', $user->id)->first();
                        $teacher->Academic_qualification = $request->Academic_qualification;
                        $teacher->Employment_status = $request->Employment_status;
                        $teacher->Payment_type = $request->Payment_type;
                        $teacher->Contract_type = $request->Contract_type;
                        $teacher->The_beginning_of_the_contract = $request->The_beginning_of_the_contract;
                        $teacher->End_of_contract = $request->End_of_contract;
                        $teacher->number_of_lesson_in_week = $request->number_of_lesson_in_week;
                        $teacher->wages_per_lesson = $request->wages_per_lesson;
                        $teacher->save();
                    }
                } elseif ($request->role == 'supervisor') {
                    $validatorteacher = Validator::make($request->all(), [
                        //  Supervisor Data
                        'status' =>  'required|in:active,on_leave,resigned',
                    ]);
                    if ($validatorteacher->fails()) {
                        return HelpersFunctions::error("Bad Request Invalid data", 400, $validatorteacher->errors());
                    } else {
                        //  Store Supervisor Data
                        $supervisor = Supervisor::where('user_id', $user->id)->first();
                        $supervisor->status = $request->status;
                        $supervisor->save();
                    }
                } elseif ($request->role == 'student') {
                    $validatorstudent = Validator::make($request->all(), [
                        //  Student Data
                        'status' =>  'required|in:active,suspended,graduated,left',
                    ]);
                    if ($validatorstudent->fails()) {
                        return HelpersFunctions::error("Bad Request Invalid data", 400, $validatorstudent->errors());
                    } else {
                        //  Store Student Data
                        $student = Student::where('user_id', $user->id)->first();
                        $student->status = $request->status;
                        $student->save();
                    }
                }
                DB::commit();
                return HelpersFunctions::success("", "updated " . $user->role . " Successfully");
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function delete_User($user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            if ($user) {
                if ($user->role == 'teacher') {
                    $teacher = Teacher::findOrFail($user->id);
                    $teacher->delete();
                } elseif ($user->role == 'student') {
                    $student = Student::findOrFail($user->id);
                    $student->delete();
                } elseif ($user->role == 'supervisor') {
                    $supervisor = Supervisor::findOrFail($user->id);
                    $supervisor->delete();
                }
                foreach ($user->ID_documents as $key => $value) {
                    if (isset($files_array[$key]) && file_exists(public_path($files_array[$key]))) {
                        unlink(public_path($files_array[$key]));
                    }
                }
                $user->delete();
                $admin = auth('sanctum')->user();
                activity()->causedBy($admin)->withProperties([
                    'Process_type' => " delete" .  $user->role,
                ])->log("delete" .  $user->role);
                return HelpersFunctions::success('', "Deleted User Successfully ", 204);
            } else {
                return HelpersFunctions::error("User that you entered Not Found", 400, "null");
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    // Handle Pre_Registeration For Students
    public function get_all_pre_registeration()
    {
        try {
            $Registration_requests = Pre_registration::where('status', 'pending')->get();
            $admin = auth('sanctum')->user();
            activity()->causedBy($admin)->withProperties([
                'Process_type' => " get_all_pre_registeration",
            ])->log("get_all_pre_registeration");
            return HelpersFunctions::success($Registration_requests, "Getting data Successfully ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function Accept_pre_registeration($id)
    {
        try {
            $Registration = Pre_registration::where('id', $id)->first();
            $Registration->status = 'accepted';
            $Registration->save();
            // dd($Registration);
            $user = new User();
            $user->name = $Registration->student_name;
            $user->email = $Registration->student_email;
            $user->role = 'student';
            $user->hire_date = now();
            $user->phone_number = $Registration->phone_number;
            $user->save();
            $student = new Student();
            $student->user_id = $user->id;
            // $student->Student_number = '5'; Auto
            $student->status = 'active';
            $student->save();
            Mail::to($Registration->student_email)->send(new AcceptedSchoolMail("Accepted Student : " . $Registration->student_name));
            Mail::to($Registration->parent_email)->send(new AcceptedSchoolMail("Accepted Student : " . $Registration->student_name));
            return HelpersFunctions::success('', "student Accepted successfully", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function Reject_pre_registeration($id)
    {
        try {
            $Registration = Pre_registration::where('id', $id)->first();
            $Registration->status = 'rejected';
            $Registration->save();
            Mail::to($Registration->student_email)->send(new RejectedSchoolMail("Rejected Student : " . $Registration->student_name));
            Mail::to($Registration->parent_email)->send(new RejectedSchoolMail("Rejected Student : " . $Registration->student_name));
            $admin = auth('sanctum')->user();
            activity()->causedBy($admin)->withProperties([
                'Process_type' => " Reject_pre_registeration",
            ])->log("Reject_pre_registeration");
            return HelpersFunctions::success('', "student Rejected successfully", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    // Handle Leaves Order 
    public function get_all_Leaves_order()
    {
        try {
            $leaves = Staff_leaves::where('status', 'pending')->with('employee')->get();
            if ($leaves) {
                $admin = auth('sanctum')->user();
                activity()->causedBy($admin)->withProperties([
                    'Process_type' => " get_all_Leaves_order",
                ])->log("get_all_Leaves_order");
                return HelpersFunctions::success($leaves, "Getting Leaves Successfully", 200);
            } else {
                return HelpersFunctions::error("Bad Request", 400, 'Unfound Leaves Order');
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }

    public function Accept_Leave(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'leave_id'  =>  'required|exists:staff_leaves,id',
                'amount'  =>  'required|integer',
                'reason'  =>  'required|string',
            ]);
            if ($validate->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validate->errors());
            }
            $leave = Staff_leaves::FindOrFail($request->leave_id);
            $user = User::FindOrFail($leave->user_id);
            $deducation = new Staff_salary_deductions();
            $deducation->amount = $request->input('amount');
            $deducation->reason = $request->input('reason');
            $deducation->user_id = $user->id;
            $deducation->save();
            $leave->status = 'approved';
            $leave->save();
            // Send Notification To User 
            // $user->notify();
            $admin = auth('sanctum')->user();
            activity()->causedBy($admin)->withProperties([
                'Process_type' => " Accept_Leave",
            ])->log("Accept_Leave");
            return HelpersFunctions::success("", "Accept Leave Successfully", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function Reject_Leave($id)
    {
        try {
            $leave = Staff_leaves::FindOrFail($id);
            $user = User::FindOrFail($leave->user_id);
            if ($leave && $user) {
                $leave->status = 'rejected';
                $leave->save();
                // Send Notification To User 
                // $user->notify();
                $admin = auth('sanctum')->user();
                activity()->causedBy($admin)->withProperties([
                    'Process_type' => " Reject_Leave",
                ])->log("Reject_Leave");
                return HelpersFunctions::success("", "Reject Leave Successfully", 200);
            } else {
                return HelpersFunctions::error("Bad Request", 400, "Leave Not Found");
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }

    public function Generate_QR_For_Specific_Class(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'class_id' => 'required|exists:class_rooms,id',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $code = Str::uuid();
                $qr_code = new Qr_Code();
                $qr_code->class_id = $request->class_id;
                $qr_code->Unique_code = $code;
                $qr_code->expires_at = now()->addDays(7);
                $qr_code->Code_type = 'teacher';
                $qr_code->user_id = auth()->user()->id;
                $qr_code->save();
                $class = Class_room::findOrFail($qr_code->class_id);

                $svg = QrCode::format('svg')->size(300)->generate($code);
                return response($svg, 200)
                    ->header('Content-Type', 'image/svg+xml');
                // $qr = QrCode::format('svg')->size(300)->generate($code);
                // $qrImage = 'data:image/png;base64,' . base64_encode($qr);
                // $pdf = Pdf::loadView('Qr_codes.QRpdf', [
                //     'image' => $qrImage,
                //     'class_name'  => $class->name,
                // ]);
                // $pdfPath = 'qr_codes/QR_Code_Class_' . $qr_code->class_id . '.pdf';
                // Storage::disk('public')->put($pdfPath, $pdf->output());
                // $url = asset('storage/' . $pdfPath);
                // return response()->json([
                //     'message' => 'QR PDF generated successfully',
                //     'url' => $url
                // ]);
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function Generate_QR_For_All_Staff()
    {
        try {
            Qr_Code::where('Code_type', "employee")->delete();
            $code = Str::uuid();
            $qr_code = new Qr_Code();
            $qr_code->Unique_code = $code;
            $qr_code->expires_at = now()->addDays(7);
            $qr_code->Code_type = 'employee';
            $qr_code->user_id = auth()->user()->id;
            $qr_code->save();
            $svg = QrCode::format('svg')->size(300)->generate($code);
            // Add Qr type name to  SVG
            $svgObject = new SimpleXMLElement($svg);
            $textNode = $svgObject->addChild('text', "Employee");
            $textNode->addAttribute('x', '50%');
            $textNode->addAttribute('y', '95%');
            $textNode->addAttribute('text-anchor', 'middle');
            $textNode->addAttribute('font-weight', 'bold');
            $textNode->addAttribute('font-size', '64'); // حجم الخط
            $textNode->addAttribute('fill', 'blue');
            $svgWithText = $svgObject->asXML();
            // Save SVG to file
            $fileName = "qr_codes/Employee.svg";
            $oldpath = 'public' . $fileName;
            if (Storage::exists($oldpath)) {
                Storage::delete($oldpath);
            }
            Storage::disk('public')->put($fileName, $svgWithText);
            // Public URL
            $publicUrl = asset("storage/{$fileName}");
            return HelpersFunctions::success($publicUrl, "Creating Qr Code Done", 200);
            return response($svg, 200)
                ->header('Content-Type', 'image/svg+xml');
        } catch (Exception $e) {
            return HelpersFunctions::error("INternal Server Error", 500, $e->getMessage());
        }
    }
    public function Generate_QR_SVG_For_All_Classes()
    {
        try {
            $classes = Class_room::all();
            $qrList = [];
            foreach ($classes as $class) {
                // Delete The Old Records Qr Codes From DataBase
                Qr_Code::where('class_id', $class->id)->delete();
                $code = Str::uuid();
                $qr_code = new Qr_Code();
                $qr_code->class_id = $class->id;
                $qr_code->Unique_code = $code;
                $qr_code->expires_at = now()->addDays(7);
                $qr_code->Code_type = 'teacher';
                $qr_code->user_id = auth()->user()->id;
                $qr_code->save();
                // Generate SVG
                $svg = QrCode::format('svg')->size(300)->generate($code);
                // Add class name as <text> inside SVG
                $svgObject = new SimpleXMLElement($svg);
                $textNode = $svgObject->addChild('text', $class->name);
                $textNode->addAttribute('x', '50%');
                $textNode->addAttribute('y', '95%');
                $textNode->addAttribute('text-anchor', 'middle');
                $textNode->addAttribute('font-weight', 'bold');
                $textNode->addAttribute('font-size', '64'); // حجم الخط
                $textNode->addAttribute('fill', 'blue');
                $svgWithText = $svgObject->asXML();
                // Save SVG to file
                $fileName = "qr_codes/class_{$class->id}.svg";
                $oldpath = 'public' . $fileName;
                if (Storage::exists($oldpath)) {
                    Storage::delete($oldpath);
                }
                Storage::disk('public')->put($fileName, $svgWithText);
                // Public URL
                $publicUrl = asset("storage/{$fileName}");
                $qrList[] = [
                    'class_id' => $class->id,
                    'class_name' => $class->name,
                    'qr_svg_url' => $publicUrl,
                ];
            }
            return HelpersFunctions::success($qrList, "Creating Qr_codes Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("internal server error", 500, $e->getMessage());
        }
    }










    //    public function add_Student(Request $request)
    //     {
    //         try {
    //             $validator = Validator::make($request->all(), [
    //                 // User Data
    //                 'name' =>  'required|string',
    //                 'email' =>  'required|email',
    //                 'phone_number' =>  'required',
    //                 'birth_date' =>  'required|date',
    //                 'address' =>  'required|string',
    //                 'gender' =>  'required|in:male,Female',
    //                 'ID_documents' =>  'required|array',
    //                 'ID_documents.*' =>  'file|mimes:jpg,jpeg,png,pdf',
    //                 //  Student Data
    //                 'status' =>  'required|in:active,suspended,graduated,left',
    //             ]);
    //             if ($validator->fails()) {
    //                 return $validator->errors();
    //             } else {
    //                 DB::beginTransaction();
    //                 // Store User Data
    //                 $user = new User();
    //                 $user->name = $request->input('name');
    //                 $user->email = $request->input('email');
    //                 $user->phone_number = $request->input('phone_number');
    //                 $user->birth_date = $request->input('birth_date');
    //                 $user->address = $request->input('address');
    //                 $user->gender = $request->input('gender');
    //                 // Store Id Files
    //                 $docs = [];
    //                 $counter = 0;
    //                 foreach ($request->file('ID_documents') as $key => $file) {
    //                     $file_name = time() . $counter++ . '_' . $file->getClientOriginalName();
    //                     $file->move(public_path('uploads/users/IDs/' . $user->id . '/'), $file_name);
    //                     $docs[$key] = 'uploads/users/IDs/' . $user->id . '/' . $file_name;
    //                 }
    //                 $user->ID_documents = $docs;
    //                 $user->save();
    //                 //  Store Student Data
    //                 $student = new Student();
    //                 $student->user_id = $user->id;
    //                 $student->status = $request->status;
    //                 $student->save();
    //                 DB::commit();
    //                 return view('dashboard')->with('message', "Created Teacher Successfully");
    //             }
    //         } catch (Exception $e) {
    //             DB::rollBack();
    //             return back()->with('error', 'Failed to save: ' . $e->getMessage());
    //         }
    //     }
    //   public function get_all_students()
    // {
    //     try {
    //         $students = Student::with('user')->get();
    //         return view('dashboard', compact('students'));
    //     } catch (Exception $e) {
    //         return back()->with('error', 'Failed to save: ' . $e->getMessage());
    //     }
    // }

    // public function add_Supervisor(Request $request)
    //     {
    //         try {
    //             $validator = Validator::make($request->all(), [
    //                 // User Data
    //                 'name' =>  'required|string',
    //                 'email' =>  'required|email',
    //                 'phone_number' =>  'required',
    //                 'birth_date' =>  'required|date',
    //                 'address' =>  'required|string',
    //                 'gender' =>  'required|in:male,Female',
    //                 'ID_documents' =>  'required|array',
    //                 'ID_documents.*' =>  'file|mimes:jpg,jpeg,png,pdf',
    //                 //  Supervisor Data
    //                 'status' =>  'required|in:active,on_leave,resigned',
    //             ]);
    //             if ($validator->fails()) {
    //                 return $validator->errors();
    //             } else {
    //                 DB::beginTransaction();
    //                 // Store User Data
    //                 $user = new User();
    //                 $user->name = $request->input('name');
    //                 $user->email = $request->input('email');
    //                 $user->phone_number = $request->input('phone_number');
    //                 $user->birth_date = $request->input('birth_date');
    //                 $user->address = $request->input('address');
    //                 $user->gender = $request->input('gender');
    //                 // Store Id Files
    //                 $docs = [];
    //                 $counter = 0;
    //                 foreach ($request->file('ID_documents') as $key => $file) {
    //                     $file_name = time() . $counter++ . '_' . $file->getClientOriginalName();
    //                     $file->move(public_path('uploads/users/IDs/' . $user->id . '/'), $file_name);
    //                     $docs[$key] = 'uploads/users/IDs/' . $user->id . '/' . $file_name;
    //                 }
    //                 $user->ID_documents = $docs;
    //                 $user->save();
    //                 //  Store Supervisor Data
    //                 $supervisor = new Supervisor();
    //                 $supervisor->user_id = $user->id;
    //                 $supervisor->status = $request->status;
    //                 $supervisor->save();
    //                 DB::commit();
    //                 return view('dashboard')->with('message', "Created Teacher Successfully");
    //             }
    //         } catch (Exception $e) {
    //             DB::rollBack();
    //             return back()->with('error', 'Failed to save: ' . $e->getMessage());
    //         }
    //     }

    //  public function add_Teacher(Request $request)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             // User Data
    //             'name' =>  'required|string',
    //             'email' =>  'required|email',
    //             'phone_number' =>  'required',
    //             'birth_date' =>  'required|date',
    //             'address' =>  'required|string',
    //             'gender' =>  'required|in:male,Female',
    //             'ID_documents' => 'required|array',
    //             'ID_documents.*' => 'file|mimes:jpg,jpeg,png,pdf',
    //             //  Teacher Data
    //             'subject_id' =>  'required|exists:subjects,id',
    //             'Academic_qualification' =>  'required',
    //             'Employment_status' =>  'required|in:active,suspended,resigned',
    //             'Payment_type' =>  'required|in:monthly,hourly',
    //             'Contract_type' =>  'required|in:permanent,temporary,part_time',
    //             'The_beginning_of_the_contract' =>  'required|date',
    //             'End_of_contract' =>  'required|date',
    //             'number_of_lesson_in_week' =>  'required',
    //             'wages_per_lesson' =>  'required',
    //         ]);
    //         // dd($_FILES);
    //         if ($validator->fails()) {
    //             return $validator->errors();
    //         } else {
    //             DB::beginTransaction();
    //             $user = new User();
    //             $user->name = $request->input('name');
    //             $user->email = $request->input('email');
    //             $user->role = 'teacher';
    //             $user->phone_number = $request->input('phone_number');
    //             $user->birth_date = $request->input('birth_date');
    //             $user->address = $request->input('address');
    //             $user->gender = $request->input('gender');
    //             // Store Id Files
    //             $docs = [];
    //             $counter = 0;
    //             foreach ($request->file('ID_documents') as $key => $file) {
    //                 $file_name = $counter . time() . '_' . $file->getClientOriginalName();
    //                 $file->move(public_path("uploads/users/IDs/"), $file_name);
    //                 $docs[$key] = "uploads/users/IDs/" . $file_name;
    //                 $counter++;
    //             }
    //             $user->ID_documents = json_encode($docs);
    //             $user->hire_date = now();
    //             $user->save();
    //             $teacher = new Teacher();
    //             $teacher->user_id = $user->id;
    //             $teacher->subject_id = $request->subject_id;
    //             $teacher->Academic_qualification = $request->Academic_qualification;
    //             $teacher->Employment_status = $request->Employment_status;
    //             $teacher->Payment_type = $request->Payment_type;
    //             $teacher->Contract_type = $request->Contract_type;
    //             $teacher->The_beginning_of_the_contract = $request->The_beginning_of_the_contract;
    //             $teacher->End_of_contract = $request->End_of_contract;
    //             $teacher->number_of_lesson_in_week = $request->number_of_lesson_in_week;
    //             $teacher->wages_per_lesson = $request->wages_per_lesson;
    //             $teacher->save();
    //             DB::commit();
    //             return view('dashboard')->with('message', "Created Teacher Successfully");
    //         }
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         return back()->with('error', 'Failed to save: ' . $e->getMessage());
    //     }
    // }

    // public function update_Student(Request $request)
    // {
    //     try {

    //         $validator = Validator::make($request->all(), [
    //             //  Student Data
    //             'status' =>  'required|in:active,suspended,graduated,left',
    //             'student_id' =>  'required|exists:students,id',
    //         ]);
    //         if ($validator->fails()) {
    //             return $validator->errors();
    //         } else {

    //             $student = Student::findOrFail($request->student_id);
    //             if ($student) {
    //                 $student->status = $request->input('status');
    //                 $student->save();
    //                 return view('dashboard')->with('message', "update Student Successfully");
    //             } else {
    //                 return redirect()->back()->with('error', "Student Not Found");
    //             }
    //         }
    //     } catch (Exception $e) {
    //         return back()->with('error', 'Failed to save: ' . $e->getMessage());
    //     }
    // }

    // public function update_teacher(Request $request)
    // {
    //     try {

    //         $validator = Validator::make($request->all(), [
    //             'teacher_id' =>  'required|exists:teachers,id',
    //             'Academic_qualification' =>  'required',
    //             'Employment_status' =>  'required|in:active,suspended,resigned',
    //             'Payment_type' =>  'required|in:monthly,hourly',
    //             'Contract_type' =>  'required|in:permanent,temporary,part_time',
    //             'The_beginning_of_the_contract' =>  'required|date',
    //             'End_of_contract' =>  'required|date',
    //             'number_of_lesson_in_week' =>  'required',
    //             'wages_per_lesson' =>  'required',
    //         ]);
    //         if ($validator->fails()) {
    //             return $validator->errors();
    //         } else {

    //             $teacher = Teacher::find($request->teacher_id)->first();
    //             if ($teacher) {
    //                 $teacher->Academic_qualification = $request->input('Academic_qualification');
    //                 $teacher->Employment_status = $request->input('Employment_status');
    //                 $teacher->Payment_type = $request->input('Payment_type');
    //                 $teacher->Contract_type = $request->input('Contract_type');
    //                 $teacher->The_beginning_of_the_contract = $request->input('The_beginning_of_the_contract');
    //                 $teacher->End_of_contract = $request->input('End_of_contract');
    //                 $teacher->number_of_lesson_in_week = $request->input('number_of_lesson_in_week');
    //                 $teacher->wages_per_lesson = $request->input('wages_per_lesson');
    //                 $teacher->save();
    //                 return view('dashboard')->with('message', "update Teacher Successfully");
    //             } else {
    //                 return redirect()->back()->with('error', "Post Not Found");
    //             }
    //         }
    //     } catch (Exception $e) {
    //         return back()->with('error', 'Failed to save: ' . $e->getMessage());
    //     }
    // }

    // public function update_supervisor(Request $request)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             //  supervisor Data
    //             'status' =>  'required|in:active,on_leave,resigned',
    //             'supervisor_id' =>  'required|exists:supervisors,id',
    //         ]);
    //         if ($validator->fails()) {
    //             return $validator->errors();
    //         } else {

    //             $supervisor = Supervisor::findOrFail($request->supervisor_id);
    //             if ($supervisor) {
    //                 $supervisor->status = $request->input('status');
    //                 $supervisor->save();
    //                 return view('dashboard')->with('message', "update Teacher Successfully");
    //             } else {
    //                 return redirect()->back()->with('error', "Post Not Found");
    //             }
    //         }
    //     } catch (Exception $e) {
    //         return back()->with('error', 'Failed to save: ' . $e->getMessage());
    //     }
    // }
}
