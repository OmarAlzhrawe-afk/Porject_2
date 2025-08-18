<?php

namespace Database\Seeders;

use App\Models\Education_content;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationContentSeeder extends Seeder
{
    public function run()
    {
        $teachers = Teacher::all();

        foreach ($teachers as $teacher) {
            $classRooms = $teacher->sessions
                ->pluck('class_room')
                ->filter() // remove null values
                ->unique('id');
            // $classRooms = $teacher->sessions->pluck('class_room')->unique('id');
            foreach ($classRooms as $classRoom) {
                Education_content::factory()
                    ->count(rand(3, 5))
                    ->forTeacherAndClass($teacher->id, $classRoom->id)
                    ->create();
            }
        }
    }
}
