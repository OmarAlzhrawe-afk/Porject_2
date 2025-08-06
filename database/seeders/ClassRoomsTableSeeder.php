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
                'name' => '4\\4',
                'capacity' => 40,
                'current_count' => 0,
                'floor' => 2,
                'created_at' => '2025-08-06 15:37:49',
                'updated_at' => '2025-08-06 15:37:49',
            ),
        ));
        
        
    }
}