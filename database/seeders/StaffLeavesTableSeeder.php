<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StaffLeavesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('staff_leaves')->delete();
        
        \DB::table('staff_leaves')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 4,
                'start_date' => '2025-07-03',
                'End_date' => '2025-07-17',
                'leave_type' => 'sick',
                'status' => 'approved',
                'notes' => 'assasas',
                'created_at' => '2025-07-16 15:57:11',
                'updated_at' => '2025-07-09 13:11:38',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 20,
                'start_date' => '2025-07-03',
                'End_date' => '2025-07-03',
                'leave_type' => 'personal',
                'status' => 'rejected',
                'notes' => 'asasasa',
                'created_at' => '2025-07-20 15:57:11',
                'updated_at' => '2025-07-09 13:11:58',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 12,
                'start_date' => '2025-07-03',
                'End_date' => '2025-07-17',
                'leave_type' => 'unpaid',
                'status' => 'approved',
                'notes' => 'mjdnjsndjv',
                'created_at' => '2025-07-16 15:57:11',
                'updated_at' => '2025-07-09 13:30:33',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 20,
                'start_date' => '2025-07-03',
                'End_date' => '2025-07-03',
                'leave_type' => 'emergency',
                'status' => 'pending',
                'notes' => 'wsdsdcqw',
                'created_at' => '2025-07-20 15:57:11',
                'updated_at' => '2025-07-27 15:57:11',
            ),
        ));
        
        
    }
}