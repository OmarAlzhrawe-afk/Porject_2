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
                'token' => '18cbd6a29c2f6b8a615cab8289938202ad8d4ebdc6f58910334e55922aeb67f3',
                'abilities' => '["*"]',
                'expires_at' => NULL,
                'last_used_at' => '2025-07-30 23:30:00',
                'created_at' => '2025-07-30 23:10:25',
                'updated_at' => '2025-07-30 23:30:00',
            ),
            1 => 
            array (
                'id' => 2,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 2,
                'name' => 'librarian1',
                'token' => 'c122e51443a9573b6e1b8cd2b9c730f7ae0b129a8db53eeb6e0b9cc9ea338d98',
                'abilities' => '["*"]',
                'expires_at' => NULL,
                'last_used_at' => '2025-07-30 23:43:49',
                'created_at' => '2025-07-30 23:16:16',
                'updated_at' => '2025-07-30 23:43:49',
            ),
        ));
        
        
    }
}