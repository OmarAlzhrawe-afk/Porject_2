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
                'status' => 'on_leave',
                'created_at' => '2025-08-30 19:30:02',
                'updated_at' => '2025-08-30 19:30:02',
            ),
        ));
        
        
    }
}