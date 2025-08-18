<?php

namespace Database\Seeders;

use App\Models\Education_level;
use App\Models\Installment_Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstallmentPlanSeeder extends Seeder
{
    public function run()
    {
        Education_level::all()->each(function ($level) {
            Installment_Plan::factory()->count(rand(2, 5))->create([
                'education_level_id' => $level->id,
            ]);
        });
    }
}
