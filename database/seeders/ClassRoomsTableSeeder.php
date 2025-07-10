<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassRoomsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('class_rooms')->delete();

        DB::table('class_rooms')->insert(array(
            0 =>
            array(
                'id' => 1,
                'education_level_id' => 1,
                'name' => 'omar',
                'capacity' => 12,
                'current_count' => 12,
                'floor' => 12,
                'created_at' => '2025-07-04 16:45:47',
                'updated_at' => '2025-07-04 16:45:47',
            ),
        ));
    }
}
