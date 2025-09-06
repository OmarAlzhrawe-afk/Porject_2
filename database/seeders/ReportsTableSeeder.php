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
                'report_type' => 'financial_transactions',
                'report_url' => 'reports/FinancialReports/financial_report_2025-09.pdf',
                'report_description' => 'Financial Report For Year : 0000-09-06 02:26:18 Month :  2024-12-06 02:26:18',
                'report_date' => '2025-09',
                'created_at' => '2025-09-06 02:26:18',
                'updated_at' => '2025-09-06 02:26:18',
            ),
            1 => 
            array (
                'id' => 2,
                'term_id' => 1,
                'report_type' => 'library',
                'report_url' => 'reports/libraryReports/Library_Report_2025-09.pdf',
                'report_description' => 'Library Report For Year 
: 2025 Month : 09',
                'report_date' => '2025-09',
                'created_at' => '2025-09-06 02:26:34',
                'updated_at' => '2025-09-06 02:26:34',
            ),
            2 => 
            array (
                'id' => 3,
                'term_id' => 1,
                'report_type' => 'students',
                'report_url' => 'reports/StudentReports/Student_Report_2025-09.pdf',
                'report_description' => 'students Report For Year : 0000-09-06 02:33:27 Month :  2024-12-06 02:33:27',
                'report_date' => '2025-09',
                'created_at' => '2025-09-06 02:33:27',
                'updated_at' => '2025-09-06 02:33:27',
            ),
            3 => 
            array (
                'id' => 4,
                'term_id' => 1,
                'report_type' => 'students',
                'report_url' => 'reports/StudentReports/Student_Report_2025-09.pdf',
                'report_description' => 'students Report For Year : 0000-09-06 02:34:09 Month :  2024-12-06 02:34:09',
                'report_date' => '2025-09',
                'created_at' => '2025-09-06 02:34:09',
                'updated_at' => '2025-09-06 02:34:09',
            ),
            4 => 
            array (
                'id' => 5,
                'term_id' => 1,
                'report_type' => 'teachers',
                'report_url' => 'reports/TeacherReports/Teacher_Report_2025-09.pdf',
                'report_description' => 'teachers Report For Year : 0000-09-06 02:34:30 Month :  2024-12-06 02:34:30',
                'report_date' => '2025-09',
                'created_at' => '2025-09-06 02:34:30',
                'updated_at' => '2025-09-06 02:34:30',
            ),
        ));
        
        
    }
}