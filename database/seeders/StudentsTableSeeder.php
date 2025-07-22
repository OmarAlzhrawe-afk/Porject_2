<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('students')->delete();
        
        \DB::table('students')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 4,
                'class_id' => 1,
                'Student_number' => '1001',
                'status' => 'graduated',
                'created_at' => '2025-07-21 21:10:01',
                'updated_at' => '2025-07-21 21:10:01',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 5,
                'class_id' => 1,
                'Student_number' => '1',
                'status' => 'graduated',
                'created_at' => '2025-07-22 16:14:52',
                'updated_at' => '2025-07-22 16:14:52',
            ),
            2 => 
            array (
                'id' => 4,
                'user_id' => 7,
                'class_id' => 1,
                'Student_number' => '1002',
                'status' => 'graduated',
                'created_at' => '2025-07-22 16:24:14',
                'updated_at' => '2025-07-22 16:24:14',
            ),
            3 => 
            array (
                'id' => 5,
                'user_id' => 8,
                'class_id' => 1,
                'Student_number' => '1003',
                'status' => 'graduated',
                'created_at' => '2025-07-22 16:24:44',
                'updated_at' => '2025-07-22 16:24:44',
            ),
            4 => 
            array (
                'id' => 6,
                'user_id' => 9,
                'class_id' => 2,
                'Student_number' => '1004',
                'status' => 'graduated',
                'created_at' => '2025-07-22 16:25:11',
                'updated_at' => '2025-07-22 16:25:11',
            ),
            5 => 
            array (
                'id' => 7,
                'user_id' => 10,
                'class_id' => 2,
                'Student_number' => '1005',
                'status' => 'graduated',
                'created_at' => '2025-07-22 16:25:24',
                'updated_at' => '2025-07-22 16:25:24',
            ),
            6 => 
            array (
                'id' => 8,
                'user_id' => 11,
                'class_id' => 2,
                'Student_number' => '1006',
                'status' => 'graduated',
                'created_at' => '2025-07-22 16:25:38',
                'updated_at' => '2025-07-22 16:25:38',
            ),
            7 => 
            array (
                'id' => 9,
                'user_id' => 12,
                'class_id' => 2,
                'Student_number' => '1007',
                'status' => 'graduated',
                'created_at' => '2025-07-22 16:25:55',
                'updated_at' => '2025-07-22 16:25:55',
            ),
        ));
        
        
    }
}