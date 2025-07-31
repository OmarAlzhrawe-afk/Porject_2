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
                'parent_id' => 8,
                'created_at' => '2025-07-30 23:19:47',
                'updated_at' => '2025-07-30 23:19:47',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 5,
                'class_id' => 1,
                'Student_number' => '1002',
                'status' => 'graduated',
                'parent_id' => 8,
                'created_at' => '2025-07-30 23:19:58',
                'updated_at' => '2025-07-30 23:19:58',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 6,
                'class_id' => 1,
                'Student_number' => '1003',
                'status' => 'graduated',
                'parent_id' => 8,
                'created_at' => '2025-07-30 23:20:07',
                'updated_at' => '2025-07-30 23:20:07',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 7,
                'class_id' => 1,
                'Student_number' => '1004',
                'status' => 'graduated',
                'parent_id' => 8,
                'created_at' => '2025-07-30 23:20:17',
                'updated_at' => '2025-07-30 23:20:17',
            ),
        ));
        
        
    }
}