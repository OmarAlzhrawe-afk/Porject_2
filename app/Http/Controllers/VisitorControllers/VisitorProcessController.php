<?php

namespace App\Http\Controllers\VisitorControllers;

use App\Helpers\HelpersFunctions;
use App\Http\Controllers\Controller;
use App\Models\Education_level;
use App\Models\Pre_registration;
use App\Models\Public_content;
use App\Models\School_post;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\New_Pre_Regesteration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\Login_code;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordCodeMail;
use App\Models\Subject;

class VisitorProcessController extends Controller
{
    public function preRegister(Request $request)
    {
        DB::beginTransaction();
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|string|max:50',
            'student_email' => 'required|email',
            'parent_name' => 'required|string|max:50',
            'parent_email' => 'required|email',
            'phone_number' => 'required|string|max:20',
            'education_level_id' => 'required|exists:education_levels,id',
            'installment_plan_id' => 'nullable|exists:installment_plans,id',
            'documents' =>  'required|array',
            'documents.*' =>  'file|mimes:jpg,jpeg,png,pdf',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request", 400, $validator->errors());
        }
        $pre_regesteration = new Pre_registration();
        $pre_regesteration->student_name = $request->input('student_name');
        $pre_regesteration->student_email = $request->input('student_email');
        $pre_regesteration->parent_name = $request->input('parent_name');
        $pre_regesteration->parent_email = $request->input('parent_email');
        $pre_regesteration->phone_number = $request->input('phone_number');
        $pre_regesteration->education_level_id = $request->input('education_level_id');
        $pre_regesteration->installment_plan_id = $request->input('installment_plan_id');
        // Store Id Files
        $docs = [];
        $counter = 0;
        foreach ($request->file('documents') as $key => $file) {
            $file_name = time() . $counter++ . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/student/pre_redesteration/Files/' . $pre_regesteration->student_name . '/'), $file_name);
            $docs[$key] = 'uploads/student/pre_redesteration/Files/' . $pre_regesteration->student_name . '/' . $file_name;
        }
        $pre_regesteration->documents = $docs;
        $pre_regesteration->status = 'pending';
        $pre_regesteration->save();

        // // Stripe Intialization
        // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // // Create New Payment Intent By Stripe
        // $paymentIntent = \Stripe\PaymentIntent::create([
        //     'amount' => 1 * 100,
        //     'currency' => 'usd',
        //     'description' => 'cost for School Registration Demand ',
        //     'metadata' => [
        //         'pre_registration_id' => $pre_regesteration->id
        //     ]
        // ]);

