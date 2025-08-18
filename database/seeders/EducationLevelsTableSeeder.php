<?php

namespace Database\Seeders;

use App\Models\Education_level;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationLevelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Education_level::factory(5)->create();
    }
}
