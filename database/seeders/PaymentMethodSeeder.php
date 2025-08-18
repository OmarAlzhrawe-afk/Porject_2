<?php

namespace Database\Seeders;

use App\Models\Payment_method;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{

    public function run()
    {

        $methods = [
            ['name' => 'Cash', 'description' => 'Payment in cash'],
            ['name' => 'Visa', 'description' => 'Payment via Visa card'],
            ['name' => 'Transfer', 'description' => 'Payment via Shamcash Transfer'],
        ];

        foreach ($methods as $method) {
            Payment_method::factory()->create($method);
        }
    }
}
