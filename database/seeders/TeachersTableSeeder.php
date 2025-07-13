<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeachersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('teachers')->delete();

        DB::table('teachers')->insert(array(
            0 =>
            array(
                'id' => 4,
                'user_id' => 6,
                'subject_id' => 1,
                'Academic_qualification' => 'math master',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'permanent',
                'The_beginning_of_the_contract' => '2025-07-03',
                'End_of_contract' => '2025-07-16',
                'number_of_lesson_in_week' => 15,
                'wages_per_lesson' => 20,
                'created_at' => '2025-07-08 14:20:59',
                'updated_at' => '2025-07-08 14:20:59',
            ),
            1 =>
            array(
                'id' => 5,
                'user_id' => 7,
                'subject_id' => 1,
                'Academic_qualification' => 'math master',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'permanent',
                'The_beginning_of_the_contract' => '2025-07-03',
                'End_of_contract' => '2025-07-16',
                'number_of_lesson_in_week' => 15,
                'wages_per_lesson' => 20,
                'created_at' => '2025-07-08 14:21:43',
                'updated_at' => '2025-07-08 14:21:43',
            ),
            2 =>
            array(
                'id' => 6,
                'user_id' => 8,
                'subject_id' => 1,
                'Academic_qualification' => 'math master',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'permanent',
                'The_beginning_of_the_contract' => '2025-07-03',
                'End_of_contract' => '2025-07-16',
                'number_of_lesson_in_week' => 15,
                'wages_per_lesson' => 20,
                'created_at' => '2025-07-08 14:26:07',
                'updated_at' => '2025-07-08 14:26:07',
            ),
            3 =>
            array(
                'id' => 7,
                'user_id' => 9,
                'subject_id' => 1,
                'Academic_qualification' => 'math master',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'permanent',
                'The_beginning_of_the_contract' => '2025-07-03',
                'End_of_contract' => '2025-07-16',
                'number_of_lesson_in_week' => 15,
                'wages_per_lesson' => 20,
                'created_at' => '2025-07-08 14:40:39',
                'updated_at' => '2025-07-08 14:40:39',
            ),
            4 =>
            array(
                'id' => 8,
                'user_id' => 10,
                'subject_id' => 1,
                'Academic_qualification' => 'math master',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'permanent',
                'The_beginning_of_the_contract' => '2025-07-03',
                'End_of_contract' => '2025-07-16',
                'number_of_lesson_in_week' => 15,
                'wages_per_lesson' => 20,
                'created_at' => '2025-07-08 14:41:30',
                'updated_at' => '2025-07-08 14:41:30',
            ),
            5 =>
            array(
                'id' => 9,
                'user_id' => 11,
                'subject_id' => 1,
                'Academic_qualification' => 'math master',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'permanent',
                'The_beginning_of_the_contract' => '2025-07-03',
                'End_of_contract' => '2025-07-16',
                'number_of_lesson_in_week' => 15,
                'wages_per_lesson' => 20,
                'created_at' => '2025-07-08 14:45:45',
                'updated_at' => '2025-07-08 14:45:45',
            ),
            6 =>
            array(
                'id' => 10,
                'user_id' => 12,
                'subject_id' => 1,
                'Academic_qualification' => 'math master',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'permanent',
                'The_beginning_of_the_contract' => '2025-07-03',
                'End_of_contract' => '2025-07-16',
                'number_of_lesson_in_week' => 15,
                'wages_per_lesson' => 20,
                'created_at' => '2025-07-08 14:50:00',
                'updated_at' => '2025-07-08 14:50:00',
            ),
        ));
    }
}
