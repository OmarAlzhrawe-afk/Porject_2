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
                'date' => '2025-09-01',
                'excused' => 1,
                'created_at' => '2025-09-01 21:28:04',
                'updated_at' => '2025-09-01 21:28:04',
            ),
            1 => 
            array (
                'id' => 2,
                'student_id' => 2,
                'class_room_id' => 1,
                'term_id' => 1,
                'date' => '2025-09-01',
                'excused' => 1,
                'created_at' => '2025-09-01 21:28:15',
                'updated_at' => '2025-09-01 21:28:15',
            ),
            2 => 
            array (
                'id' => 3,
                'student_id' => 3,
                'class_room_id' => 1,
                'term_id' => 1,
                'date' => '2025-09-01',
                'excused' => 1,
                'created_at' => '2025-09-01 21:28:15',
                'updated_at' => '2025-09-01 21:28:15',
            ),
            3 => 
            array (
                'id' => 4,
                'student_id' => 4,
                'class_room_id' => 1,
                'term_id' => 1,
                'date' => '2025-09-01',
                'excused' => 0,
                'created_at' => '2025-09-01 21:28:15',
                'updated_at' => '2025-09-01 21:28:15',
            ),
            4 => 
            array (
                'id' => 5,
                'student_id' => 5,
                'class_room_id' => 1,
                'term_id' => 1,
                'date' => '2025-09-01',
                'excused' => 0,
                'created_at' => '2025-09-01 21:28:15',
                'updated_at' => '2025-09-01 21:28:15',
            ),
            5 => 
            array (
                'id' => 6,
                'student_id' => 6,
                'class_room_id' => 1,
                'term_id' => 1,
                'date' => '2025-09-01',
                'excused' => 0,
                'created_at' => '2025-09-01 21:28:16',
                'updated_at' => '2025-09-01 21:28:16',
            ),
            6 => 
            array (
                'id' => 7,
                'student_id' => 2,
                'class_room_id' => 2,
                'term_id' => 1,
                'date' => '2025-09-01',
                'excused' => 1,
                'created_at' => '2025-09-01 21:28:18',
                'updated_at' => '2025-09-01 21:28:18',
            ),
            7 => 
            array (
                'id' => 8,
                'student_id' => 2,
                'class_room_id' => 2,
                'term_id' => 1,
                'date' => '2025-09-01',
                'excused' => 0,
                'created_at' => '2025-09-01 21:28:19',
                'updated_at' => '2025-09-01 21:28:19',
            ),
            8 => 
            array (
                'id' => 9,
                'student_id' => 2,
                'class_room_id' => 2,
                'term_id' => 1,
                'date' => '2025-09-01',
                'excused' => 0,
                'created_at' => '2025-09-01 21:28:19',
                'updated_at' => '2025-09-01 21:28:19',
            ),
            9 => 
            array (
                'id' => 10,
                'student_id' => 2,
                'class_room_id' => 2,
                'term_id' => 1,
                'date' => '2025-09-01',
                'excused' => 1,
                'created_at' => '2025-09-01 21:28:20',
                'updated_at' => '2025-09-01 21:28:20',
            ),
        ));
        
        
    }
}