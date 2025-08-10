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
                'ID_documents' => '"[\\"id_card.pdf\\",\\"passport.jpg\\"]"',
                'phone_number' => '01012345678',
                'salary' => NULL,
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
                'name' => 'supervisor1',
                'email' => 'supervisor1@gmail.com',
                'password' => NULL,
                'role' => 'supervisor',
                'hire_date' => NULL,
                'ID_documents' => '{"father_id":"uploads\\/users\\/IDs\\/2\\/17546121280_SE2_2022-2023-2.pdf","mother_id":"uploads\\/users\\/IDs\\/2\\/17546121281_SE2_2022-2023-2.pdf","family_id":"uploads\\/users\\/IDs\\/2\\/17546121282_SE2_2022-2023-2.pdf"}',
                'phone_number' => '0968339198',
                'salary' => 2000,
                'birth_date' => '2025-07-01',
                'gender' => 'male',
                'email_verified_at' => NULL,
                'address' => 'damascus , Barzeh',
                'remember_token' => NULL,
                'created_at' => '2025-08-08 03:15:28',
                'updated_at' => '2025-08-08 03:15:28',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'parent1',
                'email' => 'parent1@gmail.com',
                'password' => NULL,
                'role' => 'parent',
                'hire_date' => NULL,
                'ID_documents' => '{"father_id":"uploads\\/users\\/IDs\\/4\\/17546123290_SE2_2022-2023-2.pdf","mother_id":"uploads\\/users\\/IDs\\/4\\/17546123291_SE2_2022-2023-2.pdf","family_id":"uploads\\/users\\/IDs\\/4\\/17546123292_SE2_2022-2023-2.pdf"}',
                'phone_number' => '0968339198',
                'salary' => NULL,
                'birth_date' => '2025-07-01',
                'gender' => 'male',
                'email_verified_at' => NULL,
                'address' => 'damascus , Barzeh',
                'remember_token' => NULL,
                'created_at' => '2025-08-08 03:18:49',
                'updated_at' => '2025-08-08 03:18:49',
            ),
            3 => 
            array (
                'id' => 7,
                'name' => 'student5',
                'email' => 'student5@gmail.com',
                'password' => NULL,
                'role' => 'student',
                'hire_date' => NULL,
                'ID_documents' => '{"father_id":"uploads\\/users\\/IDs\\/7\\/17546125680_SE2_2022-2023-2.pdf","mother_id":"uploads\\/users\\/IDs\\/7\\/17546125681_SE2_2022-2023-2.pdf","family_id":"uploads\\/users\\/IDs\\/7\\/17546125682_SE2_2022-2023-2.pdf"}',
                'phone_number' => '0968339198',
                'salary' => NULL,
                'birth_date' => '2025-07-01',
                'gender' => 'male',
                'email_verified_at' => NULL,
                'address' => 'damascus , Barzeh',
                'remember_token' => NULL,
                'created_at' => '2025-08-08 03:22:48',
                'updated_at' => '2025-08-08 03:22:48',
            ),
            4 => 
            array (
                'id' => 8,
                'name' => 'badr',
                'email' => 'badr@gmail.com',
                'password' => NULL,
                'role' => 'student',
                'hire_date' => '2025-08-08',
                'ID_documents' => '""',
                'phone_number' => '0968339198',
                'salary' => NULL,
                'birth_date' => NULL,
                'gender' => NULL,
                'email_verified_at' => NULL,
                'address' => NULL,
                'remember_token' => NULL,
                'created_at' => '2025-08-08 03:42:19',
                'updated_at' => '2025-08-08 03:42:19',
            ),
            5 => 
            array (
                'id' => 9,
                'name' => 'fager',
                'email' => 'fager@gmail.com',
                'password' => NULL,
                'role' => 'parent',
                'hire_date' => '2025-08-08',
                'ID_documents' => NULL,
                'phone_number' => '0968339198',
                'salary' => NULL,
                'birth_date' => NULL,
                'gender' => NULL,
                'email_verified_at' => NULL,
                'address' => NULL,
                'remember_token' => NULL,
                'created_at' => '2025-08-08 03:42:19',
                'updated_at' => '2025-08-08 03:42:19',
            ),
            6 => 
            array (
                'id' => 10,
                'name' => 'badr',
                'email' => 'badr@gmail.com',
                'password' => NULL,
                'role' => 'student',
                'hire_date' => '2025-08-08',
                'ID_documents' => '""',
                'phone_number' => '0968339198',
                'salary' => NULL,
                'birth_date' => NULL,
                'gender' => NULL,
                'email_verified_at' => NULL,
                'address' => NULL,
                'remember_token' => NULL,
                'created_at' => '2025-08-08 03:42:43',
                'updated_at' => '2025-08-08 03:42:43',
            ),
            7 => 
            array (
                'id' => 11,
                'name' => 'fager',
                'email' => 'fager@gmail.com',
                'password' => NULL,
                'role' => 'parent',
                'hire_date' => '2025-08-08',
                'ID_documents' => NULL,
                'phone_number' => '0968339198',
                'salary' => NULL,
                'birth_date' => NULL,
                'gender' => NULL,
                'email_verified_at' => NULL,
                'address' => NULL,
                'remember_token' => NULL,
                'created_at' => '2025-08-08 03:42:43',
                'updated_at' => '2025-08-08 03:42:43',
            ),
            8 => 
            array (
                'id' => 12,
                'name' => 'librarianbase',
                'email' => 'librarianbase@gmail.com',
                'password' => NULL,
                'role' => 'librarian',
                'hire_date' => NULL,
                'ID_documents' => '{"father_id":"uploads\\/users\\/IDs\\/12\\/17547919440_SE2_2022-2023-2.pdf","mother_id":"uploads\\/users\\/IDs\\/12\\/17547919441_SE2_2022-2023-2.pdf","family_id":"uploads\\/users\\/IDs\\/12\\/17547919442_SE2_2022-2023-2.pdf"}',
                'phone_number' => '0968339198',
                'salary' => 2000,
                'birth_date' => '2025-07-01',
                'gender' => 'male',
                'email_verified_at' => NULL,
                'address' => 'damascus , Barzeh',
                'remember_token' => NULL,
                'created_at' => '2025-08-10 05:12:24',
                'updated_at' => '2025-08-10 05:12:24',
            ),
        ));
        
        
    }
}