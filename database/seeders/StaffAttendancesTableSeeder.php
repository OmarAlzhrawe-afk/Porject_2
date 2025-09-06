<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StaffAttendancesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('staff_attendances')->delete();
        
        \DB::table('staff_attendances')->insert(array (
            0 => 
            array (
                'id' => 1,
                'QR_id' => 10,
                'user_id' => 2,
                'Attendance_status' => 'present',
                'nots' => NULL,
                'created_at' => '2025-09-06 00:50:06',
                'updated_at' => '2025-09-06 00:50:06',
            ),
            1 => 
            array (
                'id' => 2,
                'QR_id' => 10,
                'user_id' => 5,
                'Attendance_status' => 'present',
                'nots' => NULL,
                'created_at' => '2025-09-06 01:13:28',
                'updated_at' => '2025-09-06 01:13:28',
            ),
        ));
        
        
    }
}