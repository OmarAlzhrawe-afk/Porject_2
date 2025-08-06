<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PersonalAccessTokensTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('personal_access_tokens')->delete();
        
        \DB::table('personal_access_tokens')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 1,
                'name' => 'Admin User',
                'token' => 'b31f59ec3f7139ccf232dc91370d02b5ba357f67f542cd51dba7c425819ec258',
                'abilities' => '["*"]',
                'expires_at' => NULL,
                'last_used_at' => '2025-08-06 16:07:18',
                'created_at' => '2025-08-06 15:37:00',
                'updated_at' => '2025-08-06 16:07:18',
            ),
            1 => 
            array (
                'id' => 2,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 2,
                'name' => 'supervisor1',
                'token' => '3860c04b4700f10901ea14df7129067d424f2f9641f1e81806feecc756a39b05',
                'abilities' => '["*"]',
                'expires_at' => NULL,
                'last_used_at' => '2025-08-06 16:03:31',
                'created_at' => '2025-08-06 15:39:17',
                'updated_at' => '2025-08-06 16:03:31',
            ),
            2 => 
            array (
                'id' => 3,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 3,
                'name' => 'teacher1',
                'token' => '05d073edd4b39883cf31424f789b26d108fd3abb96548162f51aec78d28970d6',
                'abilities' => '["*"]',
                'expires_at' => NULL,
                'last_used_at' => '2025-08-06 16:31:49',
                'created_at' => '2025-08-06 16:04:48',
                'updated_at' => '2025-08-06 16:31:49',
            ),
        ));
        
        
    }
}