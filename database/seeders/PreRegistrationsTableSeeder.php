<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PreRegistrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pre_registrations')->delete();
        
        \DB::table('pre_registrations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'education_level_id' => 1,
                'installment_plan_id' => 1,
                'payment_reference' => NULL,
                'payment_status' => 0,
                'student_name' => 'mohab',
                'student_email' => 'mohab@gmail.com',
                'parent_name' => 'raaed',
                'parent_email' => 'raaed@gmail.com',
                'phone_number' => '09658992662',
                'status' => 'pending',
                'documents' => '{"healthy":"uploads\\/student\\/pre_redesteration\\/Files\\/mohab\\/17571107290_\\u0635\\u0648\\u0631\\u0629 \\u0647\\u0648\\u064a\\u0629.jpg","father":"uploads\\/student\\/pre_redesteration\\/Files\\/mohab\\/17571107291_\\u0635\\u0648\\u0631\\u0629 \\u0647\\u0648\\u064a\\u0629.jpg","mother":"uploads\\/student\\/pre_redesteration\\/Files\\/mohab\\/17571107292_\\u0635\\u0648\\u0631\\u0629 \\u0647\\u0648\\u064a\\u0629.jpg"}',
                'created_at' => '2025-09-06 01:18:49',
                'updated_at' => '2025-09-06 01:18:49',
            ),
            1 => 
            array (
                'id' => 2,
                'education_level_id' => 1,
                'installment_plan_id' => 1,
                'payment_reference' => NULL,
                'payment_status' => 0,
                'student_name' => 'mostafa',
                'student_email' => 'mostafa@gmail.com',
                'parent_name' => 'majd',
                'parent_email' => 'majd@gmail.com',
                'phone_number' => '09658992662',
                'status' => 'pending',
                'documents' => '{"healthy":"uploads\\/student\\/pre_redesteration\\/Files\\/mostafa\\/17571107600_\\u0635\\u0648\\u0631\\u0629 \\u0647\\u0648\\u064a\\u0629.jpg","father":"uploads\\/student\\/pre_redesteration\\/Files\\/mostafa\\/17571107601_\\u0635\\u0648\\u0631\\u0629 \\u0647\\u0648\\u064a\\u0629.jpg","mother":"uploads\\/student\\/pre_redesteration\\/Files\\/mostafa\\/17571107602_\\u0635\\u0648\\u0631\\u0629 \\u0647\\u0648\\u064a\\u0629.jpg"}',
                'created_at' => '2025-09-06 01:19:20',
                'updated_at' => '2025-09-06 01:19:20',
            ),
            2 => 
            array (
                'id' => 3,
                'education_level_id' => 1,
                'installment_plan_id' => 1,
                'payment_reference' => NULL,
                'payment_status' => 0,
                'student_name' => 'tasneeem',
                'student_email' => 'tasneeem@gmail.com',
                'parent_name' => 'mahmood',
                'parent_email' => 'mahmood@gmail.com',
                'phone_number' => '09658992662',
                'status' => 'pending',
                'documents' => '{"healthy":"uploads\\/student\\/pre_redesteration\\/Files\\/tasneeem\\/17571107990_\\u0635\\u0648\\u0631\\u0629 \\u0647\\u0648\\u064a\\u0629.jpg","father":"uploads\\/student\\/pre_redesteration\\/Files\\/tasneeem\\/17571107991_\\u0635\\u0648\\u0631\\u0629 \\u0647\\u0648\\u064a\\u0629.jpg","mother":"uploads\\/student\\/pre_redesteration\\/Files\\/tasneeem\\/17571107992_\\u0635\\u0648\\u0631\\u0629 \\u0647\\u0648\\u064a\\u0629.jpg"}',
                'created_at' => '2025-09-06 01:19:59',
                'updated_at' => '2025-09-06 01:19:59',
            ),
        ));
        
        
    }
}