<?php

namespace Database\Seeders;

use App\Models\Educationlevelsubject;
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
        Educationlevelsubject::factory(10)->create();
    }
}
