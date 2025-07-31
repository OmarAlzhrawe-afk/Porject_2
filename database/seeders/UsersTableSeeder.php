<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => 'password123',
                'role' => 'admin',
                'hire_date' => '2023-01-01',
                'ID_documents' => '["id_card.pdf","passport.jpg"]',
                'phone_number' => '01012345678',
                'birth_date' => '1990-05-15',
                'gender' => 'male',
                'email_verified_at' => NULL,
                'address' => '123 Admin Street, City',
                'remember_token' => NULL,
                'created_at' => '2025-07-30 23:07:38',
                'updated_at' => '2025-07-30 23:07:38',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'librarian1',
                'email' => 'librarian1@gmail.com',
                'password' => NULL,
                'role' => 'librarian',
                'hire_date' => NULL,
                'ID_documents' => '{"father_id":"uploads\\/users\\/IDs\\/2\\/17539172100_SE2_2022-2023-2.pdf","mother_id":"uploads\\/users\\/IDs\\/2\\/17539172101_SE2_2022-2023-2.pdf","family_id":"uploads\\/users\\/IDs\\/2\\/17539172102_SE2_2022-2023-2.pdf"}',
                'phone_number' => '0968339198',
                'birth_date' => '2025-07-01',
                'gender' => 'male',
                'email_verified_at' => NULL,
                'address' => 'damascus , Barzeh',
                'remember_token' => NULL,
                'created_at' => '2025-07-30 23:13:30',
                'updated_at' => '2025-07-30 23:13:30',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'supervisor1',
                'email' => 'supervisor1@gmail.com',
                'password' => NULL,
                'role' => 'supervisor',
                'hire_date' => NULL,
                'ID_documents' => '{"father_id":"uploads\\/users\\/IDs\\/3\\/17539174370_SE2_2022-2023-2.pdf","mother_id":"uploads\\/users\\/IDs\\/3\\/17539174371_SE2_2022-2023-2.pdf","family_id":"uploads\\/users\\/IDs\\/3\\/17539174372_SE2_2022-2023-2.pdf"}',
                'phone_number' => '0968339198',
                'birth_date' => '2025-07-01',
                'gender' => 'male',
                'email_verified_at' => NULL,
                'address' => 'damascus , Barzeh',
                'remember_token' => NULL,
                'created_at' => '2025-07-30 23:17:17',
                'updated_at' => '2025-07-30 23:17:17',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'student1',
                'email' => 'student1@gmail.com',
                'password' => NULL,
                'role' => 'student',
                'hire_date' => NULL,
                'ID_documents' => '{"father_id":"uploads\\/users\\/IDs\\/4\\/17539175870_SE2_2022-2023-2.pdf","mother_id":"uploads\\/users\\/IDs\\/4\\/17539175871_SE2_2022-2023-2.pdf","family_id":"uploads\\/users\\/IDs\\/4\\/17539175872_SE2_2022-2023-2.pdf"}',
                'phone_number' => '0968339198',
                'birth_date' => '2025-07-01',
                'gender' => 'male',
                'email_verified_at' => NULL,
                'address' => 'damascus , Barzeh',
                'remember_token' => NULL,
                'created_at' => '2025-07-30 23:19:47',
                'updated_at' => '2025-07-30 23:19:47',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'student2',
                'email' => 'student2@gmail.com',
                'password' => NULL,
                'role' => 'student',
                'hire_date' => NULL,
                'ID_documents' => '{"father_id":"uploads\\/users\\/IDs\\/5\\/17539175980_SE2_2022-2023-2.pdf","mother_id":"uploads\\/users\\/IDs\\/5\\/17539175981_SE2_2022-2023-2.pdf","family_id":"uploads\\/users\\/IDs\\/5\\/17539175982_SE2_2022-2023-2.pdf"}',
                'phone_number' => '0968339198',
                'birth_date' => '2025-07-01',
                'gender' => 'male',
                'email_verified_at' => NULL,
                'address' => 'damascus , Barzeh',
                'remember_token' => NULL,
                'created_at' => '2025-07-30 23:19:58',
                'updated_at' => '2025-07-30 23:19:58',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'student3',
                'email' => 'student3@gmail.com',
                'password' => NULL,
                'role' => 'student',
                'hire_date' => NULL,
                'ID_documents' => '{"father_id":"uploads\\/users\\/IDs\\/6\\/17539176070_SE2_2022-2023-2.pdf","mother_id":"uploads\\/users\\/IDs\\/6\\/17539176071_SE2_2022-2023-2.pdf","family_id":"uploads\\/users\\/IDs\\/6\\/17539176072_SE2_2022-2023-2.pdf"}',
                'phone_number' => '0968339198',
                'birth_date' => '2025-07-01',
                'gender' => 'male',
                'email_verified_at' => NULL,
                'address' => 'damascus , Barzeh',
                'remember_token' => NULL,
                'created_at' => '2025-07-30 23:20:07',
                'updated_at' => '2025-07-30 23:20:07',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'student4',
                'email' => 'student4@gmail.com',
                'password' => NULL,
                'role' => 'student',
                'hire_date' => NULL,
                'ID_documents' => '{"father_id":"uploads\\/users\\/IDs\\/7\\/17539176170_SE2_2022-2023-2.pdf","mother_id":"uploads\\/users\\/IDs\\/7\\/17539176171_SE2_2022-2023-2.pdf","family_id":"uploads\\/users\\/IDs\\/7\\/17539176172_SE2_2022-2023-2.pdf"}',
                'phone_number' => '0968339198',
                'birth_date' => '2025-07-01',
                'gender' => 'male',
                'email_verified_at' => NULL,
                'address' => 'damascus , Barzeh',
                'remember_token' => NULL,
                'created_at' => '2025-07-30 23:20:17',
                'updated_at' => '2025-07-30 23:20:17',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'parent1',
                'email' => 'parent1@gmail.com',
                'password' => NULL,
                'role' => 'parent',
                'hire_date' => NULL,
                'ID_documents' => '{"father_id":"uploads\\/users\\/IDs\\/8\\/17539182000_SE2_2022-2023-2.pdf","mother_id":"uploads\\/users\\/IDs\\/8\\/17539182001_SE2_2022-2023-2.pdf","family_id":"uploads\\/users\\/IDs\\/8\\/17539182002_SE2_2022-2023-2.pdf"}',
                'phone_number' => '0968339198',
                'birth_date' => '2025-07-01',
                'gender' => 'male',
                'email_verified_at' => NULL,
                'address' => 'damascus , Barzeh',
                'remember_token' => NULL,
                'created_at' => '2025-07-30 23:30:00',
                'updated_at' => '2025-07-30 23:30:00',
            ),
        ));
        
        
    }
}