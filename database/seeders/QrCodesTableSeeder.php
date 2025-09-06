<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QrCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('qr_codes')->delete();
        
        \DB::table('qr_codes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'class_id' => 1,
                'user_id' => 1,
                'expires_at' => '2025-09-13 00:26:32',
                'Unique_code' => 'd0b757f6-5349-48d0-90bf-b35c9b29b0ac',
                'Code_type' => 'teacher',
                'is_Active' => 1,
                'created_at' => '2025-09-06 00:26:32',
                'updated_at' => '2025-09-06 00:26:32',
            ),
            1 => 
            array (
                'id' => 2,
                'class_id' => 2,
                'user_id' => 1,
                'expires_at' => '2025-09-13 00:26:33',
                'Unique_code' => 'de46e861-cdd5-4630-9b7e-1fd74c154485',
                'Code_type' => 'teacher',
                'is_Active' => 1,
                'created_at' => '2025-09-06 00:26:33',
                'updated_at' => '2025-09-06 00:26:33',
            ),
            2 => 
            array (
                'id' => 3,
                'class_id' => 3,
                'user_id' => 1,
                'expires_at' => '2025-09-13 00:26:33',
                'Unique_code' => 'acf0d2c7-b792-40c6-b1e2-995b30b0558a',
                'Code_type' => 'teacher',
                'is_Active' => 1,
                'created_at' => '2025-09-06 00:26:33',
                'updated_at' => '2025-09-06 00:26:33',
            ),
            3 => 
            array (
                'id' => 4,
                'class_id' => 4,
                'user_id' => 1,
                'expires_at' => '2025-09-13 00:26:33',
                'Unique_code' => '13404b1a-a791-4901-936c-917ffa2a21f0',
                'Code_type' => 'teacher',
                'is_Active' => 1,
                'created_at' => '2025-09-06 00:26:33',
                'updated_at' => '2025-09-06 00:26:33',
            ),
            4 => 
            array (
                'id' => 5,
                'class_id' => 5,
                'user_id' => 1,
                'expires_at' => '2025-09-13 00:26:33',
                'Unique_code' => '90701966-2afd-40fb-a1da-22bba2bb8ac3',
                'Code_type' => 'teacher',
                'is_Active' => 1,
                'created_at' => '2025-09-06 00:26:33',
                'updated_at' => '2025-09-06 00:26:33',
            ),
            5 => 
            array (
                'id' => 6,
                'class_id' => 6,
                'user_id' => 1,
                'expires_at' => '2025-09-13 00:26:33',
                'Unique_code' => '07cf2519-2bd9-4e86-8fcb-770e8711ca17',
                'Code_type' => 'teacher',
                'is_Active' => 1,
                'created_at' => '2025-09-06 00:26:33',
                'updated_at' => '2025-09-06 00:26:33',
            ),
            6 => 
            array (
                'id' => 7,
                'class_id' => 7,
                'user_id' => 1,
                'expires_at' => '2025-09-13 00:26:33',
                'Unique_code' => 'd0e1d00b-4b8e-488d-a69f-39f14906f10b',
                'Code_type' => 'teacher',
                'is_Active' => 1,
                'created_at' => '2025-09-06 00:26:33',
                'updated_at' => '2025-09-06 00:26:33',
            ),
            7 => 
            array (
                'id' => 8,
                'class_id' => 8,
                'user_id' => 1,
                'expires_at' => '2025-09-13 00:26:33',
                'Unique_code' => '5a8d8a91-075c-4b32-b4f9-0aebda127d40',
                'Code_type' => 'teacher',
                'is_Active' => 1,
                'created_at' => '2025-09-06 00:26:33',
                'updated_at' => '2025-09-06 00:26:33',
            ),
            8 => 
            array (
                'id' => 9,
                'class_id' => 9,
                'user_id' => 1,
                'expires_at' => '2025-09-13 00:26:33',
                'Unique_code' => 'd8080833-cb06-477c-be64-6df5f7f12da6',
                'Code_type' => 'teacher',
                'is_Active' => 1,
                'created_at' => '2025-09-06 00:26:33',
                'updated_at' => '2025-09-06 00:26:33',
            ),
            9 => 
            array (
                'id' => 10,
                'class_id' => NULL,
                'user_id' => 1,
                'expires_at' => '2025-09-13 00:26:43',
                'Unique_code' => 'cfce1398-1499-4f56-8087-d1c63e220f98',
                'Code_type' => 'employee',
                'is_Active' => 1,
                'created_at' => '2025-09-06 00:26:43',
                'updated_at' => '2025-09-06 00:26:43',
            ),
        ));
        
        
    }
}