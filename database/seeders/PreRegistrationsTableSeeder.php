<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreRegistrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('pre_registrations')->delete();

        DB::table('pre_registrations')->insert(array(
            0 =>
            array(
                'id' => 1,
                'education_level_id' => 1,
                'student_name' => 'omar',
                'student_email' => 'omaralzehrawe@gmail.com',
                'parent_name' => 'fager',
                'parent_email' => 'fager@gmail.com',
                'phone_number' => '0968339198',
                'status' => 'accepted',
                'documents' => '[{"name": "Math", "grade": 90}, {"name": "Science", "grade": 85}]',
                'created_at' => '2025-07-01 10:24:19',
                'updated_at' => '2025-07-07 07:43:46',
            ),
        ));
    }
}
