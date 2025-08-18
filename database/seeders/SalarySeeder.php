<?php

namespace Database\Seeders;

use App\Models\Salary;
use App\Models\Staff_salary_deductions;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalarySeeder extends Seeder
{
    public function run()
    {
        $employeeTypes = ['teacher', 'supervisor', 'librarian'];

        $employees = User::whereIn('role', $employeeTypes)->get();

        $months = 6;
        $currentMonth = Carbon::now()->startOfMonth();

        foreach ($employees as $employee) {
            for ($i = 0; $i < $months; $i++) {
                $salaryDate = $currentMonth->copy()->subMonths($i);
                $bonus = Staff_salary_deductions::where('user_id', $employee->id)
                    ->where('type', 'Bonos')
                    ->whereMonth('created_at', $salaryDate->month)
                    ->whereYear('created_at', $salaryDate->year)
                    ->sum('amount');
                $deductions = Staff_salary_deductions::where('user_id', $employee->id)
                    ->where('type', 'deducation')
                    ->whereMonth('created_at', $salaryDate->month)
                    ->whereYear('created_at', $salaryDate->year)
                    ->sum('amount');
                Salary::create([
                    'user_id' => $employee->id,
                    'Base_salary' => match ($employee->role) {
                        'teacher' => 1200,
                        'supervisor' => 1500,
                        'librarian' => 1000,
                        default => 800,
                    },
                    'bonus' => $deductions ?? 100,
                    'deductions' => $bonus ?? 100,
                    'date' => $salaryDate->format('Y-m-d'),
                    'status' => $salaryDate->lt(Carbon::now()->startOfMonth()) ? 'paid' : 'pending',
                    'notes' => 'راتب شهر ' . $salaryDate->format('F Y'),
                ]);
            }
        }
    }
}
