<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{


    public function run()
    {


        DB::table('roles')->delete();

        DB::table('roles')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'admin',
                'guard_name' => 'web',
                'created_at' => '2025-07-30 23:07:38',
                'updated_at' => '2025-07-30 23:07:38',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'teacher',
                'guard_name' => 'web',
                'created_at' => '2025-07-30 23:07:38',
                'updated_at' => '2025-07-30 23:07:38',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'librarian',
                'guard_name' => 'web',
                'created_at' => '2025-07-30 23:07:38',
                'updated_at' => '2025-07-30 23:07:38',
            ),
            3 =>
            array(
                'id' => 4,
                'name' => 'supervisor',
                'guard_name' => 'web',
                'created_at' => '2025-07-30 23:07:38',
                'updated_at' => '2025-07-30 23:07:38',
            ),
            4 =>
            array(
                'id' => 5,
                'name' => 'student',
                'guard_name' => 'web',
                'created_at' => '2025-07-30 23:07:38',
                'updated_at' => '2025-07-30 23:07:38',
            ),
            5 =>
            array(
                'id' => 6,
                'name' => 'parent',
                'guard_name' => 'web',
                'created_at' => '2025-07-30 23:07:38',
                'updated_at' => '2025-07-30 23:07:38',
            ),
        ));
    }
}
