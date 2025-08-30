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
                'created_at' => '2025-08-30 19:30:16',
                'updated_at' => '2025-08-30 19:30:16',
                'name' => 'first',
                'description' => 'this is the third_primaryLevel Education',
                'price' => 200,
                'is_fully' => 0,
                'academic_year_id' => 1,
                'supervisor_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'created_at' => '2025-08-30 19:30:44',
                'updated_at' => '2025-08-30 19:30:44',
                'name' => 'second',
                'description' => 'this is the second_primaryLevel Education',
                'price' => 200,
                'is_fully' => 0,
                'academic_year_id' => 1,
                'supervisor_id' => 1,
            ),
        ));
        
        
    }
}