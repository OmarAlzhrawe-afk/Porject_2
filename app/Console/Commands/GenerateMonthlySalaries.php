<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Salary;
use App\Models\Staff_salary_deductions;
use App\Models\StaffSalaryDeduction;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SalaryReadyNotification;
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

            // Sending Notification 
            Notification::send($employee, new SalaryReadyNotification($salary));
        }

        $this->info('creating salaries and make Notifications done');
    }
}
