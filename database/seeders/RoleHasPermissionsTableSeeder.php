<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 1,
            ),
            1 => 
            array (
                'permission_id' => 1,
                'role_id' => 2,
            ),
            2 => 
            array (
                'permission_id' => 1,
                'role_id' => 3,
            ),
            3 => 
            array (
                'permission_id' => 1,
                'role_id' => 4,
            ),
            4 => 
            array (
                'permission_id' => 1,
                'role_id' => 5,
            ),
            5 => 
            array (
                'permission_id' => 1,
                'role_id' => 6,
            ),
            6 => 
            array (
                'permission_id' => 2,
                'role_id' => 1,
            ),
            7 => 
            array (
                'permission_id' => 2,
                'role_id' => 2,
            ),
            8 => 
            array (
                'permission_id' => 2,
                'role_id' => 3,
            ),
            9 => 
            array (
                'permission_id' => 2,
                'role_id' => 4,
            ),
            10 => 
            array (
                'permission_id' => 2,
                'role_id' => 5,
            ),
            11 => 
            array (
                'permission_id' => 2,
                'role_id' => 6,
            ),
        ));
        
        
    }
}