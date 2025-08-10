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
                'token' => 'a7f4ff0807df9541ef948c7de578825b0d944e5cc75ec89bd29020eec4faf616',
                'abilities' => '["*"]',
                'expires_at' => NULL,
                'last_used_at' => '2025-08-10 05:21:59',
                'created_at' => '2025-08-08 03:14:15',
                'updated_at' => '2025-08-10 05:21:59',
            ),
            1 => 
            array (
                'id' => 2,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 2,
                'name' => 'supervisor1',
                'token' => '5db7a3c080913ae404382bac0c4dba1dff78715975a9bb11d6a7905f543c47bd',
                'abilities' => '["*"]',
                'expires_at' => NULL,
                'last_used_at' => '2025-08-08 05:20:30',
                'created_at' => '2025-08-08 04:09:52',
                'updated_at' => '2025-08-08 05:20:30',
            ),
            2 => 
            array (
                'id' => 3,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 12,
                'name' => 'librarianbase',
                'token' => '6d42eb38abf43fc96f856e68a510439c2e5101ccf7e5ab545897071b1ef864d6',
                'abilities' => '["*"]',
                'expires_at' => NULL,
                'last_used_at' => '2025-08-10 05:29:27',
                'created_at' => '2025-08-10 05:13:17',
                'updated_at' => '2025-08-10 05:29:27',
            ),
        ));
        
        
    }
}