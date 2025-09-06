<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationLevelsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('education_levels')->delete();

        DB::table('education_levels')->insert(array(
            0 =>
            array(
                'id' => 1,
                'created_at' => '2025-09-05 23:29:34',
                'updated_at' => '2025-09-05 23:29:34',
                'name' => 'Third primary',
                'description' => 'level for children with 8 or 9 years',
                'price' => 2500,
                'is_fully' => 0,
                'academic_year_id' => 1,
                'supervisor_id' => 1,
            ),
            1 =>
            array(
                'id' => 2,
                'created_at' => '2025-09-05 23:30:05',
                'updated_at' => '2025-09-05 23:30:05',
                'name' => 'first primary',
                'description' => 'level for children with 7 or 8 years',
                'price' => 3000,
                'is_fully' => 0,
                'academic_year_id' => 1,
                'supervisor_id' => 2,
            ),
            2 =>
            array(
                'id' => 3,
                'created_at' => '2025-09-05 23:30:30',
                'updated_at' => '2025-09-05 23:30:30',
                'name' => 'second primary',
                'description' => 'level for children with 6 or 7 years',
                'price' => 3000,
                'is_fully' => 0,
                'academic_year_id' => 1,
                'supervisor_id' => 3,
            ),
        ));
    }
}
