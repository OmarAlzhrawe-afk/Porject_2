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
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:46:30',
                'updated_at' => '2025-08-30 19:46:30',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 5,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'returned',
                'created_at' => '2025-08-30 19:46:40',
                'updated_at' => '2025-08-30 19:57:35',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 6,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'returned',
                'created_at' => '2025-08-30 19:46:46',
                'updated_at' => '2025-08-30 19:57:42',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 7,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:46:51',
                'updated_at' => '2025-08-30 19:46:51',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 8,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:46:55',
                'updated_at' => '2025-08-30 19:46:55',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 9,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:47:01',
                'updated_at' => '2025-08-30 19:47:01',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 10,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:47:05',
                'updated_at' => '2025-08-30 19:47:05',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 11,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:47:10',
                'updated_at' => '2025-08-30 19:47:10',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 12,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:47:17',
                'updated_at' => '2025-08-30 19:47:17',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 12,
                'cultural_book_id' => 2,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:47:32',
                'updated_at' => '2025-08-30 19:47:32',
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 11,
                'cultural_book_id' => 2,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:47:39',
                'updated_at' => '2025-08-30 19:47:39',
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 10,
                'cultural_book_id' => 2,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:47:45',
                'updated_at' => '2025-08-30 19:47:45',
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => 10,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:49:14',
                'updated_at' => '2025-08-30 19:49:14',
            ),
            13 => 
            array (
                'id' => 14,
                'user_id' => 10,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:49:29',
                'updated_at' => '2025-08-30 19:49:29',
            ),
            14 => 
            array (
                'id' => 15,
                'user_id' => 10,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:53:56',
                'updated_at' => '2025-08-30 19:53:56',
            ),
            15 => 
            array (
                'id' => 16,
                'user_id' => 10,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:54:25',
                'updated_at' => '2025-08-30 19:54:25',
            ),
            16 => 
            array (
                'id' => 17,
                'user_id' => 10,
                'cultural_book_id' => 1,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:55:19',
                'updated_at' => '2025-08-30 19:55:19',
            ),
            17 => 
            array (
                'id' => 18,
                'user_id' => 10,
                'cultural_book_id' => 3,
                'type' => 'monthly',
                'status' => 'unreturned',
                'created_at' => '2025-08-30 19:57:05',
                'updated_at' => '2025-08-30 19:57:05',
            ),
        ));
        
        
    }
}