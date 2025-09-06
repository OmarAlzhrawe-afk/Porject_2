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
                'id' => 2,
                'subject_id' => 2,
                'education_level_id' => 1,
                'title' => 'math',
                'total_quantity' => 1000,
                'sold_quantity' => 1,
                'price' => 20,
                'available_quantity' => 999,
                'created_at' => '2025-09-06 00:55:03',
                'updated_at' => '2025-09-06 01:15:51',
            ),
            1 => 
            array (
                'id' => 3,
                'subject_id' => 2,
                'education_level_id' => 1,
                'title' => 'scince',
                'total_quantity' => 1000,
                'sold_quantity' => 1,
                'price' => 20,
                'available_quantity' => 999,
                'created_at' => '2025-09-06 00:55:16',
                'updated_at' => '2025-09-06 01:16:13',
            ),
            2 => 
            array (
                'id' => 4,
                'subject_id' => 3,
                'education_level_id' => 1,
                'title' => 'sport',
                'total_quantity' => 1000,
                'sold_quantity' => 1,
                'price' => 20,
                'available_quantity' => 999,
                'created_at' => '2025-09-06 00:55:32',
                'updated_at' => '2025-09-06 01:16:25',
            ),
            3 => 
            array (
                'id' => 5,
                'subject_id' => 4,
                'education_level_id' => 1,
                'title' => 'drawing',
                'total_quantity' => 1000,
                'sold_quantity' => 1,
                'price' => 20,
                'available_quantity' => 999,
                'created_at' => '2025-09-06 00:55:46',
                'updated_at' => '2025-09-06 01:16:31',
            ),
            4 => 
            array (
                'id' => 6,
                'subject_id' => 5,
                'education_level_id' => 1,
                'title' => 'music',
                'total_quantity' => 1000,
                'sold_quantity' => 1,
                'price' => 20,
                'available_quantity' => 999,
                'created_at' => '2025-09-06 00:56:04',
                'updated_at' => '2025-09-06 01:16:39',
            ),
            5 => 
            array (
                'id' => 7,
                'subject_id' => 6,
                'education_level_id' => 1,
                'title' => 'physics',
                'total_quantity' => 1000,
                'sold_quantity' => 1,
                'price' => 20,
                'available_quantity' => 999,
                'created_at' => '2025-09-06 00:56:18',
                'updated_at' => '2025-09-06 01:16:53',
            ),
        ));
        
        
    }
}