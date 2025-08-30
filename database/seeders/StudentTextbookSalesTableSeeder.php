<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentTextbookSalesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('student_textbook_sales')->delete();
        
        \DB::table('student_textbook_sales')->insert(array (
            0 => 
            array (
                'id' => 1,
                'student_id' => 2,
                'textbook_id' => 2,
                'sale_date' => '2025-08-30',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-30 19:48:01',
                'updated_at' => '2025-08-30 19:48:01',
            ),
            1 => 
            array (
                'id' => 2,
                'student_id' => 3,
                'textbook_id' => 2,
                'sale_date' => '2025-08-30',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-30 19:48:05',
                'updated_at' => '2025-08-30 19:48:05',
            ),
            2 => 
            array (
                'id' => 3,
                'student_id' => 4,
                'textbook_id' => 2,
                'sale_date' => '2025-08-30',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-30 19:48:09',
                'updated_at' => '2025-08-30 19:48:09',
            ),
            3 => 
            array (
                'id' => 4,
                'student_id' => 5,
                'textbook_id' => 2,
                'sale_date' => '2025-08-30',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-30 19:48:13',
                'updated_at' => '2025-08-30 19:48:13',
            ),
            4 => 
            array (
                'id' => 5,
                'student_id' => 6,
                'textbook_id' => 2,
                'sale_date' => '2025-08-30',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-30 19:48:20',
                'updated_at' => '2025-08-30 19:48:20',
            ),
            5 => 
            array (
                'id' => 6,
                'student_id' => 7,
                'textbook_id' => 2,
                'sale_date' => '2025-08-30',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-30 19:48:25',
                'updated_at' => '2025-08-30 19:48:25',
            ),
            6 => 
            array (
                'id' => 7,
                'student_id' => 8,
                'textbook_id' => 2,
                'sale_date' => '2025-08-30',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-30 19:48:33',
                'updated_at' => '2025-08-30 19:48:33',
            ),
        ));
        
        
    }
}