<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HomeWorksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('home_works')->delete();
        
        \DB::table('home_works')->insert(array (
            0 => 
            array (
                'id' => 1,
                'teacher_id' => 1,
                'class_id' => 1,
                'description' => 'Home work for last session',
                'homework_url' => 'uploads/Homeworks/1757112086.pdf',
                'last_date' => '2025-12-03 00:00:00',
                'created_at' => '2025-09-06 01:41:26',
                'updated_at' => '2025-09-06 01:41:26',
            ),
            1 => 
            array (
                'id' => 2,
                'teacher_id' => 1,
                'class_id' => 1,
                'description' => 'Home work for last session',
                'homework_url' => 'uploads/Homeworks/1757112115.pdf',
                'last_date' => '2025-10-03 00:00:00',
                'created_at' => '2025-09-06 01:41:55',
                'updated_at' => '2025-09-06 01:41:55',
            ),
            2 => 
            array (
                'id' => 3,
                'teacher_id' => 1,
                'class_id' => 1,
                'description' => 'Home work for last session',
                'homework_url' => 'uploads/Homeworks/1757112128.pdf',
                'last_date' => '2025-10-10 00:00:00',
                'created_at' => '2025-09-06 01:42:08',
                'updated_at' => '2025-09-06 01:42:08',
            ),
        ));
        
        
    }
}