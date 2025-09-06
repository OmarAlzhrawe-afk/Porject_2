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
                'session_day' => 'Monday',
                'start_time' => '08:00:00',
                'end_time' => '08:45:00',
                'created_at' => '2025-09-06 00:16:55',
                'updated_at' => '2025-09-06 00:16:55',
            ),
            1 => 
            array (
                'id' => 2,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'session_day' => 'Sunday',
                'start_time' => '08:00:00',
                'end_time' => '08:45:00',
                'created_at' => '2025-09-06 00:17:06',
                'updated_at' => '2025-09-06 00:17:06',
            ),
            2 => 
            array (
                'id' => 3,
                'teacher_id' => 2,
                'class_room_id' => 1,
                'session_day' => 'Monday',
                'start_time' => '09:00:00',
                'end_time' => '09:45:00',
                'created_at' => '2025-09-06 00:18:24',
                'updated_at' => '2025-09-06 00:18:24',
            ),
            3 => 
            array (
                'id' => 4,
                'teacher_id' => 3,
                'class_room_id' => 1,
                'session_day' => 'Tuesday',
                'start_time' => '12:00:00',
                'end_time' => '12:30:00',
                'created_at' => '2025-09-06 00:20:51',
                'updated_at' => '2025-09-06 00:20:51',
            ),
            4 => 
            array (
                'id' => 5,
                'teacher_id' => 4,
                'class_room_id' => 1,
                'session_day' => 'Tuesday',
                'start_time' => '12:30:00',
                'end_time' => '01:30:00',
                'created_at' => '2025-09-06 00:21:09',
                'updated_at' => '2025-09-06 00:21:09',
            ),
            5 => 
            array (
                'id' => 6,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'session_day' => 'Wednesday',
                'start_time' => '08:00:00',
                'end_time' => '08:30:00',
                'created_at' => '2025-09-06 00:22:04',
                'updated_at' => '2025-09-06 00:22:04',
            ),
            6 => 
            array (
                'id' => 7,
                'teacher_id' => 2,
                'class_room_id' => 1,
                'session_day' => 'Wednesday',
                'start_time' => '08:30:00',
                'end_time' => '09:00:00',
                'created_at' => '2025-09-06 00:22:19',
                'updated_at' => '2025-09-06 00:22:19',
            ),
            7 => 
            array (
                'id' => 8,
                'teacher_id' => 3,
                'class_room_id' => 1,
                'session_day' => 'Wednesday',
                'start_time' => '09:00:00',
                'end_time' => '09:30:00',
                'created_at' => '2025-09-06 00:22:33',
                'updated_at' => '2025-09-06 00:22:33',
            ),
            8 => 
            array (
                'id' => 9,
                'teacher_id' => 4,
                'class_room_id' => 1,
                'session_day' => 'Wednesday',
                'start_time' => '09:30:00',
                'end_time' => '10:00:00',
                'created_at' => '2025-09-06 00:22:49',
                'updated_at' => '2025-09-06 00:22:49',
            ),
            9 => 
            array (
                'id' => 10,
                'teacher_id' => 5,
                'class_room_id' => 1,
                'session_day' => 'Wednesday',
                'start_time' => '10:00:00',
                'end_time' => '10:30:00',
                'created_at' => '2025-09-06 00:23:07',
                'updated_at' => '2025-09-06 00:23:07',
            ),
            10 => 
            array (
                'id' => 11,
                'teacher_id' => 5,
                'class_room_id' => 1,
                'session_day' => 'Wednesday',
                'start_time' => '10:30:00',
                'end_time' => '11:00:00',
                'created_at' => '2025-09-06 00:23:30',
                'updated_at' => '2025-09-06 00:23:30',
            ),
            11 => 
            array (
                'id' => 12,
                'teacher_id' => 6,
                'class_room_id' => 1,
                'session_day' => 'Wednesday',
                'start_time' => '11:00:00',
                'end_time' => '11:30:00',
                'created_at' => '2025-09-06 00:23:51',
                'updated_at' => '2025-09-06 00:23:51',
            ),
            12 => 
            array (
                'id' => 13,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'session_day' => 'Thursday',
                'start_time' => '11:00:00',
                'end_time' => '11:30:00',
                'created_at' => '2025-09-06 00:24:11',
                'updated_at' => '2025-09-06 00:24:11',
            ),
        ));
        
        
    }
}