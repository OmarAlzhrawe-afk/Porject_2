<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('transactions')->delete();
        
        \DB::table('transactions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'payment_method' => 'cash',
                'amount' => '250.00',
                'type' => 'in',
                'transaction_source' => 'installment_student',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 1,
                'created_at' => '2025-09-06 00:49:02',
                'updated_at' => '2025-09-06 00:49:02',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'payment_method' => 'cash',
                'amount' => '250.00',
                'type' => 'in',
                'transaction_source' => 'installment_student',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 1,
                'created_at' => '2025-09-06 00:49:08',
                'updated_at' => '2025-09-06 00:49:08',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 2,
                'payment_method' => 'cash',
                'amount' => '250.00',
                'type' => 'in',
                'transaction_source' => 'installment_student',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 1,
                'created_at' => '2025-09-06 00:49:13',
                'updated_at' => '2025-09-06 00:49:13',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 17,
                'payment_method' => 'cash',
                'amount' => '20.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-09-06 01:15:51',
                'updated_at' => '2025-09-06 01:15:51',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 17,
                'payment_method' => 'cash',
                'amount' => '20.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-09-06 01:16:13',
                'updated_at' => '2025-09-06 01:16:13',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 17,
                'payment_method' => 'cash',
                'amount' => '20.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-09-06 01:16:25',
                'updated_at' => '2025-09-06 01:16:25',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 17,
                'payment_method' => 'cash',
                'amount' => '20.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-09-06 01:16:31',
                'updated_at' => '2025-09-06 01:16:31',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 17,
                'payment_method' => 'cash',
                'amount' => '20.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-09-06 01:16:39',
                'updated_at' => '2025-09-06 01:16:39',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 17,
                'payment_method' => 'cash',
                'amount' => '20.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-09-06 01:16:53',
                'updated_at' => '2025-09-06 01:16:53',
            ),
        ));
        
        
    }
}