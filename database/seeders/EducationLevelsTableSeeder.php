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
        
        \DB::table('education_levels')->insert(array (
            0 => 
            array (
                'id' => 1,
                'created_at' => '2025-07-30 23:17:41',
                'updated_at' => '2025-07-30 23:17:41',
                'name' => 'first_primary',
                'Acadimic_year' => '2026-10-10',
                'description' => 'this is the first Level Education',
                'price' => 200,
                'is_fully' => 0,
                'supervisor_id' => 1,
            ),
        ));
        
        
    }
}