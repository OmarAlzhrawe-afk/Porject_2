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
                'user_id' => 3,
                'status' => 'on_leave',
                'created_at' => '2025-07-30 23:17:17',
                'updated_at' => '2025-07-30 23:17:17',
            ),
        ));
        
        
    }
}