<?php

namespace Database\Seeders;

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


        // DB::table('education_levels')->delete();

        DB::table('education_levels')->insert(array(
            0 =>
            array(
                'id' => 1,
                'created_at' => '2025-07-04 16:43:47',
                'updated_at' => '2025-07-04 16:43:47',
                'name' => 'first primary',
                'supervisor_id' => '1',
                'description' => 'this is for children',
            ),
        ));
    }
}
