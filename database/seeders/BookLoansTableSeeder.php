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
                'user_id' => 7,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'returned',
                'created_at' => '2025-08-10 05:23:28',
                'updated_at' => '2025-08-10 05:23:28',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 8,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'returned',
                'created_at' => '2025-08-10 05:23:40',
                'updated_at' => '2025-08-10 05:23:40',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 10,
                'cultural_book_id' => 3,
                'type' => 'monthly',
                'status' => 'returned',
                'created_at' => '2025-08-10 05:23:50',
                'updated_at' => '2025-08-10 05:23:50',
            ),
        ));
        
        
    }
}