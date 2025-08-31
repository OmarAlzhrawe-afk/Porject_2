<?php

namespace App\Console\Commands;

use App\Models\Class_session;
use Illuminate\Console\Command;
use App\Models\Session;
use App\Models\Staff_attendance;
use App\Models\Leave;
use App\Models\Deduction;
use App\Models\Staff_leaves;
use App\Models\Staff_salary_deductions;
use Carbon\Carbon;

class CheckTeachersAttendance extends Command
{
    protected $signature = 'attendance:check_teachers_attendance';
    protected $description = 'Check teachers attendance for their sessions and register absent and deducations if no attendance found';

    public function handle()
    {
        $now = Carbon::now();

        // getting Sessions IN this Day and its time now 
        $sessions = Class_session::where('session_day', Carbon::now()->format('l'))
            ->whereTime('start_time', '<=', $now->copy()->subMinutes(10)->format('H:i'))
            ->get();
        // looping IN Sessions To check Them 
        foreach ($sessions as $session) {
            $user_id = $session->teacher->user_id;

            $sessionStart = Carbon::parse($session->start_time);
            $allowedUntil = $sessionStart->copy()->addMinutes(10);

            //check teacher Register attendance
            $attendance = Staff_attendance::where('user_id', $user_id)
                ->whereDate('created_at', Carbon::today())
                ->whereTime('created_at', '>=', $sessionStart->format('H:i'))
                ->whereTime('created_at', '<=', $allowedUntil->format('H:i'))
                ->first();
            // check teacher Have Leave
            $alreadyAbsent = Staff_leaves::where('user_id', $user_id)
                ->where('leave_date', now()->date)
                ->exists();
            if (!$attendance && !$alreadyAbsent) {
                // $teacher_attendance = new Staff_attendance();
                // Creating teacher Leave record For fully Day 
                $teacher_leave = new Staff_leaves();
                $teacher_leave->leave_date = now()->date;
                $teacher_leave->period = 'day';
                $teacher_leave->leave_type = 'unpaid';
                $teacher_leave->status = 'approved';
                $teacher_leave->save();
                // Creating Deducation 0.5 from salary For Teacher Because  Absent 
                $teacher_deducation = new Staff_salary_deductions();
                $teacher_deducation->amount = 0.5 * $session->teacher->user->salary;
                $teacher_deducation->type = "deducation";
                $teacher_deducation->reason = "UN Excecused Absent For His Session";
                $this->info("Teacher {$user_id} marked absent for session {$session->id}");
            }
        }
    }
}
