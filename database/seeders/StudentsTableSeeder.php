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
                'id' => 3,
                'user_id' => 7,
                'class_id' => 1,
                'Student_number' => '1001',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'graduated',
                'parent_id' => 4,
                'created_at' => '2025-08-08 03:22:48',
                'updated_at' => '2025-08-08 03:22:48',
            ),
            1 => 
            array (
                'id' => 4,
                'user_id' => 8,
                'class_id' => 1,
                'Student_number' => '1002',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'active',
                'parent_id' => 9,
                'created_at' => '2025-08-08 03:42:19',
                'updated_at' => '2025-08-08 03:42:19',
            ),
            2 => 
            array (
                'id' => 5,
                'user_id' => 10,
                'class_id' => 1,
                'Student_number' => '1003',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'active',
                'parent_id' => 11,
                'created_at' => '2025-08-08 03:42:43',
                'updated_at' => '2025-08-08 03:42:43',
            ),
        ));
        
        
    }
}