<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupervisorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('supervisors')->delete();
        
        \DB::table('supervisors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'status' => 'active',
                'created_at' => '2025-09-05 23:26:56',
                'updated_at' => '2025-09-05 23:26:56',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 3,
                'status' => 'active',
                'created_at' => '2025-09-05 23:27:05',
                'updated_at' => '2025-09-05 23:27:05',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 4,
                'status' => 'active',
                'created_at' => '2025-09-05 23:27:16',
                'updated_at' => '2025-09-05 23:27:16',
            ),
        ));
        
        
    }
}