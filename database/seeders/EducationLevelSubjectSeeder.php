<?php

namespace Database\Seeders;

use App\Models\Education_level;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationLevelSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = Education_level::all();
        $subjects = Subject::all();
        foreach ($levels as $level) {
            $randsubjects  = $subjects->random(3)->pluck('id')->toArray();
            $level->subjects()->attach($randsubjects);
        }
    }
}
