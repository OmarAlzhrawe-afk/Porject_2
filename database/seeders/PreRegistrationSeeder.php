<?php

namespace Database\Seeders;

use App\Models\Pre_registration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreRegistrationSeeder extends Seeder
{

    public function run()
    {
        Pre_registration::factory()->count(100)->create();
    }
}
