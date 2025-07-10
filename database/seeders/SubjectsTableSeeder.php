<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('subjects')->delete();

        DB::table('subjects')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'math',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'sience',
            ),
            array(
                'id' => 3,
                'name' => 'sport',
            ),
            array(
                'id' => 4,
                'name' => 'music',
            ),
        ));
    }
}
