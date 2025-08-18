<?php

namespace Database\Seeders;

use App\Models\Qr_Code;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QrCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Qr_Code::factory()->count(20)->create();
    }
}
