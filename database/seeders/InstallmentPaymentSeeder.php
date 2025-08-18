<?php

namespace Database\Seeders;

use App\Models\Installment_payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstallmentPaymentSeeder extends Seeder
{

    public function run()
    {
        Installment_payment::factory()->count(20)->create();
    }
}
