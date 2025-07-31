<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClassRoomsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('class_rooms')->delete();
        
        \DB::table('class_rooms')->insert(array (
            0 => 
            array (
                'id' => 1,
                'education_level_id' => 1,
                'name' => '1\\4',
                'capacity' => 40,
                'current_count' => 0,
                'floor' => 2,
                'created_at' => '2025-07-30 23:18:00',
                'updated_at' => '2025-07-30 23:18:00',
            ),
            1 => 
            array (
                'id' => 2,
                'education_level_id' => 1,
                'name' => '2\\4',
                'capacity' => 40,
                'current_count' => 0,
                'floor' => 2,
                'created_at' => '2025-07-30 23:18:07',
                'updated_at' => '2025-07-30 23:18:07',
            ),
            2 => 
            array (
                'id' => 3,
                'education_level_id' => 1,
                'name' => '3\\4',
                'capacity' => 40,
                'current_count' => 0,
                'floor' => 2,
                'created_at' => '2025-07-30 23:18:14',
                'updated_at' => '2025-07-30 23:18:14',
            ),
            3 => 
            array (
                'id' => 4,
                'education_level_id' => 1,
                'name' => '4\\4',
                'capacity' => 40,
                'current_count' => 0,
                'floor' => 2,
                'created_at' => '2025-07-30 23:18:21',
                'updated_at' => '2025-07-30 23:18:21',
            ),
        ));
        
        
    }
}