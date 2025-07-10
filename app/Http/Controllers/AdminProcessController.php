<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Mail\AcceptedSchoolMail;
use App\Mail\RejectedSchoolMail;
use App\Models\Class_room;
use App\Models\Class_session;
use App\Models\Education_level;
use App\Models\Pre_registration;
use App\Models\Public_content;
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
use Illuminate\View\ViewName;

class AdminProcessController extends Controller
{

    public function get_education_level_create_page()
    {
        return view('admincreation.create_new_education_level');
    }
    public function create_education_level(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255 ',
            'description' => 'max:1024'
        ]);
        if ($validator->fails()) {
            return    back()
                ->withErrors($validator)
                ->withInput(); # code...
        } else {
            $el = new Education_level();
            $el->name = $request->input('name');
            $el->description = $request->input('description');
            $el->save();
            return redirect()->back();
        }
    }
    public function add_class_for_education_level_page($level_id)
    {
        return view('admincreation.add_new_class', compact('level_id'));
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
                return $validator->errors();
            } else {

                $class = new Class_room();
                $class->education_level_id = $request->input('level_id');
                $class->name = $request->input('name');
                $class->capacity = $request->input('capacity');
                $class->current_count = $request->input('current_count');
                $class->floor = $request->input('floor');
                $class->save();
                return redirect()->back();
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function add_subject_for_education_level_page($level_id)
    {
        return view('admincreation.add_new_subject', compact('level_id'));
    }
    public function add_subject_for_education_level(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'level_id' => 'required | exists:education_levels,id',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $subject = new Subject();
                $subject->name = $request->input('name');
                $subject->save();
                $subject->educationalLevels()->attach($request->level_id);
                return view('dashboard');
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function add_session_for_class_room_page()
    {
        return view('admincreation.add_new_session');
    }
    public function add_session_for_class_room(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teacher_id' =>  'required|exists:teachers,id',
            'class_id' =>  'required|exists:class_rooms,id',
            'start_time' =>  'required|date_format:H:i',
            'end_time' =>  'required|date_format:H:i|after:start_time ',
            'day' =>  'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
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
                return  redirect()->back()->with('conflicts', "Class That You Entered Have Session At This Period");
            } else if ($teacher_Av == false) {
                return  redirect()->back()->with('conflicts', "Teacher That You Entered Have Session At This Period");
            } else {
                $class_session = new Class_session();
                $class_session->teacher_id = $request->input('teacher_id');
                $class_session->class_room_id = $request->input('class_id');
                $class_session->session_day = $request->input('day');
                $class_session->start_time = $request->input('start_time');
                $class_session->end_time = $request->input('end_time');
                $class_session->save();
                return view('dashboard');
            }
        }
    }
    // CRUD Public Content
    public function get_public_content()
    {
        try {
            $public_content = Public_content::all();
            return view('dashboard', compact('public_content'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function get_PublicContent_page()
    {
        return view('admincreation.add_new_PublicContent');
    }

    public function add_PublicContent(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'content_type' =>  'required|in:about,vision,Frequently_asked_questions',
                'content' =>  'required',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $public_content = new Public_content();
                $public_content->content_type = $request->input('content_type');
                $public_content->content = $request->input('content');
                $public_content->save();
                return view('dashboard');
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function get_update_Public_content_page($public_content_id)
    {
        return view('admincreation.update_PublicContent', compact('public_content_id'));
    }
    public function update_PublicContent(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'content_id' =>  'required',
                'content_type' =>  'required|in:about,vision,Frequently_asked_questions',
                'content' =>  'required',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $public_content = Public_content::find($request->content_id)->first();
                if ($public_content) {
                    $public_content->content_type = $request->input('content_type');
                    $public_content->content = $request->input('content');
                    $public_content->save();
                    return view('dashboard');
                } else {
                    return back()->with('error', "UN Real Content Is Entered");
                }
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function delete_PublicContent($public_content_id)
    {
        try {
            $public_content = Public_content::where('id', $public_content_id)->first();
            if ($public_content) {
                $public_content->delete();
                return view('dashboard')->with("message", "Delete Content True");
            } else {
                return view('dashboard')->with("Fails", " Content Not Found");
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }

    // CRUD Post
    public function get_Posts()
    {
        try {
            $posts = School_post::all();
            return view('dashboard', compact('posts'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function get_Post_page()
    {
        return view('admincreation.add_new_Post');
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
                return $validator->errors();
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
                return view('dashboard');
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function get_update_Post_page($post_id)
    {
        return view('admincreation.update_Post', compact('post_id'));
    }
    public function update_Post(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'title' =>  'required',
                'description' =>  'required',
                'post_id' =>  'required',
                'post_type' =>  'required|in:lesson,news,event',
                'file_url' =>  'required|file|mimes:jpg,jpeg,png,pdf,docx,mp4,mov,avi,wmv|max:2048 ',
                'is_public' =>  'required|in:true,false',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            } else {

                $post = School_post::find($request->post_id)->first();
                if ($post) {
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
                    return view('dashboard');
                } else {
                    return redirect()->back()->with('error', "Post Not Found");
                }
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function delete_Post($post_id)
    {
        try {
            $post = School_post::where('id', $post_id)->first();
            $post->delete();
            return view('dashboard');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    // Handle Pre_Registeration For Students
    public function get_all_pre_registeration()
    {
        try {
            $Registration_requests = Pre_registration::where('status', 'pending')->get();
            return view('admincreation.Pre_registration', compact('Registration_requests'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
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
            return back()->with('message', "student Accepted successfully");
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
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
            return back()->with('message', "student Rejected successfully");
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }

    // CRUD Teachers
    public function get_all_Teacher()
    {
        try {
            $Teachers = Teacher::with('user')->get();
            return view('dashboard', compact('Teachers'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function get_page_AddTeacher()
    {
        return view('admincreation.users.teachers.add_new_Teacher');
    }
    public function add_Teacher(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // User Data
                'name' =>  'required|string',
                'email' =>  'required|email',
                'phone_number' =>  'required',
                'birth_date' =>  'required|date',
                'address' =>  'required|string',
                'gender' =>  'required|in:male,Female',
                'ID_documents' => 'required|array',
                'ID_documents.*' => 'file|mimes:jpg,jpeg,png,pdf',
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
            // dd($_FILES);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                DB::beginTransaction();
                $user = new User();
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->role = 'teacher';
                $user->phone_number = $request->input('phone_number');
                $user->birth_date = $request->input('birth_date');
                $user->address = $request->input('address');
                $user->gender = $request->input('gender');
                // Store Id Files
                $docs = [];
                $counter = 0;
                foreach ($request->file('ID_documents') as $key => $file) {
                    $file_name = $counter . time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path("uploads/users/IDs/"), $file_name);
                    $docs[$key] = "uploads/users/IDs/" . $file_name;
                    $counter++;
                }
                $user->ID_documents = json_encode($docs);
                $user->hire_date = now();
                $user->save();
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
                DB::commit();
                return view('dashboard')->with('message', "Created Teacher Successfully");
            }
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function get_page_UpdateTeachers($teacher_id)
    {
        return view('admincreation.users.teachers.updateTeacher', compact('teacher_id'));
    }
    public function update_teacher(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'teacher_id' =>  'required|exists:teachers,id',
                'Academic_qualification' =>  'required',
                'Employment_status' =>  'required|in:active,suspended,resigned',
                'Payment_type' =>  'required|in:monthly,hourly',
                'Contract_type' =>  'required|in:permanent,temporary,part_time',
                'The_beginning_of_the_contract' =>  'required|date',
                'End_of_contract' =>  'required|date',
                'number_of_lesson_in_week' =>  'required',
                'wages_per_lesson' =>  'required',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            } else {

                $teacher = Teacher::find($request->teacher_id)->first();
                if ($teacher) {
                    $teacher->Academic_qualification = $request->input('Academic_qualification');
                    $teacher->Employment_status = $request->input('Employment_status');
                    $teacher->Payment_type = $request->input('Payment_type');
                    $teacher->Contract_type = $request->input('Contract_type');
                    $teacher->The_beginning_of_the_contract = $request->input('The_beginning_of_the_contract');
                    $teacher->End_of_contract = $request->input('End_of_contract');
                    $teacher->number_of_lesson_in_week = $request->input('number_of_lesson_in_week');
                    $teacher->wages_per_lesson = $request->input('wages_per_lesson');
                    $teacher->save();
                    return view('dashboard')->with('message', "update Teacher Successfully");
                } else {
                    return redirect()->back()->with('error', "Post Not Found");
                }
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function delete_Teacher($id)
    {
        try {
            $teacher = Teacher::where('id', $id)->first();
            $user = User::where('id', $teacher->user_id)->first();
            if ($teacher && $user) {
                $teacher->delete();
                $user->delete();
                return view('dashboard');
            } else {
                return view('dashboard')->with('error', 'User Not Found');
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    // CRUD SuperVisor
    public function get_all_SuperVisor()
    {
        try {
            $supervisors = Supervisor::with('user')->get(); // 
            return view('dashboard', compact('supervisors'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function get_page_AddSupervisor()
    {
        return view('admincreation.users.supervisor.add_new_supervisor');
    }
    public function add_Supervisor(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // User Data
                'name' =>  'required|string',
                'email' =>  'required|email',
                'phone_number' =>  'required',
                'birth_date' =>  'required|date',
                'address' =>  'required|string',
                'gender' =>  'required|in:male,Female',
                'ID_documents' =>  'required|array',
                'ID_documents.*' =>  'file|mimes:jpg,jpeg,png,pdf',
                //  Teacher Data
                'status' =>  'required|in:active,on_leave,resigned',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                DB::beginTransaction();
                // Store User Data
                $user = new User();
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->phone_number = $request->input('phone_number');
                $user->birth_date = $request->input('birth_date');
                $user->address = $request->input('address');
                $user->gender = $request->input('gender');
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
                //  Store Supervisor Data
                $supervisor = new Supervisor();
                $supervisor->user_id = $user->id;
                $supervisor->status = $request->status;
                $supervisor->save();
                DB::commit();
                return view('dashboard')->with('message', "Created Teacher Successfully");
            }
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function get_page_UpdateSupervisor($id)
    {
        return view('admincreation.users.supervisor.updateSupervisor', compact('id'));
    }
    public function update_supervisor(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                //  supervisor Data
                'status' =>  'required|in:active,on_leave,resigned',
                'supervisor_id' =>  'required|exists:supervisors,id',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            } else {

                $supervisor = Supervisor::findOrFail($request->supervisor_id);
                if ($supervisor) {
                    $supervisor->status = $request->input('status');
                    $supervisor->save();
                    return view('dashboard')->with('message', "update Teacher Successfully");
                } else {
                    return redirect()->back()->with('error', "Post Not Found");
                }
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function delete_Supervisor($supervisor_id)
    {
        try {
            $supervisor = Supervisor::findOrFail($supervisor_id);
            $user = User::findOrFail($supervisor->user_id);
            if ($supervisor && $user) {
                $supervisor->delete();
                $user->delete();
                return view('dashboard');
            } else
                return view('dashboard')->with('error', "User Not Found ");
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    // CRUD Student
    public function get_all_students()
    {
        try {
            $students = Student::with('user')->get();
            return view('dashboard', compact('students'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function get_page_AddStudent()
    {
        return view('admincreation.users.students.add_new_Student');
    }
    public function add_Student(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // User Data
                'name' =>  'required|string',
                'email' =>  'required|email',
                'phone_number' =>  'required',
                'birth_date' =>  'required|date',
                'address' =>  'required|string',
                'gender' =>  'required|in:male,Female',
                'ID_documents' =>  'required|array',
                'ID_documents.*' =>  'file|mimes:jpg,jpeg,png,pdf',
                //  Student Data
                'status' =>  'required|in:active,suspended,graduated,left',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                DB::beginTransaction();
                // Store User Data
                $user = new User();
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->phone_number = $request->input('phone_number');
                $user->birth_date = $request->input('birth_date');
                $user->address = $request->input('address');
                $user->gender = $request->input('gender');
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
                //  Store Supervisor Data
                $student = new Student();
                $student->user_id = $user->id;
                $student->status = $request->status;
                $student->save();
                DB::commit();
                return view('dashboard')->with('message', "Created Teacher Successfully");
            }
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function get_page_UpdateStudent($student_id)
    {
        return view('admincreation.users.students.updateStudent', compact('student_id'));
    }
    public function update_Student(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                //  Student Data
                'status' =>  'required|in:active,suspended,graduated,left',
                'student_id' =>  'required|exists:students,id',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            } else {

                $student = Student::findOrFail($request->student_id);
                if ($student) {
                    $student->status = $request->input('status');
                    $student->save();
                    return view('dashboard')->with('message', "update Student Successfully");
                } else {
                    return redirect()->back()->with('error', "Student Not Found");
                }
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function delete_Student($student_id)
    {
        try {
            $student = Student::findOrFail($student_id);
            $user = User::findOrFail($student->user_id);
            if ($student && $user) {
                $student->delete();
                $user->delete();
                return view('dashboard');
            } else
                return view('dashboard')->with('error', "User Not Found ");
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    // CRUD Any Other
    public function get_all_users($type)
    {
        try {
            $users = User::where('role', $type)->get();
            return view('dashboard', compact('users'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function get_page_AddUser($type)
    {
        return view('admincreation.users.users.add_new_User', compact('type'));
    }
    public function add_User(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // User Data
                'name' =>  'required|string',
                'email' =>  'required|email',
                'phone_number' =>  'required',
                'role' =>  'required',
                'birth_date' =>  'required|date',
                'address' =>  'required|string',
                'gender' =>  'required|in:male,Female',
                'ID_documents' =>  'required|array',
                'ID_documents.*' =>  'file|mimes:jpg,jpeg,png,pdf',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
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
                DB::commit();
                return view('dashboard')->with('message', "Created" . $user->role . "Successfully");
            }
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function get_page_UpdateUser($user_id)
    {
        return view('admincreation.users.users.updateUser', compact('user_id'));
    }
    public function update_User(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                //  User Data
                'user_id' =>  'required|exists:users,id',
                // 'name' =>  'required|string',
                'email' =>  'required|email',
                'phone_number' =>  'required',
                // 'role' =>  'required',
                // 'birth_date' =>  'required|date',
                'address' =>  'required|string',
                // 'gender' =>  'required|in:male,Female',
                'ID_documents' =>  'required|array',
                'ID_documents.*' =>  'file|mimes:jpg,jpeg,png,pdf',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                DB::beginTransaction();
                $user = User::findOrFail($request->user_id);
                if ($user) {
                    // $user->name = $request->input('name');
                    $user->email = $request->input('email');
                    $user->phone_number = $request->input('phone_number');
                    // $user->birth_date = $request->input('birth_date');
                    // $user->role = $request->input('role');
                    $user->address = $request->input('address');
                    // $user->gender = $request->input('gender');
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
                    DB::commit();
                    return view('dashboard')->with('message', "update" . $user->role . "Successfully");
                } else {
                    return redirect()->back()->with('error', "User Not Found");
                }
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function delete_User($user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            if ($user) {
                foreach ($user->ID_documents as $key => $value) {
                    if (isset($files_array[$key]) && file_exists(public_path($files_array[$key]))) {
                        unlink(public_path($files_array[$key]));
                    }
                }
                $user->delete();
                return view('dashboard');
            } else
                return view('dashboard')->with('error', "User Not Found ");

            return view('dashboard')->with('message', "Deleted User" . $user->name . " successfully ");
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    // Handle Leaves Order 
    public function get_all_Leaves_order()
    {
        try {
            $leaves = Staff_leaves::where('status', 'pending')->with('employee')->get();
            if ($leaves) {
                return view('dashboard', compact('leaves'));
            } else {
                return view('dashboard')->with('message', 'Unfound Leaves Order');
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
    public function Accept_Leave_page($leave_id)
    {
        return view('admincreation.acceptleave', compact('leave_id'));
    }
    public function Accept_Leave(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'leave_id'  =>  'required|exists:staff_leaves,id',
                'amount'  =>  'required|integer',
                'reason'  =>  'required|string',
            ]);
            $leave = Staff_leaves::FindOrFail($request->leave_id);
            $user = User::FindOrFail($leave->user_id);
            $deducation = new Staff_salary_deductions();
            $deducation->amount = $request->input('amount');
            $deducation->reason = $request->input('reason');
            $deducation->user_id = $user->id;
            $deducation->save();
            if ($leave && $user) {
                $leave->status = 'approved';
                $leave->save();
                // Send Notification To User 
                // $user->notify();
                return view('dashboard', compact('leave'));
            } else {
                return view('dashboard')->with('message', 'Unfound Leave Order');
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
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
                return view('dashboard', compact('leave'));
            } else {
                return view('dashboard')->with('message', 'Unfound Leaves Order');
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save: ' . $e->getMessage());
        }
    }
}
