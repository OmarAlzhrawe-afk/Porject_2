<?php

namespace Database\Seeders;

use App\Models\Class_session;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionsSeeder extends Seeder
{

    public function run()
    {
        Teacher::all()->each(function ($teacher) {
            Class_session::factory()->count($teacher->number_of_lesson_in_week)->forTeacher($teacher)->create();
        });
    }
}
