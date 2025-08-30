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
                'name' => 'scince',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'physics',
            ),
        ));
        
        
    }
}