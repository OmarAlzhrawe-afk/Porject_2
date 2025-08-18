<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Student_textbook_sale;

class StudentTextbookSalesTableSeeder extends Seeder
{


    public function run()
    {
        Student_textbook_sale::factory()->count(50)->create();
    }
}
