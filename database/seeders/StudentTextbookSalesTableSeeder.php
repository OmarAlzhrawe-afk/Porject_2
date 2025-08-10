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
                'student_id' => 3,
                'textbook_id' => 1,
                'sale_date' => '2025-08-10',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-10 05:28:09',
                'updated_at' => '2025-08-10 05:28:09',
            ),
            1 => 
            array (
                'id' => 2,
                'student_id' => 3,
                'textbook_id' => 2,
                'sale_date' => '2025-08-10',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-10 05:28:15',
                'updated_at' => '2025-08-10 05:28:15',
            ),
            2 => 
            array (
                'id' => 3,
                'student_id' => 3,
                'textbook_id' => 3,
                'sale_date' => '2025-08-10',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-10 05:28:21',
                'updated_at' => '2025-08-10 05:28:21',
            ),
            3 => 
            array (
                'id' => 4,
                'student_id' => 3,
                'textbook_id' => 4,
                'sale_date' => '2025-08-10',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-10 05:28:28',
                'updated_at' => '2025-08-10 05:28:28',
            ),
            4 => 
            array (
                'id' => 5,
                'student_id' => 4,
                'textbook_id' => 4,
                'sale_date' => '2025-08-10',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-10 05:28:41',
                'updated_at' => '2025-08-10 05:28:41',
            ),
            5 => 
            array (
                'id' => 6,
                'student_id' => 4,
                'textbook_id' => 3,
                'sale_date' => '2025-08-10',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-10 05:28:45',
                'updated_at' => '2025-08-10 05:28:45',
            ),
            6 => 
            array (
                'id' => 7,
                'student_id' => 4,
                'textbook_id' => 2,
                'sale_date' => '2025-08-10',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-10 05:28:49',
                'updated_at' => '2025-08-10 05:28:49',
            ),
            7 => 
            array (
                'id' => 8,
                'student_id' => 4,
                'textbook_id' => 1,
                'sale_date' => '2025-08-10',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-10 05:28:53',
                'updated_at' => '2025-08-10 05:28:53',
            ),
            8 => 
            array (
                'id' => 9,
                'student_id' => 5,
                'textbook_id' => 1,
                'sale_date' => '2025-08-10',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-10 05:29:02',
                'updated_at' => '2025-08-10 05:29:02',
            ),
            9 => 
            array (
                'id' => 10,
                'student_id' => 5,
                'textbook_id' => 2,
                'sale_date' => '2025-08-10',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-10 05:29:08',
                'updated_at' => '2025-08-10 05:29:08',
            ),
            10 => 
            array (
                'id' => 11,
                'student_id' => 5,
                'textbook_id' => 3,
                'sale_date' => '2025-08-10',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-10 05:29:15',
                'updated_at' => '2025-08-10 05:29:15',
            ),
            11 => 
            array (
                'id' => 12,
                'student_id' => 5,
                'textbook_id' => 4,
                'sale_date' => '2025-08-10',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-10 05:29:20',
                'updated_at' => '2025-08-10 05:29:20',
            ),
            12 => 
            array (
                'id' => 13,
                'student_id' => 5,
                'textbook_id' => 5,
                'sale_date' => '2025-08-10',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-08-10 05:29:27',
                'updated_at' => '2025-08-10 05:29:27',
            ),
        ));
        
        
    }
}