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
                'term_id' => 1,
                'report_type' => 'library',
                'report_url' => 'reports/libraryReports/Library_Report_2025-08.pdf',
                'report_description' => 'Library Report For Year 
: 2025 Month : 08',
                'report_date' => '2025-08',
                'created_at' => '2025-08-30 20:50:21',
                'updated_at' => '2025-08-30 20:50:21',
            ),
        ));
        
        
    }
}