<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstallmentPaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('installment_payments')->delete();

        DB::table('installment_payments')->insert(array(
            0 =>
            array(
                'id' => 1,
                'student_id' => 1,
                'installment_plan_id' => 1,
                'due_date' => '2025-10-29',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:40:45',
                'updated_at' => '2025-08-30 19:40:45',
            ),
            1 =>
            array(
                'id' => 2,
                'student_id' => 1,
                'installment_plan_id' => 1,
                'due_date' => '2025-11-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:40:45',
                'updated_at' => '2025-08-30 19:40:45',
            ),
            2 =>
            array(
                'id' => 3,
                'student_id' => 1,
                'installment_plan_id' => 1,
                'due_date' => '2025-12-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:40:45',
                'updated_at' => '2025-08-30 19:40:45',
            ),
            3 =>
            array(
                'id' => 4,
                'student_id' => 2,
                'installment_plan_id' => 2,
                'due_date' => '2025-10-29',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:41:01',
                'updated_at' => '2025-08-30 19:41:01',
            ),
            4 =>
            array(
                'id' => 5,
                'student_id' => 2,
                'installment_plan_id' => 2,
                'due_date' => '2025-11-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:41:01',
                'updated_at' => '2025-08-30 19:41:01',
            ),
            5 =>
            array(
                'id' => 6,
                'student_id' => 2,
                'installment_plan_id' => 2,
                'due_date' => '2025-12-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:41:01',
                'updated_at' => '2025-08-30 19:41:01',
            ),
            6 =>
            array(
                'id' => 7,
                'student_id' => 3,
                'installment_plan_id' => 2,
                'due_date' => '2025-10-29',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:41:11',
                'updated_at' => '2025-08-30 19:41:11',
            ),
            7 =>
            array(
                'id' => 8,
                'student_id' => 3,
                'installment_plan_id' => 2,
                'due_date' => '2025-11-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:41:11',
                'updated_at' => '2025-08-30 19:41:11',
            ),
            8 =>
            array(
                'id' => 9,
                'student_id' => 3,
                'installment_plan_id' => 2,
                'due_date' => '2025-12-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:41:11',
                'updated_at' => '2025-08-30 19:41:11',
            ),
            9 =>
            array(
                'id' => 10,
                'student_id' => 4,
                'installment_plan_id' => 2,
                'due_date' => '2025-10-29',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:41:22',
                'updated_at' => '2025-08-30 19:41:22',
            ),
            10 =>
            array(
                'id' => 11,
                'student_id' => 4,
                'installment_plan_id' => 2,
                'due_date' => '2025-11-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:41:22',
                'updated_at' => '2025-08-30 19:41:22',
            ),
            11 =>
            array(
                'id' => 12,
                'student_id' => 4,
                'installment_plan_id' => 2,
                'due_date' => '2025-12-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:41:22',
                'updated_at' => '2025-08-30 19:41:22',
            ),
            12 =>
            array(
                'id' => 13,
                'student_id' => 5,
                'installment_plan_id' => 2,
                'due_date' => '2025-10-29',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:41:32',
                'updated_at' => '2025-08-30 19:41:32',
            ),
            13 =>
            array(
                'id' => 14,
                'student_id' => 5,
                'installment_plan_id' => 2,
                'due_date' => '2025-11-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:41:32',
                'updated_at' => '2025-08-30 19:41:32',
            ),
            14 =>
            array(
                'id' => 15,
                'student_id' => 5,
                'installment_plan_id' => 2,
                'due_date' => '2025-12-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:41:32',
                'updated_at' => '2025-08-30 19:41:32',
            ),
            15 =>
            array(
                'id' => 16,
                'student_id' => 6,
                'installment_plan_id' => 2,
                'due_date' => '2025-10-29',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:41:41',
                'updated_at' => '2025-08-30 19:41:41',
            ),
            16 =>
            array(
                'id' => 17,
                'student_id' => 6,
                'installment_plan_id' => 2,
                'due_date' => '2025-11-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:41:41',
                'updated_at' => '2025-08-30 19:41:41',
            ),
            17 =>
            array(
                'id' => 18,
                'student_id' => 6,
                'installment_plan_id' => 2,
                'due_date' => '2025-12-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:41:41',
                'updated_at' => '2025-08-30 19:41:41',
            ),
            18 =>
            array(
                'id' => 19,
                'student_id' => 7,
                'installment_plan_id' => 2,
                'due_date' => '2025-10-29',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:42:06',
                'updated_at' => '2025-08-30 19:42:06',
            ),
            19 =>
            array(
                'id' => 20,
                'student_id' => 7,
                'installment_plan_id' => 2,
                'due_date' => '2025-11-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:42:06',
                'updated_at' => '2025-08-30 19:42:06',
            ),
            20 =>
            array(
                'id' => 21,
                'student_id' => 7,
                'installment_plan_id' => 2,
                'due_date' => '2025-12-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:42:06',
                'updated_at' => '2025-08-30 19:42:06',
            ),
            21 =>
            array(
                'id' => 22,
                'student_id' => 8,
                'installment_plan_id' => 2,
                'due_date' => '2025-10-29',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:42:13',
                'updated_at' => '2025-08-30 19:42:13',
            ),
            22 =>
            array(
                'id' => 23,
                'student_id' => 8,
                'installment_plan_id' => 2,
                'due_date' => '2025-11-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:42:13',
                'updated_at' => '2025-08-30 19:42:13',
            ),
            23 =>
            array(
                'id' => 24,
                'student_id' => 8,
                'installment_plan_id' => 2,
                'due_date' => '2025-12-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:42:13',
                'updated_at' => '2025-08-30 19:42:13',
            ),
            24 =>
            array(
                'id' => 25,
                'student_id' => 9,
                'installment_plan_id' => 2,
                'due_date' => '2025-10-29',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:42:22',
                'updated_at' => '2025-08-30 19:42:22',
            ),
            25 =>
            array(
                'id' => 26,
                'student_id' => 9,
                'installment_plan_id' => 2,
                'due_date' => '2025-11-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:42:22',
                'updated_at' => '2025-08-30 19:42:22',
            ),
            26 =>
            array(
                'id' => 27,
                'student_id' => 9,
                'installment_plan_id' => 2,
                'due_date' => '2025-12-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:42:22',
                'updated_at' => '2025-08-30 19:42:22',
            ),
            27 =>
            array(
                'id' => 28,
                'student_id' => 10,
                'installment_plan_id' => 1,
                'due_date' => '2025-10-29',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:42:35',
                'updated_at' => '2025-08-30 19:42:35',
            ),
            28 =>
            array(
                'id' => 29,
                'student_id' => 10,
                'installment_plan_id' => 1,
                'due_date' => '2025-11-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:42:35',
                'updated_at' => '2025-08-30 19:42:35',
            ),
            29 =>
            array(
                'id' => 30,
                'student_id' => 10,
                'installment_plan_id' => 1,
                'due_date' => '2025-12-28',
                'amount' => '66.67',
                'paid' => 0,
                'payment_date' => NULL,
                'created_at' => '2025-08-30 19:42:35',
                'updated_at' => '2025-08-30 19:42:35',
            ),
        ));
    }
}
