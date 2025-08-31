<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EducationContentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('education_contents')->delete();
        
        \DB::table('education_contents')->insert(array (
            0 => 
            array (
                'id' => 1,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'title' => 'research',
                'description' => 'scince research',
                'content_type' => 'pdf',
                'file_url' => NULL,
                'created_at' => '2025-08-30 23:50:16',
                'updated_at' => '2025-08-30 23:50:16',
            ),
            1 => 
            array (
                'id' => 2,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'title' => 'research',
                'description' => 'scince research',
                'content_type' => 'video',
                'file_url' => 'uploads/Education_Contents/1756587169 _ GOALKEEPER SKILLS 🔥⚽️🤯 #football #respect #shorts ⬇️ SUBSCRIBE ⬇️.mp4',
                'created_at' => '2025-08-30 23:52:49',
                'updated_at' => '2025-08-30 23:52:49',
            ),
            2 => 
            array (
                'id' => 3,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'title' => 'research',
                'description' => 'scince research',
                'content_type' => 'pdf',
            'file_url' => 'uploads/Education_Contents/1756587301 _ Black Modern Professional Resume (1).pdf',
                'created_at' => '2025-08-30 23:55:01',
                'updated_at' => '2025-08-30 23:55:01',
            ),
            3 => 
            array (
                'id' => 4,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'title' => 'research',
                'description' => 'lesson',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1756587377 _ Theoritical-ParallelProgramming-lec1-Dr.Rawan Koroni.pdf',
                'created_at' => '2025-08-30 23:56:17',
                'updated_at' => '2025-08-30 23:56:17',
            ),
            4 => 
            array (
                'id' => 5,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'title' => 'research',
                'description' => 'lesson 2',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1756587411 _ Theoritical-ParallelProgramming-Lec2-Dr.Rawan Koroni.pdf',
                'created_at' => '2025-08-30 23:56:51',
                'updated_at' => '2025-08-30 23:56:51',
            ),
            5 => 
            array (
                'id' => 6,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'title' => 'research',
                'description' => 'lesson 3',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1756587429 _ Theoritical-ParallelProgramming-Lec3-Dr.Rawan Koroni.pdf',
                'created_at' => '2025-08-30 23:57:09',
                'updated_at' => '2025-08-30 23:57:09',
            ),
            6 => 
            array (
                'id' => 7,
                'teacher_id' => 1,
                'class_room_id' => 2,
                'title' => 'math _ lesson',
                'description' => 'lesson 1',
                'content_type' => 'pdf',
            'file_url' => 'uploads/Education_Contents/1756587540 _ SE2_Theoretical_Dr.Saeed_Lec_7 (1).pdf',
                'created_at' => '2025-08-30 23:59:00',
                'updated_at' => '2025-08-30 23:59:00',
            ),
            7 => 
            array (
                'id' => 8,
                'teacher_id' => 1,
                'class_room_id' => 2,
                'title' => 'math _ lesson',
                'description' => 'lesson 2',
                'content_type' => 'pdf',
            'file_url' => 'uploads/Education_Contents/1756587566 _ SE2_Theoretical_Dr.Saeed_Lec_8 (1).pdf',
                'created_at' => '2025-08-30 23:59:26',
                'updated_at' => '2025-08-30 23:59:26',
            ),
            8 => 
            array (
                'id' => 9,
                'teacher_id' => 1,
                'class_room_id' => 2,
                'title' => 'math _ lesson',
                'description' => 'lesson 3',
                'content_type' => 'pdf',
            'file_url' => 'uploads/Education_Contents/1756587581 _ Theoritical-SoftwareEngineering2-Lec-4 (1).pdf',
                'created_at' => '2025-08-30 23:59:41',
                'updated_at' => '2025-08-30 23:59:41',
            ),
            9 => 
            array (
                'id' => 10,
                'teacher_id' => 1,
                'class_room_id' => 2,
                'title' => 'explining vedio',
                'description' => 'vedio 1',
                'content_type' => 'video',
                'file_url' => 'uploads/Education_Contents/1756587673 _ GOALKEEPER SKILLS 🔥⚽️🤯 #football #respect #shorts ⬇️ SUBSCRIBE ⬇️.mp4',
                'created_at' => '2025-08-31 00:01:13',
                'updated_at' => '2025-08-31 00:01:13',
            ),
        ));
        
        
    }
}