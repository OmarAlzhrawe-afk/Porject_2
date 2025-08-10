<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EducationLevelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('education_levels')->delete();

        \DB::table('education_levels')->insert(array(
            0 =>
            array(
                'id' => 1,
                'created_at' => '2025-08-08 03:15:38',
                'updated_at' => '2025-08-08 20:13:42',
                'name' => 'first_primary',
                'Acadimic_year' => '2026-10-10',
                'description' => 'this is the first Level Education',
                'price' => 200,
                'is_fully' => 1,
                'supervisor_id' => 1,
            ),
            1 =>
            array(
                'id' => 3,
                'created_at' => '2025-08-09 04:46:53',
                'updated_at' => '2025-08-09 04:46:53',
                'name' => 'third_primary',
                'Acadimic_year' => '2026-10-10',
                'description' => 'this is the third_primaryLevel Education',
                'price' => 200,
                'is_fully' => 0,
                'supervisor_id' => 1,
            ),
        ));
    }
}
