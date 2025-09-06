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
                'total_absences' => 1,
                'unexcused_absences' => 0,
                'score' => '63.00',
                'behavior_notes' => 'student good',
                'health_notes' => '"is perfect"',
                'interests' => '["reading","sport"]',
                'activities_participated' => '["camping","reading","competion"]',
                'achievements' => '["reading competion","first disk in swimming"]',
                'guardian_feedback' => NULL,
                'teacher_feedback' => '{"basem":["is soo doncy"]}',
                'skills' => '["swimming","speaking"]',
                'created_at' => '2025-09-06 00:00:33',
                'updated_at' => '2025-09-06 02:23:51',
            ),
            1 => 
            array (
                'id' => 2,
                'student_id' => 2,
                'education_level_id' => 1,
                'total_absences' => 1,
                'unexcused_absences' => 0,
                'score' => '21.00',
                'behavior_notes' => 'student good',
                'health_notes' => '"is perfect"',
                'interests' => '["reading","sport"]',
                'activities_participated' => '["camping","reading","competion"]',
                'achievements' => '["reading competion","first disk in swimming"]',
                'guardian_feedback' => NULL,
                'teacher_feedback' => '{"basem":["is soo doncy","is soo quite","is soo quite"]}',
                'skills' => '["swimming","speaking"]',
                'created_at' => '2025-09-06 00:01:34',
                'updated_at' => '2025-09-06 02:23:51',
            ),
            2 => 
            array (
                'id' => 3,
                'student_id' => 3,
                'education_level_id' => 1,
                'total_absences' => 1,
                'unexcused_absences' => 0,
                'score' => '21.00',
                'behavior_notes' => 'student good',
                'health_notes' => '"is perfect"',
                'interests' => '["reading","sport"]',
                'activities_participated' => '["camping","reading","competion"]',
                'achievements' => '["reading competion","first disk in swimming"]',
                'guardian_feedback' => NULL,
                'teacher_feedback' => '{"basem":["is soo quite"]}',
                'skills' => '["swimming","speaking"]',
                'created_at' => '2025-09-06 00:02:16',
                'updated_at' => '2025-09-06 02:23:51',
            ),
            3 => 
            array (
                'id' => 4,
                'student_id' => 4,
                'education_level_id' => 1,
                'total_absences' => 1,
                'unexcused_absences' => 1,
                'score' => '21.00',
                'behavior_notes' => 'student good',
                'health_notes' => '"is perfect"',
                'interests' => '["reading","sport"]',
                'activities_participated' => '["camping","reading","competion"]',
                'achievements' => '["reading competion","first disk in swimming"]',
                'guardian_feedback' => NULL,
                'teacher_feedback' => '{"basem":["is soo quite"]}',
                'skills' => '["swimming","speaking"]',
                'created_at' => '2025-09-06 00:02:35',
                'updated_at' => '2025-09-06 02:23:51',
            ),
            4 => 
            array (
                'id' => 5,
                'student_id' => 5,
                'education_level_id' => 1,
                'total_absences' => 1,
                'unexcused_absences' => 1,
                'score' => '66.50',
                'behavior_notes' => 'student good',
                'health_notes' => '"is perfect"',
                'interests' => '["reading","sport"]',
                'activities_participated' => '["camping","reading","competion"]',
                'achievements' => '["reading competion","first disk in swimming"]',
                'guardian_feedback' => NULL,
                'teacher_feedback' => '{"basem":["is soo quite"]}',
                'skills' => '["swimming","speaking"]',
                'created_at' => '2025-09-06 00:02:47',
                'updated_at' => '2025-09-06 02:23:51',
            ),
            5 => 
            array (
                'id' => 6,
                'student_id' => 6,
                'education_level_id' => 2,
                'total_absences' => 1,
                'unexcused_absences' => 0,
                'score' => '72.50',
                'behavior_notes' => NULL,
                'health_notes' => NULL,
                'interests' => NULL,
                'activities_participated' => NULL,
                'achievements' => NULL,
                'guardian_feedback' => NULL,
                'teacher_feedback' => '{"basem":["is soo quite"]}',
                'skills' => NULL,
                'created_at' => '2025-09-06 00:03:16',
                'updated_at' => '2025-09-06 02:23:51',
            ),
            6 => 
            array (
                'id' => 7,
                'student_id' => 7,
                'education_level_id' => 2,
                'total_absences' => 1,
                'unexcused_absences' => 0,
                'score' => '84.00',
                'behavior_notes' => NULL,
                'health_notes' => NULL,
                'interests' => NULL,
                'activities_participated' => NULL,
                'achievements' => NULL,
                'guardian_feedback' => NULL,
                'teacher_feedback' => '{"basem":["is soo quite"]}',
                'skills' => NULL,
                'created_at' => '2025-09-06 00:04:22',
                'updated_at' => '2025-09-06 02:23:51',
            ),
            7 => 
            array (
                'id' => 8,
                'student_id' => 8,
                'education_level_id' => 3,
                'total_absences' => 1,
                'unexcused_absences' => 1,
                'score' => '75.00',
                'behavior_notes' => NULL,
                'health_notes' => NULL,
                'interests' => NULL,
                'activities_participated' => NULL,
                'achievements' => NULL,
                'guardian_feedback' => NULL,
                'teacher_feedback' => '{"basem":["is soo quite"]}',
                'skills' => NULL,
                'created_at' => '2025-09-06 00:06:08',
                'updated_at' => '2025-09-06 02:23:51',
            ),
        ));
        
        
    }
}