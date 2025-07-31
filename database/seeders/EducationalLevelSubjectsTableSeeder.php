<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EducationalLevelSubjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('educational_level_subjects')->delete();
        
        \DB::table('educational_level_subjects')->insert(array (
            0 => 
            array (
                'id' => 1,
                'education_level_id' => 1,
                'subject_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'education_level_id' => 1,
                'subject_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'education_level_id' => 1,
                'subject_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'education_level_id' => 1,
                'subject_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'education_level_id' => 1,
                'subject_id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'education_level_id' => 1,
                'subject_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}