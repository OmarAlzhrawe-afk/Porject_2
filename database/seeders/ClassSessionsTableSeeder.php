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
                'session_day' => 'Saturday',
                'start_time' => '08:00:00',
                'end_time' => '08:45:00',
                'created_at' => '2025-08-31 00:06:45',
                'updated_at' => '2025-08-31 00:06:45',
            ),
            1 => 
            array (
                'id' => 2,
                'teacher_id' => 1,
                'class_room_id' => 2,
                'session_day' => 'Saturday',
                'start_time' => '08:45:00',
                'end_time' => '09:30:00',
                'created_at' => '2025-08-31 00:07:20',
                'updated_at' => '2025-08-31 00:07:20',
            ),
            2 => 
            array (
                'id' => 3,
                'teacher_id' => 1,
                'class_room_id' => 3,
                'session_day' => 'Saturday',
                'start_time' => '09:30:00',
                'end_time' => '10:15:00',
                'created_at' => '2025-08-31 00:08:03',
                'updated_at' => '2025-08-31 00:08:03',
            ),
            3 => 
            array (
                'id' => 4,
                'teacher_id' => 1,
                'class_room_id' => 3,
                'session_day' => 'Saturday',
                'start_time' => '10:15:00',
                'end_time' => '11:00:00',
                'created_at' => '2025-08-31 00:19:56',
                'updated_at' => '2025-08-31 00:19:56',
            ),
        ));
        
        
    }
}