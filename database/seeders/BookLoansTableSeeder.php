<?php

namespace Database\Seeders;

use App\Models\Book_loan;
use Illuminate\Database\Seeder;

class BookLoansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Book_loan::factory(10)->create();
    }
}
