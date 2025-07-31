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
                'id' => 4,
                'user_id' => 4,
                'payment_method' => 'cash',
                'amount' => '280.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-07-30 23:34:52',
                'updated_at' => '2025-07-30 23:34:52',
            ),
            1 => 
            array (
                'id' => 5,
                'user_id' => 5,
                'payment_method' => 'cash',
                'amount' => '280.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-07-30 23:35:24',
                'updated_at' => '2025-07-30 23:35:24',
            ),
            2 => 
            array (
                'id' => 7,
                'user_id' => 6,
                'payment_method' => 'cash',
                'amount' => '20.00',
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'installment_number' => NULL,
                'payment_reference' => NULL,
                'is_installment' => 0,
                'created_at' => '2025-07-30 23:36:09',
                'updated_at' => '2025-07-30 23:36:09',
            ),
        ));
        
        
    }
}