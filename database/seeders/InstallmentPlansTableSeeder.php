<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InstallmentPlansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('installment_plans')->delete();
        
        \DB::table('installment_plans')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'first_plan',
                'education_level_id' => 1,
                'total_amount' => '200.00',
                'number_of_installments' => 3,
                'count_of_days_per_each_installment' => 30,
                'description' => 'easy_plan',
                'created_at' => '2025-08-30 19:36:47',
                'updated_at' => '2025-08-30 19:36:47',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'second_plan',
                'education_level_id' => 1,
                'total_amount' => '200.00',
                'number_of_installments' => 3,
                'count_of_days_per_each_installment' => 30,
                'description' => 'easy_plan',
                'created_at' => '2025-08-30 19:36:57',
                'updated_at' => '2025-08-30 19:36:57',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'third_plan',
                'education_level_id' => 1,
                'total_amount' => '200.00',
                'number_of_installments' => 5,
                'count_of_days_per_each_installment' => 15,
                'description' => 'very_easy_plan',
                'created_at' => '2025-08-30 19:37:30',
                'updated_at' => '2025-08-30 19:37:30',
            ),
        ));
        
        
    }
}