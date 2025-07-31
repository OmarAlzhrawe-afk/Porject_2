<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('reports')->delete();
        
        \DB::table('reports')->insert(array (
            0 => 
            array (
                'id' => 1,
                'report_type' => 'library',
                'report_url' => 'reports/libraryReports/Library_Report_2025-07.pdf',
                'report_description' => ' ',
                'report_date' => '2025-07',
                'created_at' => '2025-07-30 23:37:39',
                'updated_at' => '2025-07-30 23:37:39',
            ),
            1 => 
            array (
                'id' => 2,
                'report_type' => 'library',
                'report_url' => 'reports/libraryReports/Library_Report_2025-07.pdf',
                'report_description' => ' ',
                'report_date' => '2025-07',
                'created_at' => '2025-07-30 23:43:20',
                'updated_at' => '2025-07-30 23:43:20',
            ),
        ));
        
        
    }
}