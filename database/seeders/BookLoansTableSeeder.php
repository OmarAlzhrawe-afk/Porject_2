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
                'user_id' => 4,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'returned',
                'created_at' => '2025-07-30 23:36:52',
                'updated_at' => '2025-07-30 23:36:52',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 5,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'returned',
                'created_at' => '2025-07-30 23:36:57',
                'updated_at' => '2025-07-30 23:36:57',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 6,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'returned',
                'created_at' => '2025-07-30 23:37:04',
                'updated_at' => '2025-07-30 23:37:04',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 7,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'returned',
                'created_at' => '2025-07-30 23:37:11',
                'updated_at' => '2025-07-30 23:37:11',
            ),
        ));
        
        
    }
}