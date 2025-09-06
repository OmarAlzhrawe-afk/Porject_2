<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('terms')->delete();
        
        \DB::table('terms')->insert(array (
            0 => 
            array (
                'id' => 1,
                'academic_year_id' => 1,
                'name' => '2024-2025',
                'start_date' => '2024-01-01',
                'end_date' => '2025-01-01',
                'is_current' => 1,
                'created_at' => '2025-09-05 23:29:21',
                'updated_at' => '2025-09-05 23:29:21',
            ),
        ));
        
        
    }
}