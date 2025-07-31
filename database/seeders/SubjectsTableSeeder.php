<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subjects')->delete();
        
        \DB::table('subjects')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'math',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'logic',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'science',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'chimistry',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'physics',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'sport',
            ),
        ));
        
        
    }
}