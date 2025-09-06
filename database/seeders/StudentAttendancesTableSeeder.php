<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentAttendancesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('student_attendances')->delete();
        
        \DB::table('student_attendances')->insert(array (
            0 => 
            array (
                'id' => 1,
                'student_id' => 1,
                'class_room_id' => 1,
                'term_id' => 1,
                'date' => '2025-09-06',
                'excused' => 1,
                'created_at' => '2025-09-06 00:42:55',
                'updated_at' => '2025-09-06 00:42:55',
            ),
            1 => 
            array (
                'id' => 2,
                'student_id' => 2,
                'class_room_id' => 2,
                'term_id' => 1,
                'date' => '2025-09-06',
                'excused' => 1,
                'created_at' => '2025-09-06 00:42:56',
                'updated_at' => '2025-09-06 00:42:56',
            ),
            2 => 
            array (
                'id' => 3,
                'student_id' => 3,
                'class_room_id' => 3,
                'term_id' => 1,
                'date' => '2025-09-06',
                'excused' => 1,
                'created_at' => '2025-09-06 00:42:57',
                'updated_at' => '2025-09-06 00:42:57',
            ),
            3 => 
            array (
                'id' => 4,
                'student_id' => 4,
                'class_room_id' => 3,
                'term_id' => 1,
                'date' => '2025-09-06',
                'excused' => 0,
                'created_at' => '2025-09-06 00:42:57',
                'updated_at' => '2025-09-06 00:42:57',
            ),
            4 => 
            array (
                'id' => 5,
                'student_id' => 5,
                'class_room_id' => 3,
                'term_id' => 1,
                'date' => '2025-09-06',
                'excused' => 0,
                'created_at' => '2025-09-06 00:42:57',
                'updated_at' => '2025-09-06 00:42:57',
            ),
            5 => 
            array (
                'id' => 6,
                'student_id' => 6,
                'class_room_id' => 4,
                'term_id' => 1,
                'date' => '2025-09-06',
                'excused' => 1,
                'created_at' => '2025-09-06 00:42:57',
                'updated_at' => '2025-09-06 00:42:57',
            ),
            6 => 
            array (
                'id' => 7,
                'student_id' => 7,
                'class_room_id' => 6,
                'term_id' => 1,
                'date' => '2025-09-06',
                'excused' => 1,
                'created_at' => '2025-09-06 00:42:57',
                'updated_at' => '2025-09-06 00:42:57',
            ),
            7 => 
            array (
                'id' => 8,
                'student_id' => 8,
                'class_room_id' => 9,
                'term_id' => 1,
                'date' => '2025-09-06',
                'excused' => 0,
                'created_at' => '2025-09-06 00:42:58',
                'updated_at' => '2025-09-06 00:42:58',
            ),
        ));
        
        
    }
}