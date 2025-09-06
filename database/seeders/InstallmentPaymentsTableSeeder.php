<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InstallmentPaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('installment_payments')->delete();
        
        \DB::table('installment_payments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'student_id' => 1,
                'installment_plan_id' => 1,
                'due_date' => '2025-10-21',
                'amount' => '250.00',
                'paid' => 1,
                'payment_date' => '2025-09-06',
                'created_at' => '2025-09-06 00:00:33',
                'updated_at' => '2025-09-06 00:49:02',
            ),
            1 => 
            array (
                'id' => 2,
                'student_id' => 1,
                'installment_plan_id' => 1,
                'due_date' => '2025-11-05',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:00:33',
                'updated_at' => '2025-09-06 00:00:33',
            ),
            2 => 
            array (
                'id' => 3,
                'student_id' => 1,
                'installment_plan_id' => 1,
                'due_date' => '2025-11-20',
                'amount' => '250.00',
                'paid' => 1,
                'payment_date' => '2025-09-06',
                'created_at' => '2025-09-06 00:00:33',
                'updated_at' => '2025-09-06 00:49:08',
            ),
            3 => 
            array (
                'id' => 4,
                'student_id' => 1,
                'installment_plan_id' => 1,
                'due_date' => '2025-12-05',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:00:33',
                'updated_at' => '2025-09-06 00:00:33',
            ),
            4 => 
            array (
                'id' => 5,
                'student_id' => 1,
                'installment_plan_id' => 1,
                'due_date' => '2025-12-20',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:00:33',
                'updated_at' => '2025-09-06 00:00:33',
            ),
            5 => 
            array (
                'id' => 6,
                'student_id' => 1,
                'installment_plan_id' => 1,
                'due_date' => '2026-01-04',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:00:33',
                'updated_at' => '2025-09-06 00:00:33',
            ),
            6 => 
            array (
                'id' => 7,
                'student_id' => 1,
                'installment_plan_id' => 1,
                'due_date' => '2026-01-19',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:00:33',
                'updated_at' => '2025-09-06 00:00:33',
            ),
            7 => 
            array (
                'id' => 8,
                'student_id' => 1,
                'installment_plan_id' => 1,
                'due_date' => '2026-02-03',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:00:33',
                'updated_at' => '2025-09-06 00:00:33',
            ),
            8 => 
            array (
                'id' => 9,
                'student_id' => 1,
                'installment_plan_id' => 1,
                'due_date' => '2026-02-18',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:00:33',
                'updated_at' => '2025-09-06 00:00:33',
            ),
            9 => 
            array (
                'id' => 10,
                'student_id' => 1,
                'installment_plan_id' => 1,
                'due_date' => '2026-03-05',
                'amount' => '250.00',
                'paid' => 1,
                'payment_date' => '2025-09-06',
                'created_at' => '2025-09-06 00:00:33',
                'updated_at' => '2025-09-06 00:49:13',
            ),
            10 => 
            array (
                'id' => 11,
                'student_id' => 2,
                'installment_plan_id' => 1,
                'due_date' => '2025-10-21',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:01:34',
                'updated_at' => '2025-09-06 00:01:34',
            ),
            11 => 
            array (
                'id' => 12,
                'student_id' => 2,
                'installment_plan_id' => 1,
                'due_date' => '2025-11-05',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:01:34',
                'updated_at' => '2025-09-06 00:01:34',
            ),
            12 => 
            array (
                'id' => 13,
                'student_id' => 2,
                'installment_plan_id' => 1,
                'due_date' => '2025-11-20',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:01:34',
                'updated_at' => '2025-09-06 00:01:34',
            ),
            13 => 
            array (
                'id' => 14,
                'student_id' => 2,
                'installment_plan_id' => 1,
                'due_date' => '2025-12-05',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:01:34',
                'updated_at' => '2025-09-06 00:01:34',
            ),
            14 => 
            array (
                'id' => 15,
                'student_id' => 2,
                'installment_plan_id' => 1,
                'due_date' => '2025-12-20',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:01:34',
                'updated_at' => '2025-09-06 00:01:34',
            ),
            15 => 
            array (
                'id' => 16,
                'student_id' => 2,
                'installment_plan_id' => 1,
                'due_date' => '2026-01-04',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:01:34',
                'updated_at' => '2025-09-06 00:01:34',
            ),
            16 => 
            array (
                'id' => 17,
                'student_id' => 2,
                'installment_plan_id' => 1,
                'due_date' => '2026-01-19',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:01:34',
                'updated_at' => '2025-09-06 00:01:34',
            ),
            17 => 
            array (
                'id' => 18,
                'student_id' => 2,
                'installment_plan_id' => 1,
                'due_date' => '2026-02-03',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:01:34',
                'updated_at' => '2025-09-06 00:01:34',
            ),
            18 => 
            array (
                'id' => 19,
                'student_id' => 2,
                'installment_plan_id' => 1,
                'due_date' => '2026-02-18',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:01:34',
                'updated_at' => '2025-09-06 00:01:34',
            ),
            19 => 
            array (
                'id' => 20,
                'student_id' => 2,
                'installment_plan_id' => 1,
                'due_date' => '2026-03-05',
                'amount' => '250.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:01:34',
                'updated_at' => '2025-09-06 00:01:34',
            ),
            20 => 
            array (
                'id' => 21,
                'student_id' => 3,
                'installment_plan_id' => 4,
                'due_date' => '2025-10-26',
                'amount' => '500.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:02:16',
                'updated_at' => '2025-09-06 00:02:16',
            ),
            21 => 
            array (
                'id' => 22,
                'student_id' => 3,
                'installment_plan_id' => 4,
                'due_date' => '2025-11-15',
                'amount' => '500.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:02:16',
                'updated_at' => '2025-09-06 00:02:16',
            ),
            22 => 
            array (
                'id' => 23,
                'student_id' => 3,
                'installment_plan_id' => 4,
                'due_date' => '2025-12-05',
                'amount' => '500.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:02:16',
                'updated_at' => '2025-09-06 00:02:16',
            ),
            23 => 
            array (
                'id' => 24,
                'student_id' => 3,
                'installment_plan_id' => 4,
                'due_date' => '2025-12-25',
                'amount' => '500.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:02:16',
                'updated_at' => '2025-09-06 00:02:16',
            ),
            24 => 
            array (
                'id' => 25,
                'student_id' => 3,
                'installment_plan_id' => 4,
                'due_date' => '2026-01-14',
                'amount' => '500.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:02:16',
                'updated_at' => '2025-09-06 00:02:16',
            ),
            25 => 
            array (
                'id' => 26,
                'student_id' => 4,
                'installment_plan_id' => 4,
                'due_date' => '2025-10-26',
                'amount' => '500.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:02:35',
                'updated_at' => '2025-09-06 00:02:35',
            ),
            26 => 
            array (
                'id' => 27,
                'student_id' => 4,
                'installment_plan_id' => 4,
                'due_date' => '2025-11-15',
                'amount' => '500.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:02:35',
                'updated_at' => '2025-09-06 00:02:35',
            ),
            27 => 
            array (
                'id' => 28,
                'student_id' => 4,
                'installment_plan_id' => 4,
                'due_date' => '2025-12-05',
                'amount' => '500.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:02:35',
                'updated_at' => '2025-09-06 00:02:35',
            ),
            28 => 
            array (
                'id' => 29,
                'student_id' => 4,
                'installment_plan_id' => 4,
                'due_date' => '2025-12-25',
                'amount' => '500.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:02:35',
                'updated_at' => '2025-09-06 00:02:35',
            ),
            29 => 
            array (
                'id' => 30,
                'student_id' => 4,
                'installment_plan_id' => 4,
                'due_date' => '2026-01-14',
                'amount' => '500.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:02:35',
                'updated_at' => '2025-09-06 00:02:35',
            ),
            30 => 
            array (
                'id' => 31,
                'student_id' => 5,
                'installment_plan_id' => 4,
                'due_date' => '2025-10-26',
                'amount' => '500.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:02:47',
                'updated_at' => '2025-09-06 00:02:47',
            ),
            31 => 
            array (
                'id' => 32,
                'student_id' => 5,
                'installment_plan_id' => 4,
                'due_date' => '2025-11-15',
                'amount' => '500.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:02:47',
                'updated_at' => '2025-09-06 00:02:47',
            ),
            32 => 
            array (
                'id' => 33,
                'student_id' => 5,
                'installment_plan_id' => 4,
                'due_date' => '2025-12-05',
                'amount' => '500.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:02:47',
                'updated_at' => '2025-09-06 00:02:47',
            ),
            33 => 
            array (
                'id' => 34,
                'student_id' => 5,
                'installment_plan_id' => 4,
                'due_date' => '2025-12-25',
                'amount' => '500.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:02:47',
                'updated_at' => '2025-09-06 00:02:47',
            ),
            34 => 
            array (
                'id' => 35,
                'student_id' => 5,
                'installment_plan_id' => 4,
                'due_date' => '2026-01-14',
                'amount' => '500.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:02:47',
                'updated_at' => '2025-09-06 00:02:47',
            ),
            35 => 
            array (
                'id' => 36,
                'student_id' => 6,
                'installment_plan_id' => 5,
                'due_date' => '2025-10-26',
                'amount' => '600.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:03:16',
                'updated_at' => '2025-09-06 00:03:16',
            ),
            36 => 
            array (
                'id' => 37,
                'student_id' => 6,
                'installment_plan_id' => 5,
                'due_date' => '2025-11-15',
                'amount' => '600.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:03:16',
                'updated_at' => '2025-09-06 00:03:16',
            ),
            37 => 
            array (
                'id' => 38,
                'student_id' => 6,
                'installment_plan_id' => 5,
                'due_date' => '2025-12-05',
                'amount' => '600.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:03:16',
                'updated_at' => '2025-09-06 00:03:16',
            ),
            38 => 
            array (
                'id' => 39,
                'student_id' => 6,
                'installment_plan_id' => 5,
                'due_date' => '2025-12-25',
                'amount' => '600.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:03:16',
                'updated_at' => '2025-09-06 00:03:16',
            ),
            39 => 
            array (
                'id' => 40,
                'student_id' => 6,
                'installment_plan_id' => 5,
                'due_date' => '2026-01-14',
                'amount' => '600.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:03:16',
                'updated_at' => '2025-09-06 00:03:16',
            ),
            40 => 
            array (
                'id' => 41,
                'student_id' => 7,
                'installment_plan_id' => 8,
                'due_date' => '2025-10-26',
                'amount' => '600.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:04:22',
                'updated_at' => '2025-09-06 00:04:22',
            ),
            41 => 
            array (
                'id' => 42,
                'student_id' => 7,
                'installment_plan_id' => 8,
                'due_date' => '2025-11-15',
                'amount' => '600.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:04:22',
                'updated_at' => '2025-09-06 00:04:22',
            ),
            42 => 
            array (
                'id' => 43,
                'student_id' => 7,
                'installment_plan_id' => 8,
                'due_date' => '2025-12-05',
                'amount' => '600.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:04:22',
                'updated_at' => '2025-09-06 00:04:22',
            ),
            43 => 
            array (
                'id' => 44,
                'student_id' => 7,
                'installment_plan_id' => 8,
                'due_date' => '2025-12-25',
                'amount' => '600.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:04:22',
                'updated_at' => '2025-09-06 00:04:22',
            ),
            44 => 
            array (
                'id' => 45,
                'student_id' => 7,
                'installment_plan_id' => 8,
                'due_date' => '2026-01-14',
                'amount' => '600.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:04:22',
                'updated_at' => '2025-09-06 00:04:22',
            ),
            45 => 
            array (
                'id' => 46,
                'student_id' => 8,
                'installment_plan_id' => 9,
                'due_date' => '2025-10-26',
                'amount' => '600.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:06:08',
                'updated_at' => '2025-09-06 00:06:08',
            ),
            46 => 
            array (
                'id' => 47,
                'student_id' => 8,
                'installment_plan_id' => 9,
                'due_date' => '2025-11-15',
                'amount' => '600.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:06:08',
                'updated_at' => '2025-09-06 00:06:08',
            ),
            47 => 
            array (
                'id' => 48,
                'student_id' => 8,
                'installment_plan_id' => 9,
                'due_date' => '2025-12-05',
                'amount' => '600.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:06:08',
                'updated_at' => '2025-09-06 00:06:08',
            ),
            48 => 
            array (
                'id' => 49,
                'student_id' => 8,
                'installment_plan_id' => 9,
                'due_date' => '2025-12-25',
                'amount' => '600.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:06:08',
                'updated_at' => '2025-09-06 00:06:08',
            ),
            49 => 
            array (
                'id' => 50,
                'student_id' => 8,
                'installment_plan_id' => 9,
                'due_date' => '2026-01-14',
                'amount' => '600.00',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-09-06 00:06:08',
                'updated_at' => '2025-09-06 00:06:08',
            ),
        ));
        
        
    }
}