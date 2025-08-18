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
    public function Accept_pre_registeration(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'class_id' => 'required | exists:class_rooms,id',
                'pre_id' => 'required | exists:pre_registrations,id',
                'plan_id' => 'required | exists:installment_plans,id',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            }
            $Registration = Pre_registration::where('id', $request->pre_id)->first();
            if ($Registration->status = 'pending') {
                return HelpersFunctions::error("Bad Registeration", 403, "Registeration that you Entered Not Pending Status");
            }
            $Registration->status = 'accepted';
            $Registration->save();
            $studentuser = new User();
            $studentuser->name = $Registration->student_name;
            $studentuser->email = $Registration->student_email;
            $studentuser->role = 'student';
            $studentuser->hire_date = now();
            $studentuser->phone_number = $Registration->phone_number;
            // Store Id Files
            $studentuser->ID_documents = $Registration->documents;
            $studentuser->save();
            $studentuser->assignRole('student');

            $parentuser = new User();
            $parentuser->name = $Registration->parent_name;
            $parentuser->email = $Registration->parent_email;
            $parentuser->role = 'parent';
            $parentuser->hire_date = now();
            $parentuser->phone_number = $Registration->phone_number;
            $parentuser->save();
            $studentuser->assignRole('parent');
            $class = Class_room::find($request->class_id);
            if ($class->education_level_id == $Registration->education_level_id && $class->capacity > $class->current_count) {
                $student = new Student();
                $student->class_id = $class->id;
                $student->user_id = $studentuser->id;
                $student->parent_id = $parentuser->id;
                $student->status = 'active';
                $student->save();
                $plan = Installment_Plan::where('id', $request->plan_id)->first();
                $start_date = Carbon::now()->addDays(30);
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
                $class->current_count++;
            } else {
                // dd("class Level : " . $class->education_level_id . "pre_level : " . $Registration->education_level_id . " class capacity : " . $class->capacity . " class current count : " . $class->current_count);
                DB::commit();
                return HelpersFunctions::error("Bad Request", 400, "Class That You Entered Is Invalid");
            }
            // $student->Student_number = '5'; Auto
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
                'Process_type' => " Accept_Leave",
            ])->log("Accept_Leave");
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
                    'Process_type' => " Reject_Leave",
                ])->log("Reject_Leave");
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
                return HelpersFunctions::success($publicUrl, "updating Qr Code For Class  " . $class->name  . " Done ", 200);
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
    public function get_last_activity()
    {
        $this->get_last_activity_for_all();
    }
}
