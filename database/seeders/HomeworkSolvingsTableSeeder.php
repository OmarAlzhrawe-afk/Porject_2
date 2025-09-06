<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HomeworkSolvingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('homework_solvings')->delete();
        
        \DB::table('homework_solvings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'homework_id' => 1,
                'student_id' => 1,
                'solve_url' => 'uploads/Homwork/solving1757112679_SE2_2022-2023-2.pdf',
                'solved' => 0,
                'nots' => NULL,
                'created_at' => '2025-09-06 01:51:19',
                'updated_at' => '2025-09-06 01:51:19',
            ),
        ));
        
        
    }
}