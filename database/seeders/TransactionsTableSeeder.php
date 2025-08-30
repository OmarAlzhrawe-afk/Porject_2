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
                'user_id' => 5,
                'payment_method' => 'cash',
                'amount' => '20.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-08-30 19:48:02',
                'updated_at' => '2025-08-30 19:48:02',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 6,
                'payment_method' => 'cash',
                'amount' => '20.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-08-30 19:48:07',
                'updated_at' => '2025-08-30 19:48:07',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 7,
                'payment_method' => 'cash',
                'amount' => '20.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-08-30 19:48:11',
                'updated_at' => '2025-08-30 19:48:11',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 8,
                'payment_method' => 'cash',
                'amount' => '20.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-08-30 19:48:17',
                'updated_at' => '2025-08-30 19:48:17',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 9,
                'payment_method' => 'cash',
                'amount' => '20.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-08-30 19:48:22',
                'updated_at' => '2025-08-30 19:48:22',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 10,
                'payment_method' => 'cash',
                'amount' => '20.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-08-30 19:48:27',
                'updated_at' => '2025-08-30 19:48:27',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 11,
                'payment_method' => 'cash',
                'amount' => '20.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-08-30 19:48:34',
                'updated_at' => '2025-08-30 19:48:34',
            ),
        ));
        
        
    }
}