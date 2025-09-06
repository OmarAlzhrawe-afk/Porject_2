<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActivityParticipantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('activity_participants')->delete();
        
        \DB::table('activity_participants')->insert(array (
            0 => 
            array (
                'id' => 1,
                'activity_id' => 1,
                'user_id' => 6,
                'payment_status' => 'free_activity',
                'attendance' => 0,
                'payment_reference' => NULL,
                'payment_method' => 'cash',
                'notes' => NULL,
                'created_at' => '2025-09-06 01:24:01',
                'updated_at' => '2025-09-06 01:24:01',
            ),
            1 => 
            array (
                'id' => 2,
                'activity_id' => 2,
                'user_id' => 17,
                'payment_status' => 'free_activity',
                'attendance' => 0,
                'payment_reference' => NULL,
                'payment_method' => 'cash',
                'notes' => NULL,
                'created_at' => '2025-09-06 01:50:31',
                'updated_at' => '2025-09-06 01:50:31',
            ),
            2 => 
            array (
                'id' => 3,
                'activity_id' => 1,
                'user_id' => 17,
                'payment_status' => 'free_activity',
                'attendance' => 0,
                'payment_reference' => NULL,
                'payment_method' => 'cash',
                'notes' => NULL,
                'created_at' => '2025-09-06 01:50:37',
                'updated_at' => '2025-09-06 01:50:37',
            ),
        ));
        
        
    }
}