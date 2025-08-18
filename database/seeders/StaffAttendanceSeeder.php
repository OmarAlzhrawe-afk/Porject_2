<?php

namespace Database\Seeders;

use App\Models\Staff_attendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffAttendanceSeeder extends Seeder
{
    public function run()
    {
        Staff_attendance::factory()->count(50)->create();
    }
}
