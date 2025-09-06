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
                'title' => 'article',
                'description' => 'article',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111189 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:26:29',
                'updated_at' => '2025-09-06 01:26:29',
            ),
            1 => 
            array (
                'id' => 2,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'title' => 'lesson1',
                'description' => 'lesson1',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111207 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:26:47',
                'updated_at' => '2025-09-06 01:26:47',
            ),
            2 => 
            array (
                'id' => 3,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'title' => 'lesson2',
                'description' => 'lesson2',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111215 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:26:55',
                'updated_at' => '2025-09-06 01:26:55',
            ),
            3 => 
            array (
                'id' => 4,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'title' => 'lesson3',
                'description' => 'lesson3',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111223 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:27:03',
                'updated_at' => '2025-09-06 01:27:03',
            ),
            4 => 
            array (
                'id' => 5,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'title' => 'lesson4',
                'description' => 'lesson4',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111231 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:27:11',
                'updated_at' => '2025-09-06 01:27:11',
            ),
            5 => 
            array (
                'id' => 6,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'title' => 'lesson5',
                'description' => 'lesson5',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111238 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:27:18',
                'updated_at' => '2025-09-06 01:27:18',
            ),
            6 => 
            array (
                'id' => 7,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'title' => 'lesson6',
                'description' => 'lesson6',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111247 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:27:27',
                'updated_at' => '2025-09-06 01:27:27',
            ),
            7 => 
            array (
                'id' => 8,
                'teacher_id' => 1,
                'class_room_id' => 1,
                'title' => 'lesson7',
                'description' => 'lesson7',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111258 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:27:38',
                'updated_at' => '2025-09-06 01:27:38',
            ),
            8 => 
            array (
                'id' => 9,
                'teacher_id' => 1,
                'class_room_id' => 2,
                'title' => 'lesson1',
                'description' => 'lesson1',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111300 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:28:20',
                'updated_at' => '2025-09-06 01:28:20',
            ),
            9 => 
            array (
                'id' => 10,
                'teacher_id' => 1,
                'class_room_id' => 2,
                'title' => 'lesson2',
                'description' => 'lesson2',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111310 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:28:30',
                'updated_at' => '2025-09-06 01:28:30',
            ),
            10 => 
            array (
                'id' => 11,
                'teacher_id' => 1,
                'class_room_id' => 2,
                'title' => 'lesson3',
                'description' => 'lesson3',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111317 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:28:37',
                'updated_at' => '2025-09-06 01:28:37',
            ),
            11 => 
            array (
                'id' => 12,
                'teacher_id' => 1,
                'class_room_id' => 3,
                'title' => 'lesson1',
                'description' => 'lesson1',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111327 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:28:47',
                'updated_at' => '2025-09-06 01:28:47',
            ),
            12 => 
            array (
                'id' => 13,
                'teacher_id' => 1,
                'class_room_id' => 4,
                'title' => 'lesson1',
                'description' => 'lesson1',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111337 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:28:57',
                'updated_at' => '2025-09-06 01:28:57',
            ),
            13 => 
            array (
                'id' => 14,
                'teacher_id' => 1,
                'class_room_id' => 5,
                'title' => 'lesson1',
                'description' => 'lesson1',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111343 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:29:03',
                'updated_at' => '2025-09-06 01:29:03',
            ),
            14 => 
            array (
                'id' => 15,
                'teacher_id' => 1,
                'class_room_id' => 6,
                'title' => 'lesson1',
                'description' => 'lesson1',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111347 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:29:07',
                'updated_at' => '2025-09-06 01:29:07',
            ),
            15 => 
            array (
                'id' => 16,
                'teacher_id' => 1,
                'class_room_id' => 7,
                'title' => 'lesson1',
                'description' => 'lesson1',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111354 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:29:14',
                'updated_at' => '2025-09-06 01:29:14',
            ),
            16 => 
            array (
                'id' => 17,
                'teacher_id' => 1,
                'class_room_id' => 8,
                'title' => 'lesson1',
                'description' => 'lesson1',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111359 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:29:19',
                'updated_at' => '2025-09-06 01:29:19',
            ),
            17 => 
            array (
                'id' => 18,
                'teacher_id' => 1,
                'class_room_id' => 9,
                'title' => 'lesson1',
                'description' => 'lesson1',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111364 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:29:24',
                'updated_at' => '2025-09-06 01:29:24',
            ),
            18 => 
            array (
                'id' => 19,
                'teacher_id' => 1,
                'class_room_id' => 9,
                'title' => 'lesson2',
                'description' => 'lesson2',
                'content_type' => 'pdf',
                'file_url' => 'uploads/Education_Contents/1757111382 _ SE2_2022-2023-2.pdf',
                'created_at' => '2025-09-06 01:29:42',
                'updated_at' => '2025-09-06 01:29:42',
            ),
        ));
        
        
    }
}