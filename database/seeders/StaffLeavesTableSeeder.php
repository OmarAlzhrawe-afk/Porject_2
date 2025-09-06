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
                'user_id' => 2,
                'leave_date' => '2025-12-25',
                'period' => 'day',
                'leave_type' => 'personal',
                'status' => 'pending',
                'notes' => 'I have special  married party',
                'created_at' => '2025-09-06 00:50:56',
                'updated_at' => '2025-09-06 00:50:56',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 5,
                'leave_date' => '2025-02-02',
                'period' => 'day',
                'leave_type' => 'unpaid',
                'status' => 'pending',
                'notes' => 'break',
                'created_at' => '2025-09-06 01:12:10',
                'updated_at' => '2025-09-06 01:12:10',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 6,
                'leave_date' => '2025-02-02',
                'period' => 'day',
                'leave_type' => 'unpaid',
                'status' => 'pending',
                'notes' => 'break',
                'created_at' => '2025-09-06 01:47:07',
                'updated_at' => '2025-09-06 01:47:07',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 2,
                'leave_date' => '2025-09-06',
                'period' => 'day',
                'leave_type' => 'unpaid',
                'status' => 'approved',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:25:35',
                'updated_at' => '2025-09-06 02:25:35',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 3,
                'leave_date' => '2025-09-06',
                'period' => 'day',
                'leave_type' => 'unpaid',
                'status' => 'approved',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:25:35',
                'updated_at' => '2025-09-06 02:25:35',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 4,
                'leave_date' => '2025-09-06',
                'period' => 'day',
                'leave_type' => 'unpaid',
                'status' => 'approved',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:25:35',
                'updated_at' => '2025-09-06 02:25:35',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 5,
                'leave_date' => '2025-09-06',
                'period' => 'day',
                'leave_type' => 'unpaid',
                'status' => 'approved',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:25:35',
                'updated_at' => '2025-09-06 02:25:35',
            ),
        ));
        
        
    }
}