        // //save PaymentIntent Id
        // $pre_regesteration->update([
        //     'payment_reference' => $paymentIntent->id
        // ]);
        // // return  Cliect Secret for Flutter To get Interface Payment From Sprite
        // $data = [
        //     'client_secret' => $paymentIntent->client_secret,
        //     'message' => 'Creating Pre_registeration Done Please Process Payment cost',
        // ];
        DB::commit();
        return HelpersFunctions::success("", "Done", 200);
    }
    public function create_payment_intent(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'amount' => 'required|integer'
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            }

            // Stripe Intialization
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            // Create New Payment Intent By Stripe
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $request->amount * 100,
                'currency' => 'usd',
                'description' => 'cost for School Registration Demand ',
            ]);

            $data = [
                'client_secret' => $paymentIntent->client_secret,
                'message' => 'Creating Pre_registeration Done Please Process Payment cost',
            ];
            return HelpersFunctions::success($data, "pa", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    // public function confirmPayment(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $request->validate([
    //             'payment_intent_id' => 'required|string',
    //         ]);
    //         \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    //         $paymentIntent = \Stripe\PaymentIntent::retrieve($request->payment_intent_id);
    //         // $pre = Pre_registration::where('payment_reference', $request->payment_intent_id)->first();
    //         // if ($pre) {
    //         //     $pre->update(['payment_status' => true]);
    //         // Make Transaction
    //         $transaction =   Transaction::create([
    //             'user_id' => null,
    //             'payment_method' => 'visa',
    //             'amount' => $paymentIntent->amount / 100,
    //             'type' => 'in',
    //             'transaction_source' => 'pre_registration',
    //             'status' => 'paid',
    //             'is_installment' => false,
    //             'payment_reference' => $paymentIntent->id,
    //         ]);
    //         $user = User::where('role', 'admin')->first();
    //         // $user->notify(new New_Pre_Regesteration($pre));
    //         DB::commit();
    //         return HelpersFunctions::success($transaction, "Store Payment Done", 200);
    //         // } else {
    //         //     return HelpersFunctions::error("Bad Request ", 400, "Demand Anexist In database");
    //         // }
    //         // }
    //     } catch (Exception $e) {
    //         return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
    //     }
    // }
    public function view_posts()
    {
        try {
            $posts = School_post::where('is_public', true)->get();
            return HelpersFunctions::success($posts, "Getting Posts Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function view_public_content()
    {
        try {
            $public_contents = Public_content::all(['content_type', 'content']);
            return HelpersFunctions::success($public_contents, "Getting public Content Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function view_education_level()
    {
        try {
            $education_levels = Education_level::all()->map(function ($education_level) {
                return $education_level->load('Installment_plans');
            });
            return HelpersFunctions::success($education_levels, "Getting education Level Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function send_passcode(Request $request)
    {
        try {
            // verify Request data 
            $validator = Validator::make($request->all(), [
                'email' => 'required | exists:users,email',
                'role' => 'required | in:teacher,librarian,parent,student',
            ]);
            if ($validator->fails()) {
                // dd("hh");

                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            } else {
                // Fetch User From database 

                $user = User::where('email', $request->email)->first();
                if ($user->role != $request->role) {
                    return HelpersFunctions::error("Bad Request", 400, "Email That You Want To login with It Is Not Specific For this Role ");
                }
                // Delete All last Login Codes For this User 
                Login_code::where('email', $request->email)->delete();
                // create code For Login
                $code = new Login_code();
                $code->code = rand(100000, 999999);
                $code->email = $user->email;
                $code->created_at = now();
                $code->save();
                // Send Code To Supervisor Email
                // Mail::to($request->email)->send(new PasswordCodeMail($code->code));
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "Send login Code for librarian Code",
                ])->log("Librarian" . $user->name  . " Send Forget Password Code");
                return HelpersFunctions::success("", "Sending log in Code  Successfully ", 201);
            }
        } catch (Exception  $e) {
            return HelpersFunctions::error("Internal server Error", 500, $e->getMessage());
        }
    }
    public function verify_passcode(Request $request)
    {
        // I send Email Here Because maybe Code is repeated  
        // verify Request data 
        try {
            $validator = Validator::make($request->all(), [
                'code' => 'required |exists:login_codes,code',
                'email' => 'required |exists:users,email',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request Wrong code Or Email", 400, $validator->errors());
            }
            $code = Login_code::where([
                'code' => $request->code,
                'email' => $request->email,
            ])->first();

            // verify if code expired or Not  
            if (now()->diffInMinutes($code->created_at) > 5) {
                return HelpersFunctions::error("Bad Request", 400, "Code That you Entered Expired");
            }
            $code->delete();
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken($user->name)->plainTextToken;
            if ($user->role == "teacher") {
                $teacher =  $user->teacher;
                $teacher = [
                    'User_Name' => $user->name,
                    'User_Email' => $user->email,
                    'User_phone_number' => $user->phone_number,
                    'User_Role' => $user->role,
                    'User_IDS' => $user->ID_documents,
                    'User_Salary' => $user->salary,
                    'User_birth_date' => $user->birth_date,
                    'subject' => Subject::where('id', $teacher->subject_id)->value('name'),
                    'Academic_qualification' => $teacher->Academic_qualification,
                    'Employment_status' => $teacher->Employment_status,
                    'Payment_type' => $teacher->Payment_type,
                    'Contract_type' => $teacher->Contract_type,
                    'The_beginning_of_the_contract' => $teacher->The_beginning_of_the_contract,
                    'End_of_contract' => $teacher->End_of_contract,
                    'number_of_lesson_in_week' => $teacher->number_of_lesson_in_week,
                    'wages_per_lesson' => $teacher->wages_per_lesson,
                    'classes' => $teacher->sessions->map(function ($session) {
                        return $session->class;
                    })->filter()->unique('id')->values()->toArray()
                ];
                $data = [
                    'token' =>  $token,
                    // 'admin data' =>  $user,
                    'teacher data' =>  $teacher,
                ];
            } else {
                $data = [
                    'token' =>  $token,
                    'user_data' =>  $user,
                ];
            }
            //Enrolling librarian Log in 
            activity()->causedBy($user)->withProperties([
                'Process_role' => $user->role,
                'Process_type' => "Log_In " . $user->role,
            ])->log($user->role . $user->name . " Loged In");
            return HelpersFunctions::success($data, " Login Done ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getMessage(), 500, $e->getMessage());
        }
    }
}
