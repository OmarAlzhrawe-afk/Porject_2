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
                'id' => 1,
                'user_id' => 15,
                'subject_id' => 1,
                'Academic_qualification' => 'cascascascasc',
                'Employment_status' => 'active',
                'Payment_type' => 'monthly',
                'Contract_type' => 'temporary',
                'The_beginning_of_the_contract' => '2025-09-03',
                'End_of_contract' => '2025-09-08',
                'number_of_lesson_in_week' => 20,
                'wages_per_lesson' => 20,
                'created_at' => '2025-09-24 14:46:13',
                'updated_at' => '2025-09-24 14:46:13',
            ),

        ));
    }
}
