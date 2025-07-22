<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Supervisor;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Helpers\HelpersFunctions;
use App\Models\Class_room;

class ManageUsers extends Controller
{
    // CRUD Any User
    public function get_all_users()
    {
        try {
            $users = User::all()->map(function ($user) {
                if (in_array($user->role, ['teacher', 'student', 'supervisor'])) {
                    $user->load($user->role);
                }
                return $user;
            });
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
                // Save Last Activity
                activity()->causedBy($admin)->withProperties([
                    'Process_type' => "add" .  $request->role,
                ])->log("add" .  $request->role); // 'admin', 'teacher', 'librarian', 'supervisor', 'student', 'parent'
                //  Assign Role To User 
                $user->assignRole($request->role);
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
                        $class = Class_room::findOrFail($request->class_id);
                        if ($class->current_count < $class->capacity) {
                            //  Store Student Data
                            $student = new Student();
                            $student->user_id = $user->id;
                            $student->class_id =  $request->class_id;
                            $student->status = $request->status;
                            $student->save();
                            $class->current_count++;
                        } else {
                            return HelpersFunctions::error("Sorry Class Is Fully", 200, "");
                        }
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
}
