<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AcademicYearsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('academic_years')->delete();
        
        \DB::table('academic_years')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '2025-2026',
                'start_date' => '2025-01-01',
                'end_date' => '2026-01-01',
                'is_current' => 1,
                'created_at' => '2025-09-05 23:29:07',
                'updated_at' => '2025-09-05 23:29:07',
            ),
        ));
        
        
    }
}