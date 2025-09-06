<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StaffSalaryDeductionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('staff_salary_deductions')->delete();
        
        
        
    }
}