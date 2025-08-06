<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('teachers')->delete();
        
        \DB::table('teachers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 3,
                'subject_id' => 1,
                'Academic_qualification' => 'math_collage',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'temporary',
                'The_beginning_of_the_contract' => '2020-01-01',
                'End_of_contract' => '2021-01-01',
                'number_of_lesson_in_week' => 15,
                'wages_per_lesson' => 25,
                'created_at' => '2025-08-06 15:38:17',
                'updated_at' => '2025-08-06 15:38:17',
            ),
        ));
        
        
    }
}