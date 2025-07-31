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
                'id' => 4,
                'student_id' => 1,
                'textbook_id' => 1,
                'sale_date' => '2025-07-30',
                'quantity' => 14,
                'total_price' => 280,
                'created_at' => '2025-07-30 23:34:52',
                'updated_at' => '2025-07-30 23:34:52',
            ),
            1 => 
            array (
                'id' => 5,
                'student_id' => 2,
                'textbook_id' => 1,
                'sale_date' => '2025-07-30',
                'quantity' => 14,
                'total_price' => 280,
                'created_at' => '2025-07-30 23:35:24',
                'updated_at' => '2025-07-30 23:35:24',
            ),
            2 => 
            array (
                'id' => 7,
                'student_id' => 3,
                'textbook_id' => 1,
                'sale_date' => '2025-07-30',
                'quantity' => 1,
                'total_price' => 20,
                'created_at' => '2025-07-30 23:36:09',
                'updated_at' => '2025-07-30 23:36:09',
            ),
        ));
        
        
    }
}