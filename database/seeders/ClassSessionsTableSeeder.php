<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClassSessionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('class_sessions')->delete();
        
        \DB::table('class_sessions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'session_day' => 'Wednesday',
                'start_time' => '03:15:00',
                'end_time' => '04:00:00',
                'created_at' => '2025-08-06 15:38:29',
                'updated_at' => '2025-08-06 15:38:29',
            ),
            1 => 
            array (
                'id' => 2,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'session_day' => 'Wednesday',
                'start_time' => '04:00:00',
                'end_time' => '04:45:00',
                'created_at' => '2025-08-06 16:07:18',
                'updated_at' => '2025-08-06 16:07:18',
            ),
        ));
        
        
    }
}