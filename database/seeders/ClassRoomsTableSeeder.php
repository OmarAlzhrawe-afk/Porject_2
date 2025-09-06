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
                'name' => 'third_primary1',
                'capacity' => 10,
                'current_count' => 1,
                'floor' => 1,
                'created_at' => '2025-09-05 23:31:33',
                'updated_at' => '2025-09-06 00:00:33',
            ),
            1 => 
            array (
                'id' => 2,
                'education_level_id' => 1,
                'name' => 'third_primary2',
                'capacity' => 10,
                'current_count' => 1,
                'floor' => 1,
                'created_at' => '2025-09-05 23:31:43',
                'updated_at' => '2025-09-06 00:01:34',
            ),
            2 => 
            array (
                'id' => 3,
                'education_level_id' => 1,
                'name' => 'third_primary3',
                'capacity' => 10,
                'current_count' => 3,
                'floor' => 1,
                'created_at' => '2025-09-05 23:31:50',
                'updated_at' => '2025-09-06 00:02:47',
            ),
            3 => 
            array (
                'id' => 4,
                'education_level_id' => 2,
                'name' => 'first_primary1',
                'capacity' => 10,
                'current_count' => 1,
                'floor' => 1,
                'created_at' => '2025-09-05 23:32:06',
                'updated_at' => '2025-09-06 00:03:16',
            ),
            4 => 
            array (
                'id' => 5,
                'education_level_id' => 2,
                'name' => 'first_primary2',
                'capacity' => 10,
                'current_count' => 0,
                'floor' => 1,
                'created_at' => '2025-09-05 23:32:13',
                'updated_at' => '2025-09-05 23:32:13',
            ),
            5 => 
            array (
                'id' => 6,
                'education_level_id' => 2,
                'name' => 'first_primary3',
                'capacity' => 10,
                'current_count' => 1,
                'floor' => 1,
                'created_at' => '2025-09-05 23:32:19',
                'updated_at' => '2025-09-06 00:04:22',
            ),
            6 => 
            array (
                'id' => 7,
                'education_level_id' => 3,
                'name' => 'second_primary1',
                'capacity' => 10,
                'current_count' => 0,
                'floor' => 1,
                'created_at' => '2025-09-05 23:37:45',
                'updated_at' => '2025-09-05 23:37:45',
            ),
            7 => 
            array (
                'id' => 8,
                'education_level_id' => 3,
                'name' => 'second_primary2',
                'capacity' => 10,
                'current_count' => 0,
                'floor' => 1,
                'created_at' => '2025-09-05 23:37:53',
                'updated_at' => '2025-09-05 23:37:53',
            ),
            8 => 
            array (
                'id' => 9,
                'education_level_id' => 3,
                'name' => 'second_primary3',
                'capacity' => 10,
                'current_count' => 1,
                'floor' => 1,
                'created_at' => '2025-09-05 23:38:02',
                'updated_at' => '2025-09-06 00:06:08',
            ),
        ));
        
        
    }
}