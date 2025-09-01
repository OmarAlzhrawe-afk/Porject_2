<?php

namespace App\Http\Controllers;

use App\Helpers\HelpersFunctions;
use App\Models\Installment_payment;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Student_attendance;
use Exception;
use Illuminate\Http\Request;

class ParentProcessController extends Controller
{
    public function Show_installment_for_my_students()
    {
        try {
            $mychildren = Student::where('parent_id', auth('sanctum')->user()->id)->get();
            $installments = [];
            foreach ($mychildren as $student) {
                $student_id  = $student->id;
                $student_name  = $student->user->name;
                $Student_installment = $student->intstallments->map(function ($installment) {
                    return [
                        'due_date' => $installment->due_date,
                        'amount' => $installment->amount,
                        'paid' => $installment->paid
                    ];
                });
                $installments[$student_name] = $Student_installment;
            }
            return HelpersFunctions::success($installments, "Getting Installments Done ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN Line : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function Show_attendance_for_my_students(Request $request)
    {
        try {
            $mychildren = Student::where('parent_id', auth('sanctum')->user()->id)->get();
            $attendance = [];
            foreach ($mychildren as $student) {
                $student_id  = $student->id;
                $student_name  = $student->user->name;
                $Student_attendance = Student_attendance::where('student_id', $student_id)
                    ->where('term_id', HelpersFunctions::getCurrentTermId())
                    ->orderByDesc('date')
                    ->take(10)
                    ->get(['date', 'excused']);
                $attendance[$student_name] = $Student_attendance;
            }
            return HelpersFunctions::success($attendance, "Getting attendance Done ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN Line : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function Show_marks_for_my_students(Request $request)
    {
        try {
            $mychildren = Student::where('parent_id', auth('sanctum')->user()->id)->get();
            $marks = [];
            foreach ($mychildren as $student) {
                $student_id  = $student->id;
                $student_name  = $student->user->name;
                $Student_marks = Mark::with('teacher.subject')
                    ->where('student_id', $student_id)
                    ->where('term_id', HelpersFunctions::getCurrentTermId())
                    ->orderByDesc('date')
                    ->take(10)
                    ->get()
                    ->map(function ($mark) {
                        return [
                            'subject'      => optional($mark->teacher->subject)->name,
                            'exam_type'    => $mark->exam_type,
                            'score'        => $mark->score,
                            'max_score'    => $mark->max_score,
                            'date'         => $mark->date,
                            'teacher_note' => $mark->teacher_note,
                        ];
                    });
                $marks[$student_name] = $Student_marks;
            }
            return HelpersFunctions::success($marks, "Getting Marks Done ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN Line : " . $e->getLine(), 500, $e->getMessage());
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
}
