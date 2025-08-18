<?php

namespace Database\Seeders;

use App\Models\Public_content;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicContentTableSeeder extends Seeder
{

    public function run()
    {
        Public_content::factory()->count(20)->create();
    }
}
