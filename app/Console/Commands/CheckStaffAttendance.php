<?php

namespace App\Console\Commands;

use App\Models\Staff_attendance;
use App\Models\Staff_leaves;
use App\Models\Staff_salary_deductions;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckStaffAttendance extends Command
{
    protected $signature = 'staff:attendance';

    protected $description = 'Command that Check Attendance to All employee in school except employees';

    public function handle()
    {
        // getting users
        $users = User::whereIN('role', ['librarian', 'supervisor'])->get();
        foreach ($users as $user) {
            // check employee Have attendance
            $attendance = Staff_attendance::where('user_id', $user)
                ->whereDate('created_at', Carbon::today())
                ->first();
            // check employee Have Leave
            $alreadyAbsent = Staff_leaves::where('user_id', $user)
                ->whereDate('leave_date', Carbon::today())
                ->exists();
            if (!$attendance && !$alreadyAbsent) {
                // Creating employee Leave record For fully Day 
                $employee_leave = new Staff_leaves();
                $employee_leave->leave_date = Carbon::today();
                $employee_leave->period = 'day';
                $employee_leave->leave_type = 'unpaid';
                $employee_leave->user_id = $user->id;
                $employee_leave->status = 'approved';
                $employee_leave->save();
                // Creating Deducation 0.5 from salary For employee Because  Absent 
                $employee_deducation = new Staff_salary_deductions();
                $employee_deducation->amount = 0.5 * $user->salary;
                $employee_deducation->type = "deducation";
                $employee_deducation->reason = "UN Excecused Absent For His Session";
            }
        }
        $this->info("Checking Attendance For supervisors && Librarian Done");
    }
}
