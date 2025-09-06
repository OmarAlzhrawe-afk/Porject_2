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
                'user_id' => 6,
                'subject_id' => 1,
                'Academic_qualification' => 'math_collage',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'temporary',
                'The_beginning_of_the_contract' => '2020-01-01',
                'End_of_contract' => '2021-01-01',
                'number_of_lesson_in_week' => 19,
                'wages_per_lesson' => 25,
                'created_at' => '2025-09-05 23:48:18',
                'updated_at' => '2025-09-06 00:24:11',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 7,
                'subject_id' => 2,
                'Academic_qualification' => 'math_collage',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'temporary',
                'The_beginning_of_the_contract' => '2020-01-01',
                'End_of_contract' => '2021-01-01',
                'number_of_lesson_in_week' => 17,
                'wages_per_lesson' => 25,
                'created_at' => '2025-09-05 23:48:34',
                'updated_at' => '2025-09-06 00:22:19',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 8,
                'subject_id' => 3,
                'Academic_qualification' => 'math_collage',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'temporary',
                'The_beginning_of_the_contract' => '2020-01-01',
                'End_of_contract' => '2021-01-01',
                'number_of_lesson_in_week' => 17,
                'wages_per_lesson' => 25,
                'created_at' => '2025-09-05 23:48:48',
                'updated_at' => '2025-09-06 00:22:33',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 9,
                'subject_id' => 3,
                'Academic_qualification' => 'math_collage',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'temporary',
                'The_beginning_of_the_contract' => '2020-01-01',
                'End_of_contract' => '2021-01-01',
                'number_of_lesson_in_week' => 17,
                'wages_per_lesson' => 25,
                'created_at' => '2025-09-05 23:49:01',
                'updated_at' => '2025-09-06 00:22:49',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 10,
                'subject_id' => 4,
                'Academic_qualification' => 'math_collage',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'temporary',
                'The_beginning_of_the_contract' => '2020-01-01',
                'End_of_contract' => '2021-01-01',
                'number_of_lesson_in_week' => 17,
                'wages_per_lesson' => 25,
                'created_at' => '2025-09-05 23:49:25',
                'updated_at' => '2025-09-06 00:23:30',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 11,
                'subject_id' => 5,
                'Academic_qualification' => 'math_collage',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'temporary',
                'The_beginning_of_the_contract' => '2020-01-01',
                'End_of_contract' => '2021-01-01',
                'number_of_lesson_in_week' => 16,
                'wages_per_lesson' => 25,
                'created_at' => '2025-09-05 23:49:46',
                'updated_at' => '2025-09-06 00:23:51',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 12,
                'subject_id' => 5,
                'Academic_qualification' => 'math_collage',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'temporary',
                'The_beginning_of_the_contract' => '2020-01-01',
                'End_of_contract' => '2021-01-01',
                'number_of_lesson_in_week' => 15,
                'wages_per_lesson' => 25,
                'created_at' => '2025-09-05 23:50:03',
                'updated_at' => '2025-09-05 23:50:03',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 13,
                'subject_id' => 6,
                'Academic_qualification' => 'math_collage',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'temporary',
                'The_beginning_of_the_contract' => '2020-01-01',
                'End_of_contract' => '2021-01-01',
                'number_of_lesson_in_week' => 15,
                'wages_per_lesson' => 25,
                'created_at' => '2025-09-05 23:50:35',
                'updated_at' => '2025-09-05 23:50:35',
            ),
        ));
        
        
    }
}