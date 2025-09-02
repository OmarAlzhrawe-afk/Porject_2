<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleXMLElement;
use App\Mail\AcceptedSchoolMail;
use App\Mail\RejectedSchoolMail;
use App\Models\Class_room;
use App\Models\Pre_registration;
use App\Models\Qr_Code;
use App\Models\Staff_leaves;
use App\Models\Staff_salary_deductions;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Helpers\HelpersFunctions;
use App\Models\Installment_payment;
use App\Models\Installment_Plan;
use App\Models\Report;
use App\Models\Salary;
use App\Models\Student_profile;
use App\Models\Transaction;
use App\Notifications\LeaveNotification;
use App\Notifications\RejectLeaveNotification;
use Carbon\Carbon;
use Dompdf\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Spatie\Activitylog\Models\Activity;
use App\Traits\SharedFunctionTrait;

class AdminProcessController extends Controller
{
    use SharedFunctionTrait;
    public function Get_Salaries_For_Users()
    {
        try {
            $salary = Salary::where('status', 'pending')
                ->whereYear('date', now()->year)
                ->whereMonth('date', now()->month)
                ->get();
            $admin = auth('sanctum')->user();
            activity()->causedBy($admin)->withProperties([
                'Process_type' => " Get Salaries For Users",
                'date' => now()->format('Y-m-h'),
            ])->log("Get Salaries For Users");
            return HelpersFunctions::success($salary, "Getting salaries Successfully ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function Paying_Salary($user_id)
    {
        try {
            $salary = Salary::where(['user_id' => $user_id, 'status' => 'pending'])
                ->whereYear('date', now()->year)
                ->whereMonth('date', now()->month)
                ->first();
            if (!$salary) {
                return HelpersFunctions::error("Empty Account", 400, "The User That You Entered dont Have Salary To Pay it ");
            }
            DB::beginTransaction();
            $salary->status = "paid";
            $salary->save();
            $transaction = new Transaction();
            $transaction->user_id = $user_id;
            $transaction->payment_method = "cash";
            $transaction->amount =  $salary->Base_salary + $salary->bonus -  $salary->deductions; //$salary->net_salary;
            $transaction->status = "paid";
            $transaction->type = "in";
            $transaction->is_installment = false;
            $transaction->save();
            DB::commit();
            $admin = auth('sanctum')->user();
            activity()->causedBy($admin)->withProperties([
                'Process_type' => "Paying Salary",
                'date' => now()->format('Y-m-h'),
            ])->log("Paying Salary");
            return HelpersFunctions::success("", "Saving Paid Salary Done ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    // Handle Pre_Registeration For Students
    public function get_all_pre_registeration()
    {
        try {
            $Registration_requests = Pre_registration::where('status', 'pending')->get();
            return HelpersFunctions::success($Registration_requests, "Getting data Successfully ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function Accept_pre_registeration(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'class_id' => 'required|exists:class_rooms,id',
                'pre_id' => 'required|exists:pre_registrations,id',
                'plan_id' => 'required|exists:installment_plans,id',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            }
            // Checking and editing pre_registeration 
            $Registration = Pre_registration::where('id', $request->pre_id)->first();
            if (!$Registration->status == "pending") {
                return HelpersFunctions::error("Bad Registeration", 403, "Registeration that you Entered Not Pending Status");
            }
            $Registration->status = 'accepted';
            $Registration->save();
            // Checking of Class Is comfrortable with Education Level ID and Clas IS Not Fully
            $class = Class_room::find($request->class_id);
            if ($class->education_level_id == $Registration->education_level_id && $class->capacity > $class->current_count) {
                // Createing Student User
                $studentuser = new User();
                $studentuser->name = $Registration->student_name;
                $studentuser->email = $Registration->student_email;
                $studentuser->role = 'student';
                $studentuser->phone_number = $Registration->phone_number;
                // Store Id Files
                $studentuser->ID_documents = $Registration->documents;
                $studentuser->save();
                $studentuser->assignRole('student');
                // Createing parent user
                $parentuser = new User();
                $parentuser->name = $Registration->parent_name;
                $parentuser->email = $Registration->parent_email;
                $parentuser->role = 'parent';
                $parentuser->hire_date = now();
                $parentuser->phone_number = $Registration->phone_number;
                $parentuser->save();
                $studentuser->assignRole('parent');
                // Createing student record
                $student = new Student();
                $student->class_id = $class->id;
                $student->user_id = $studentuser->id;
                $student->parent_id = $parentuser->id;
                $student->status = 'active';
                $student->save();
                // Createing student_profile record
                $student_profile = new Student_profile();
                $student_profile->student_id = $student->id;
                $student_profile->education_level_id = $Registration->education_level_id;
                $student_profile->save();
                // fetching Plan
                $plan = Installment_Plan::where('id', $request->plan_id)->first();
                // making installment Recods For user Independent In hsi plan
                $start_date = Carbon::now();
                for ($i = 1; $i <= $plan->number_of_installments; $i++) {
                    $due_date = $start_date->copy()->addDays($i * $plan->count_of_days_per_each_installment);
                    $installment_payment = new Installment_payment();
                    $installment_payment->student_id = $student->id;
                    $installment_payment->installment_plan_id = $plan->id;
                    $installment_payment->paid = false;
                    $installment_payment->due_date = $due_date;
                    $installment_payment->amount = $plan->total_amount / $plan->number_of_installments;
                    $installment_payment->save();
                }
                // Increasing Student Count IN Class 
                $class->current_count++;
                $class->save();
            } else {
                return HelpersFunctions::error("Bad Request", 400, "Class That You Entered Is Invalid");
            }
            $admin = auth('sanctum')->user();
            // Mail::to($Registration->student_email)->send(new AcceptedSchoolMail("Accepted Student : " . $Registration->student_name));
            // Mail::to($Registration->parent_email)->send(new AcceptedSchoolMail("Accepted Student : " . $Registration->student_name));
            activity()->causedBy($admin)->withProperties([
                'Process_type' => " Accepted_pre_registeration",
            ])->log("Accepted_pre_registeration");
            DB::commit();
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
            // Mail::to($Registration->parent_email)->send(new RejectedSchoolMail("Rejected Student : " . $Registration->student_name));
            $admin = auth('sanctum')->user();
            activity()->causedBy($admin)->withProperties([
                'Process_type' => "reject pre registeration",
                'date' => now()->format('Y-m-h'),
            ])->log("reject pre registeration");

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
                'amount'  =>  'nullable|integer',
                'reason'  =>  'nullable|string',
            ]);
            if ($validate->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validate->errors());
            }
            DB::beginTransaction();
            $leave = Staff_leaves::FindOrFail($request->leave_id);
            $user = User::FindOrFail($leave->user_id);
            if ($request->has('amount')) {
                $deducation = new Staff_salary_deductions();
                $deducation->amount = $request->input('amount');
                $deducation->reason = $request->input('reason');
                $deducation->type = 'deducation';
                $deducation->user_id = $user->id;
                $deducation->save();
            }
            $leave->status = 'approved';
            $leave->save();
            // Send Notification To employee
            $user->notify(new LeaveNotification($deducation ?? null, $leave));
            $admin = auth('sanctum')->user();
            activity()->causedBy($admin)->withProperties([
                'Process_type' => " Accept Leave",
                'date' => now()->format('Y-m-h'),
            ])->log("Accept Leave");
            DB::commit();
            return HelpersFunctions::success("", "Accept Leave Successfully", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function Reject_Leave($id)
    {
        try {
            DB::beginTransaction();
            $leave = Staff_leaves::FindOrFail($id);
            $user = User::FindOrFail($leave->user_id);
            if ($leave && $user) {
                $leave->status = 'rejected';
                $leave->save();
                // Send Notification To employee
                $user->notify(new RejectLeaveNotification($leave));
                $admin = auth('sanctum')->user();
                activity()->causedBy($admin)->withProperties([
                    'Process_type' => " Reject Leave",
                    'date' => now()->format('Y-m-h'),
                ])->log("Reject Leave");

                DB::commit();
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
                return HelpersFunctions::error("bad Request", 400, $validator->errors());
            } else {
                DB::beginTransaction();
                $class = Class_room::find($request->class_id);
                Qr_Code::where('class_id', $class->id)->delete();
                $code = Str::uuid();
                $qr_code = new Qr_Code();
                $qr_code->class_id = $class->id;
                $qr_code->Unique_code = $code;
                $qr_code->expires_at = now()->addDays(7);
                $qr_code->Code_type = 'teacher';
                $qr_code->user_id = auth()->user()->id;
                $qr_code->save();
                $data = [
                    'QR_code' => $qr_code->Unique_code,
                    'Expird_at' => $qr_code->expires_at,
                    'Code_type' => $qr_code->Code_type,
                ];
                // // Generate SVG
                // $svg = QrCode::format('svg')->size(300)->generate($code);
                // // Add class name as <text> inside SVG
                // $svgObject = new SimpleXMLElement($svg);
                // $textNode = $svgObject->addChild('text', $class->name);
                // $textNode->addAttribute('x', '50%');
                // $textNode->addAttribute('y', '95%');
                // $textNode->addAttribute('text-anchor', 'middle');
                // $textNode->addAttribute('font-weight', 'bold');
                // $textNode->addAttribute('font-size', '64'); // حجم الخط
                // $textNode->addAttribute('fill', 'blue');
                // $svgWithText = $svgObject->asXML();
                // // Save SVG to file
                // $fileName = "qr_codes/class_{$class->id}.svg";
                // $oldpath = 'public' . $fileName;
                // if (Storage::exists($oldpath)) {
                //     Storage::delete($oldpath);
                // }
                // Storage::disk('public')->put($fileName, $svgWithText);
                // // Public URL
                // $publicUrl = asset("storage/{$fileName}");
                DB::commit();
                $admin = auth('sanctum')->user();
                activity()->causedBy($admin)->withProperties([
                    'Process_type' => "Generate QR For Specific Class",
                    'date' => now()->format('Y-m-h'),
                ])->log("Generate QR For Specific Class");
                return HelpersFunctions::success($data, "updating Qr Code For Class  " . $class->name  . " Done ", 200);
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
            // $svg = QrCode::format('svg')->size(300)->generate($code);
            // Add Qr type name to  SVG
            // $svgObject = new SimpleXMLElement($svg);
            // $textNode = $svgObject->addChild('text', "Employee");
            // $textNode->addAttribute('x', '50%');
            // $textNode->addAttribute('y', '95%');
            // $textNode->addAttribute('text-anchor', 'middle');
            // $textNode->addAttribute('font-weight', 'bold');
            // $textNode->addAttribute('font-size', '64'); // حجم الخط
            // $textNode->addAttribute('fill', 'blue');
            // $svgWithText = $svgObject->asXML();
            // // Save SVG to file
            // $fileName = "qr_codes/Employee.svg";
            // $oldpath = 'public' . $fileName;
            // if (Storage::exists($oldpath)) {
            //     Storage::delete($oldpath);
            // }
            // Storage::disk('public')->put($fileName, $svgWithText);
            // // Public URL
            // $publicUrl = asset("storage/{$fileName}");
            $data = [
                'QR_code' => $qr_code->Unique_code,
                'Expird_at' => $qr_code->expires_at,
                'Code_type' => $qr_code->Code_type,
            ];
            return HelpersFunctions::success($data, "Creating Qr Code Done", 200);
            // return response($svg, 200)
            //     ->header('Content-Type', 'image/svg+xml');
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
                // // Generate SVG
                // $svg = QrCode::format('svg')->size(300)->generate($code);
                // // Add class name as <text> inside SVG
                // $svgObject = new SimpleXMLElement($svg);
                // $textNode = $svgObject->addChild('text', $class->name);
                // $textNode->addAttribute('x', '50%');
                // $textNode->addAttribute('y', '95%');
                // $textNode->addAttribute('text-anchor', 'middle');
                // $textNode->addAttribute('font-weight', 'bold');
                // $textNode->addAttribute('font-size', '64'); // حجم الخط
                // $textNode->addAttribute('fill', 'blue');
                // $svgWithText = $svgObject->asXML();
                // // Save SVG to file
                // $fileName = "qr_codes/class_{$class->id}.svg";
                // $oldpath = 'public' . $fileName;
                // if (Storage::exists($oldpath)) {
                //     Storage::delete($oldpath);
                // }
                // Storage::disk('public')->put($fileName, $svgWithText);
                // // Public URL
                // $publicUrl = asset("storage/{$fileName}");
                $qrList[] = [
                    'Class_Name' => $class->name,
                    'Class_ID' => $class->id,
                    'qr_data' => [
                        'QR_code' => $qr_code->Unique_code,
                        'Expird_at' => $qr_code->expires_at,
                        'Code_type' => $qr_code->Code_type,
                    ],
                    // 'class_name' => $class->name,
                    // 'qr_svg_url' => $publicUrl,
                ];
            }
            return HelpersFunctions::success($qrList, "Creating Qr_codes Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("internal server error", 500, $e->getMessage());
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
    public function get_last_activity()
    {
        return $this->get_last_activity_for_all();
    }
    public function get_reports()
    {
        try {
            $reports = Report::where('term_id', HelpersFunctions::getCurrentTermId())
                ->get()
                ->map(function ($report) {
                    return [
                        'report_type' => $report->report_type,
                        'report_url' => $report->report_url = url($report->report_url),
                        'report_description' => $report->report_description,
                        'report_date' => $report->report_date
                    ];
                });
            return HelpersFunctions::success($reports, "getting Reports Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("INternal Server Error", 500, $e->getMessage());
        }
    }
    public function get_Qr_codes()
    {
        // getting Qrs For al classes 
        try {
            $classes = Class_room::all();
            $qrList = [];
            foreach ($classes as $class) {
                // Delete The Old Records Qr Codes From DataBase
                // $code = Str::uuid();
                $qr_code = Qr_Code::where('class_id', $class->id)
                    ->where('is_Active', true)
                    ->where('Code_type', 'teacher')
                    ->first();
                // $qr_code->class_id = $class->id;
                // $qr_code->Unique_code = $code;
                // $qr_code->expires_at = now()->addDays(7);
                // $qr_code->Code_type = 'teacher';
                // $qr_code->user_id = auth()->user()->id;
                // $qr_code->save();
                $qrList[] = [
                    'Class_Name' => $class->name,
                    'Class_ID' => $class->id,
                    'qr_data' => [
                        'QR_code' => $qr_code->Unique_code,
                        'Expird_at' => $qr_code->expires_at,
                        'Code_type' => $qr_code->Code_type,
                    ],
                ];
            }
            $qr_code_for_employee = Qr_Code::where('is_Active', true)
                ->where('Code_type', 'employee')
                ->first();
            $response_data = [
                'QR_for_classes' => $qrList,
                'QR_for_employee' => $qr_code_for_employee,
            ];
            return HelpersFunctions::success($response_data, "getting Qr_codes Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal server error IN Line" . $e->getLine(), 500, $e->getMessage());
        }
    }
}
