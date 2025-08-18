<?php

namespace Database\Seeders;

use App\Models\Academic_year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcadimicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Academic_year::factory()->count(1)->create();
    }
}
