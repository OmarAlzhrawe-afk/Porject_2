<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SalariesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('salaries')->delete();
        
        \DB::table('salaries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'Base_salary' => '2000.00',
                'bonus' => '0.00',
                'deductions' => '0.00',
                'date' => '2025-09-06',
                'status' => 'pending',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:26:50',
                'updated_at' => '2025-09-06 02:26:50',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 3,
                'Base_salary' => '2000.00',
                'bonus' => '0.00',
                'deductions' => '0.00',
                'date' => '2025-09-06',
                'status' => 'pending',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:26:52',
                'updated_at' => '2025-09-06 02:26:52',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 4,
                'Base_salary' => '2000.00',
                'bonus' => '0.00',
                'deductions' => '0.00',
                'date' => '2025-09-06',
                'status' => 'pending',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:26:52',
                'updated_at' => '2025-09-06 02:26:52',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 5,
                'Base_salary' => '2000.00',
                'bonus' => '0.00',
                'deductions' => '0.00',
                'date' => '2025-09-06',
                'status' => 'pending',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:26:53',
                'updated_at' => '2025-09-06 02:26:53',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 6,
                'Base_salary' => '2000.00',
                'bonus' => '0.00',
                'deductions' => '0.00',
                'date' => '2025-09-06',
                'status' => 'pending',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:26:54',
                'updated_at' => '2025-09-06 02:26:54',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 7,
                'Base_salary' => '2000.00',
                'bonus' => '0.00',
                'deductions' => '0.00',
                'date' => '2025-09-06',
                'status' => 'pending',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:26:54',
                'updated_at' => '2025-09-06 02:26:54',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 8,
                'Base_salary' => '2000.00',
                'bonus' => '0.00',
                'deductions' => '0.00',
                'date' => '2025-09-06',
                'status' => 'pending',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:26:54',
                'updated_at' => '2025-09-06 02:26:54',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 9,
                'Base_salary' => '2000.00',
                'bonus' => '0.00',
                'deductions' => '0.00',
                'date' => '2025-09-06',
                'status' => 'pending',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:26:55',
                'updated_at' => '2025-09-06 02:26:55',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 10,
                'Base_salary' => '2000.00',
                'bonus' => '0.00',
                'deductions' => '0.00',
                'date' => '2025-09-06',
                'status' => 'pending',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:26:55',
                'updated_at' => '2025-09-06 02:26:55',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 11,
                'Base_salary' => '2000.00',
                'bonus' => '0.00',
                'deductions' => '0.00',
                'date' => '2025-09-06',
                'status' => 'pending',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:26:56',
                'updated_at' => '2025-09-06 02:26:56',
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 12,
                'Base_salary' => '2000.00',
                'bonus' => '0.00',
                'deductions' => '0.00',
                'date' => '2025-09-06',
                'status' => 'pending',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:26:56',
                'updated_at' => '2025-09-06 02:26:56',
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 13,
                'Base_salary' => '2000.00',
                'bonus' => '0.00',
                'deductions' => '0.00',
                'date' => '2025-09-06',
                'status' => 'pending',
                'notes' => NULL,
                'created_at' => '2025-09-06 02:26:57',
                'updated_at' => '2025-09-06 02:26:57',
            ),
        ));
        
        
    }
}