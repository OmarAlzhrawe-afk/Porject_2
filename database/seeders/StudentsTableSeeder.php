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
                'parent_id' => 1,
                'Student_number' => '1001',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'graduated',
                'created_at' => '2025-08-30 19:40:45',
                'updated_at' => '2025-08-30 19:40:45',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 5,
                'class_id' => 1,
                'parent_id' => 1,
                'Student_number' => '1002',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'graduated',
                'created_at' => '2025-08-30 19:41:01',
                'updated_at' => '2025-08-30 19:41:01',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 6,
                'class_id' => 1,
                'parent_id' => 1,
                'Student_number' => '1003',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'graduated',
                'created_at' => '2025-08-30 19:41:11',
                'updated_at' => '2025-08-30 19:41:11',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 7,
                'class_id' => 1,
                'parent_id' => 1,
                'Student_number' => '1004',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'graduated',
                'created_at' => '2025-08-30 19:41:22',
                'updated_at' => '2025-08-30 19:41:22',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 8,
                'class_id' => 1,
                'parent_id' => 1,
                'Student_number' => '1005',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'graduated',
                'created_at' => '2025-08-30 19:41:32',
                'updated_at' => '2025-08-30 19:41:32',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 9,
                'class_id' => 1,
                'parent_id' => 1,
                'Student_number' => '1006',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'graduated',
                'created_at' => '2025-08-30 19:41:41',
                'updated_at' => '2025-08-30 19:41:41',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 10,
                'class_id' => 2,
                'parent_id' => 1,
                'Student_number' => '1007',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'graduated',
                'created_at' => '2025-08-30 19:42:06',
                'updated_at' => '2025-08-30 19:42:06',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 11,
                'class_id' => 2,
                'parent_id' => 1,
                'Student_number' => '1008',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'graduated',
                'created_at' => '2025-08-30 19:42:13',
                'updated_at' => '2025-08-30 19:42:13',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 12,
                'class_id' => 2,
                'parent_id' => 1,
                'Student_number' => '1009',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'graduated',
                'created_at' => '2025-08-30 19:42:22',
                'updated_at' => '2025-08-30 19:42:22',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 13,
                'class_id' => 2,
                'parent_id' => 1,
                'Student_number' => '1010',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'graduated',
                'created_at' => '2025-08-30 19:42:35',
                'updated_at' => '2025-08-30 19:42:35',
            ),
        ));
        
        
    }
}