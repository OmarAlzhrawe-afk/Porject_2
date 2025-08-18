<?php

namespace Database\Seeders;

use App\Models\Staff_salary_deductions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffDeducationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff_salary_deductions::factory(20)->create();
    }
}
