<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'guard_name' => 'api',
                'created_at' => '2025-08-30 19:27:50',
                'updated_at' => '2025-08-30 19:27:50',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'teacher',
                'guard_name' => 'api',
                'created_at' => '2025-08-30 19:27:50',
                'updated_at' => '2025-08-30 19:27:50',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'librarian',
                'guard_name' => 'api',
                'created_at' => '2025-08-30 19:27:50',
                'updated_at' => '2025-08-30 19:27:50',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'supervisor',
                'guard_name' => 'api',
                'created_at' => '2025-08-30 19:27:50',
                'updated_at' => '2025-08-30 19:27:50',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'student',
                'guard_name' => 'api',
                'created_at' => '2025-08-30 19:27:50',
                'updated_at' => '2025-08-30 19:27:50',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'parent',
                'guard_name' => 'api',
                'created_at' => '2025-08-30 19:27:50',
                'updated_at' => '2025-08-30 19:27:50',
            ),
        ));
        
        
    }
}