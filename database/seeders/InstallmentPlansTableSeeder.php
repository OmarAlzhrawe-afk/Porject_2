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
                'total_amount' => '2500.00',
                'number_of_installments' => 10,
                'count_of_days_per_each_installment' => 15,
                'description' => 'very_easy_plan',
                'created_at' => '2025-09-05 23:56:55',
                'updated_at' => '2025-09-05 23:56:55',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'first_plan',
                'education_level_id' => 2,
                'total_amount' => '3000.00',
                'number_of_installments' => 10,
                'count_of_days_per_each_installment' => 15,
                'description' => 'very_easy_plan',
                'created_at' => '2025-09-05 23:57:05',
                'updated_at' => '2025-09-05 23:57:05',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'first_plan',
                'education_level_id' => 3,
                'total_amount' => '3000.00',
                'number_of_installments' => 10,
                'count_of_days_per_each_installment' => 15,
                'description' => 'very_easy_plan',
                'created_at' => '2025-09-05 23:57:11',
                'updated_at' => '2025-09-05 23:57:11',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'second_plan',
                'education_level_id' => 1,
                'total_amount' => '2500.00',
                'number_of_installments' => 5,
                'count_of_days_per_each_installment' => 20,
                'description' => 'easy_plan',
                'created_at' => '2025-09-05 23:57:45',
                'updated_at' => '2025-09-05 23:57:45',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'second_plan',
                'education_level_id' => 2,
                'total_amount' => '3000.00',
                'number_of_installments' => 5,
                'count_of_days_per_each_installment' => 20,
                'description' => 'easy_plan',
                'created_at' => '2025-09-05 23:57:51',
                'updated_at' => '2025-09-05 23:57:51',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'second_plan',
                'education_level_id' => 3,
                'total_amount' => '3000.00',
                'number_of_installments' => 5,
                'count_of_days_per_each_installment' => 20,
                'description' => 'easy_plan',
                'created_at' => '2025-09-05 23:57:56',
                'updated_at' => '2025-09-05 23:57:56',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'third_plan',
                'education_level_id' => 1,
                'total_amount' => '2500.00',
                'number_of_installments' => 5,
                'count_of_days_per_each_installment' => 20,
                'description' => 'hard_plan',
                'created_at' => '2025-09-05 23:58:20',
                'updated_at' => '2025-09-05 23:58:20',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'third_plan',
                'education_level_id' => 2,
                'total_amount' => '3000.00',
                'number_of_installments' => 5,
                'count_of_days_per_each_installment' => 20,
                'description' => 'hard_plan',
                'created_at' => '2025-09-05 23:58:25',
                'updated_at' => '2025-09-05 23:58:25',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'third_plan',
                'education_level_id' => 3,
                'total_amount' => '3000.00',
                'number_of_installments' => 5,
                'count_of_days_per_each_installment' => 20,
                'description' => 'hard_plan',
                'created_at' => '2025-09-05 23:58:29',
                'updated_at' => '2025-09-05 23:58:29',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'forth_plan',
                'education_level_id' => 3,
                'total_amount' => '3000.00',
                'number_of_installments' => 5,
                'count_of_days_per_each_installment' => 20,
                'description' => 'hard_plan',
                'created_at' => '2025-09-05 23:58:44',
                'updated_at' => '2025-09-05 23:58:44',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'forth_plan',
                'education_level_id' => 1,
                'total_amount' => '2500.00',
                'number_of_installments' => 1,
                'count_of_days_per_each_installment' => 0,
                'description' => 'direct_pay_plan',
                'created_at' => '2025-09-05 23:59:21',
                'updated_at' => '2025-09-05 23:59:21',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'forth_plan',
                'education_level_id' => 2,
                'total_amount' => '3000.00',
                'number_of_installments' => 1,
                'count_of_days_per_each_installment' => 0,
                'description' => 'direct_pay_plan',
                'created_at' => '2025-09-05 23:59:25',
                'updated_at' => '2025-09-05 23:59:25',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'forth_plan',
                'education_level_id' => 3,
                'total_amount' => '3000.00',
                'number_of_installments' => 1,
                'count_of_days_per_each_installment' => 0,
                'description' => 'direct_pay_plan',
                'created_at' => '2025-09-05 23:59:29',
                'updated_at' => '2025-09-05 23:59:29',
            ),
        ));
        
        
    }
}