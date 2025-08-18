<?php

namespace Database\Seeders;

use App\Models\Student_attendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentAttendanceSeeder extends Seeder
{
    public function run()
    {
        Student_attendance::factory()->count(100)->create();
    }
}
