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
                'student_id' => 1,
                'textbook_id' => 2,
                'sale_date' => '2025-09-06',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-09-06 01:15:50',
                'updated_at' => '2025-09-06 01:15:50',
            ),
            1 => 
            array (
                'id' => 2,
                'student_id' => 1,
                'textbook_id' => 3,
                'sale_date' => '2025-09-06',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-09-06 01:16:11',
                'updated_at' => '2025-09-06 01:16:11',
            ),
            2 => 
            array (
                'id' => 3,
                'student_id' => 1,
                'textbook_id' => 4,
                'sale_date' => '2025-09-06',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-09-06 01:16:23',
                'updated_at' => '2025-09-06 01:16:23',
            ),
            3 => 
            array (
                'id' => 4,
                'student_id' => 1,
                'textbook_id' => 5,
                'sale_date' => '2025-09-06',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-09-06 01:16:30',
                'updated_at' => '2025-09-06 01:16:30',
            ),
            4 => 
            array (
                'id' => 5,
                'student_id' => 1,
                'textbook_id' => 6,
                'sale_date' => '2025-09-06',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-09-06 01:16:39',
                'updated_at' => '2025-09-06 01:16:39',
            ),
            5 => 
            array (
                'id' => 6,
                'student_id' => 1,
                'textbook_id' => 7,
                'sale_date' => '2025-09-06',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-09-06 01:16:51',
                'updated_at' => '2025-09-06 01:16:51',
            ),
        ));
        
        
    }
}