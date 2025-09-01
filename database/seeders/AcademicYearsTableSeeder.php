<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicYearsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('academic_years')->delete();

        DB::table('academic_years')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => '2024-2025',
                'start_date' => '2024-01-01',
                'end_date' => '2024-01-01',
                'is_current' => 1,
                'created_at' => '2025-08-30 19:29:28',
                'updated_at' => '2025-08-30 19:29:28',
            ),
        ));
    }
}
