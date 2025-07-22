<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'view dashborad',
                'guard_name' => 'web',
                'created_at' => '2025-07-21 20:23:12',
                'updated_at' => '2025-07-21 20:23:12',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'manage users',
                'guard_name' => 'web',
                'created_at' => '2025-07-21 20:23:12',
                'updated_at' => '2025-07-21 20:23:12',
            ),
        ));
        
        
    }
}