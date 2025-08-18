<?php

namespace Database\Seeders;

use App\Models\Cultural_book;
use Illuminate\Database\Seeder;

class CulturalBooksTableSeeder extends Seeder
{

    public function run()
    {
        Cultural_book::factory()->count(10)->create();
    }
}
