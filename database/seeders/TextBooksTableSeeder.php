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
                'subject_id' => 1,
                'education_level_id' => 1,
                'title' => 'math',
                'total_quantity' => 1000,
                'sold_quantity' => 0,
                'price' => 20,
                'available_quantity' => 971,
                'created_at' => '2025-07-30 23:21:50',
                'updated_at' => '2025-07-30 23:36:09',
            ),
            1 => 
            array (
                'id' => 2,
                'subject_id' => 1,
                'education_level_id' => 1,
                'title' => 'sport',
                'total_quantity' => 1000,
                'sold_quantity' => 0,
                'price' => 20,
                'available_quantity' => 1000,
                'created_at' => '2025-07-30 23:21:57',
                'updated_at' => '2025-07-30 23:21:57',
            ),
            2 => 
            array (
                'id' => 3,
                'subject_id' => 1,
                'education_level_id' => 1,
                'title' => 'scince',
                'total_quantity' => 1000,
                'sold_quantity' => 0,
                'price' => 20,
                'available_quantity' => 1000,
                'created_at' => '2025-07-30 23:22:04',
                'updated_at' => '2025-07-30 23:22:04',
            ),
            3 => 
            array (
                'id' => 4,
                'subject_id' => 1,
                'education_level_id' => 1,
                'title' => 'logic',
                'total_quantity' => 1000,
                'sold_quantity' => 0,
                'price' => 20,
                'available_quantity' => 1000,
                'created_at' => '2025-07-30 23:22:13',
                'updated_at' => '2025-07-30 23:22:13',
            ),
            4 => 
            array (
                'id' => 5,
                'subject_id' => 1,
                'education_level_id' => 1,
                'title' => 'chimistry',
                'total_quantity' => 1000,
                'sold_quantity' => 0,
                'price' => 20,
                'available_quantity' => 1000,
                'created_at' => '2025-07-30 23:22:21',
                'updated_at' => '2025-07-30 23:22:21',
            ),
        ));
        
        
    }
}