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
                'name' => 'first_primary',
                'capacity' => 10,
                'current_count' => 6,
                'floor' => 1,
                'created_at' => '2025-08-30 19:35:06',
                'updated_at' => '2025-08-30 19:41:41',
            ),
            1 => 
            array (
                'id' => 2,
                'education_level_id' => 1,
                'name' => 'first_primary2',
                'capacity' => 10,
                'current_count' => 4,
                'floor' => 1,
                'created_at' => '2025-08-30 19:35:16',
                'updated_at' => '2025-08-30 19:42:35',
            ),
            2 => 
            array (
                'id' => 3,
                'education_level_id' => 1,
                'name' => 'first_primary3',
                'capacity' => 10,
                'current_count' => 0,
                'floor' => 1,
                'created_at' => '2025-08-30 19:35:23',
                'updated_at' => '2025-08-30 19:35:23',
            ),
        ));
        
        
    }
}