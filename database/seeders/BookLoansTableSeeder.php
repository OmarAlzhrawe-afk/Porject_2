<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookLoansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('book_loans')->delete();
        
        \DB::table('book_loans')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 17,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-09-06 01:14:07',
                'updated_at' => '2025-09-06 01:14:07',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 17,
                'cultural_book_id' => 2,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-09-06 01:14:13',
                'updated_at' => '2025-09-06 01:14:13',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 17,
                'cultural_book_id' => 3,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-09-06 01:14:17',
                'updated_at' => '2025-09-06 01:14:17',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 17,
                'cultural_book_id' => 4,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-09-06 01:14:22',
                'updated_at' => '2025-09-06 01:14:22',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 17,
                'cultural_book_id' => 5,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-09-06 01:14:27',
                'updated_at' => '2025-09-06 01:14:27',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 17,
                'cultural_book_id' => 6,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-09-06 01:14:35',
                'updated_at' => '2025-09-06 01:14:35',
            ),
        ));
        
        
    }
}