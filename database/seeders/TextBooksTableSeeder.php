<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TextBooksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('text_books')->delete();
        
        \DB::table('text_books')->insert(array (
            0 => 
            array (
                'id' => 1,
                'subject_id' => 2,
                'education_level_id' => 1,
                'title' => 'art',
                'total_quantity' => 1000,
                'sold_quantity' => 0,
                'price' => 20,
                'available_quantity' => 1000,
                'created_at' => '2025-08-30 19:44:14',
                'updated_at' => '2025-08-30 19:44:14',
            ),
            1 => 
            array (
                'id' => 2,
                'subject_id' => 1,
                'education_level_id' => 1,
                'title' => 'art',
                'total_quantity' => 1000,
                'sold_quantity' => 7,
                'price' => 20,
                'available_quantity' => 993,
                'created_at' => '2025-08-30 19:44:47',
                'updated_at' => '2025-08-30 19:48:34',
            ),
            2 => 
            array (
                'id' => 3,
                'subject_id' => 3,
                'education_level_id' => 1,
                'title' => 'art',
                'total_quantity' => 1000,
                'sold_quantity' => 0,
                'price' => 20,
                'available_quantity' => 1000,
                'created_at' => '2025-08-30 19:44:55',
                'updated_at' => '2025-08-30 19:44:55',
            ),
        ));
        
        
    }
}