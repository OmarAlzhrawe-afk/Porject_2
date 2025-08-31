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
                'score' => NULL,
                'behavior_notes' => NULL,
                'health_notes' => NULL,
                'interests' => NULL,
                'activities_participated' => NULL,
                'achievements' => NULL,
                'guardian_feedback' => NULL,
                'teacher_feedback' => '{"teacher1":["weak in math","strong in math","weak in sport"],"teacher2":["weak in sport"]}',
                'skills' => NULL,
                'created_at' => '2025-08-31 02:23:23',
                'updated_at' => '2025-08-31 02:37:50',
            ),
            1 => 
            array (
                'id' => 2,
                'student_id' => 2,
                'education_level_id' => 1,
                'total_absences' => 0,
                'unexcused_absences' => 0,
                'score' => NULL,
                'behavior_notes' => NULL,
                'health_notes' => NULL,
                'interests' => NULL,
                'activities_participated' => NULL,
                'achievements' => NULL,
                'guardian_feedback' => NULL,
                'teacher_feedback' => '{"teacher1":["strong in math","weak in math","weak in math","weak in sport"]}',
                'skills' => NULL,
                'created_at' => '2025-08-31 02:23:47',
                'updated_at' => '2025-08-31 02:36:02',
            ),
            2 => 
            array (
                'id' => 3,
                'student_id' => 3,
                'education_level_id' => 1,
                'total_absences' => 0,
                'unexcused_absences' => 0,
                'score' => NULL,
                'behavior_notes' => NULL,
                'health_notes' => NULL,
                'interests' => NULL,
                'activities_participated' => NULL,
                'achievements' => NULL,
                'guardian_feedback' => NULL,
                'teacher_feedback' => '{"teacher1":["weak in sport"]}',
                'skills' => NULL,
                'created_at' => '2025-08-31 02:36:16',
                'updated_at' => '2025-08-31 02:36:16',
            ),
            3 => 
            array (
                'id' => 4,
                'student_id' => 4,
                'education_level_id' => 1,
                'total_absences' => 0,
                'unexcused_absences' => 0,
                'score' => NULL,
                'behavior_notes' => NULL,
                'health_notes' => NULL,
                'interests' => NULL,
                'activities_participated' => NULL,
                'achievements' => NULL,
                'guardian_feedback' => NULL,
                'teacher_feedback' => '{"teacher1":["weak in sport"],"teacher2":["weak in sport"]}',
                'skills' => NULL,
                'created_at' => '2025-08-31 02:36:21',
                'updated_at' => '2025-08-31 02:37:44',
            ),
        ));
        
        
    }
}