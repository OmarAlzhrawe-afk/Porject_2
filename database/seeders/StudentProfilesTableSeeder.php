<?php

namespace Database\Seeders;

use App\Models\Student_profile;
use Illuminate\Database\Seeder;

class StudentProfilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Student_profile::factory()->count(30)->create();
    }
}
