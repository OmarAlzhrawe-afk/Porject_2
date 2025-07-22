<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentProfilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('student_profiles')->delete();
        
        \DB::table('student_profiles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'student_id' => 1,
                'education_level_id' => 1,
                'total_absences' => 0,
                'unexcused_absences' => 0,
                'score' => '92.50',
                'behavior_notes' => 'student good',
                'health_notes' => 'is perfect',
                'interests' => '["[sport,reading]"]',
                'activities_participated' => '["[camping,reading competion]"]',
                'achievements' => '["[first disk in swimming,reading competion]"]',
                'guardian_feedback' => 'perfect',
                'teacher_feedback' => 'perfect',
                'skills' => '["[speaking,swimming]"]',
                'created_at' => '2025-07-21 21:21:14',
                'updated_at' => '2025-07-21 21:21:14',
            ),
        ));
        
        
    }
}