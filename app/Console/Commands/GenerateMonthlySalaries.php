<?php

namespace App\Console\Commands;

use App\Events\NotificationsEvent\SalaryReadyNotificationEvent;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Salary;
use App\Models\Staff_salary_deductions;
use App\Models\StaffSalaryDeduction;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SalaryReadyNotification;
use App\Notifications\SupervisorSalaryNotification;
use Carbon\Carbon;

class GenerateMonthlySalaries extends Command
{
    protected $signature = 'salaries:generate';
    protected $description = 'creating salaries and make Notifications done';

    public function handle()
    {
        $employees = User::whereIn('role', ['teacher', 'supervisor', 'librarian'])->get();

        foreach ($employees as $employee) {
            $baseSalary = $employee->salary ?? 200;

            //calculate deduc
            $totalDeductions = Staff_salary_deductions::where('user_id', $employee->id)
                ->where('type', 'deducation')
                ->sum('amount');

            //calculate Bonos 
            $totalBonuses = Staff_salary_deductions::where('user_id', $employee->id)
                ->where('type', 'Bonos')
                ->sum('amount');

            // creating Salary 
            $salary = Salary::create([
                'user_id'    => $employee->id,
                'Base_salary' => $baseSalary,
                // 'net_salary' => $baseSalary - $totalDeductions + $totalBonuses,
                'bonus'      => $totalBonuses,
                'deductions' => $totalDeductions,
                'date'       => Carbon::now()->format('Y-m-d'),
                'status'     => 'pending',
                'notes'      => null,
            ]);

            if ($employee->role == 'supervisor') {
                $employee->notify(new SupervisorSalaryNotification($salary));
            } else {
                // Handling Notification 
                // preparing Message 
                $message = "Salary For : " . $employee->name  . " Is Ready";
                // Save Notification In dataBase
                $employee->notify(new SalaryReadyNotification("salary is ready", $message));
                // Broadcast Realtime Notification
                event(new SalaryReadyNotificationEvent("salary is ready", $message));
            }
            // Sending Notification 
            // Notification::send($employee, new SalaryReadyNotification($salary));
        }

        $this->info('creating salaries and make Notifications done');
    }
}
