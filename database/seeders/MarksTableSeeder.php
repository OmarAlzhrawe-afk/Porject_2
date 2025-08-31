<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MarksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('marks')->delete();
        
        \DB::table('marks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'student_id' => 1,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'midterm',
                'score' => 9,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:40:29',
                'updated_at' => '2025-08-31 00:40:29',
            ),
            1 => 
            array (
                'id' => 2,
                'student_id' => 1,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'final',
                'score' => 8,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:41:07',
                'updated_at' => '2025-08-31 00:41:07',
            ),
            2 => 
            array (
                'id' => 3,
                'student_id' => 1,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'final',
                'score' => 3,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:41:33',
                'updated_at' => '2025-08-31 00:41:33',
            ),
            3 => 
            array (
                'id' => 4,
                'student_id' => 1,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'activity',
                'score' => 6,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:41:46',
                'updated_at' => '2025-08-31 00:41:46',
            ),
            4 => 
            array (
                'id' => 5,
                'student_id' => 1,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'homework',
                'score' => 6,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:42:09',
                'updated_at' => '2025-08-31 00:42:09',
            ),
            5 => 
            array (
                'id' => 6,
                'student_id' => 2,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'midterm',
                'score' => 6,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:42:35',
                'updated_at' => '2025-08-31 00:42:35',
            ),
            6 => 
            array (
                'id' => 7,
                'student_id' => 2,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'final',
                'score' => 8,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:42:46',
                'updated_at' => '2025-08-31 00:42:46',
            ),
            7 => 
            array (
                'id' => 8,
                'student_id' => 2,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'homework',
                'score' => 5,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:42:57',
                'updated_at' => '2025-08-31 00:42:57',
            ),
            8 => 
            array (
                'id' => 9,
                'student_id' => 2,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'activity',
                'score' => 9,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:43:14',
                'updated_at' => '2025-08-31 00:43:14',
            ),
            9 => 
            array (
                'id' => 10,
                'student_id' => 3,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'midterm',
                'score' => 9,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:43:56',
                'updated_at' => '2025-08-31 00:43:56',
            ),
            10 => 
            array (
                'id' => 11,
                'student_id' => 3,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'final',
                'score' => 9,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:44:15',
                'updated_at' => '2025-08-31 00:44:15',
            ),
            11 => 
            array (
                'id' => 12,
                'student_id' => 3,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'homework',
                'score' => 9,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:44:23',
                'updated_at' => '2025-08-31 00:44:23',
            ),
            12 => 
            array (
                'id' => 13,
                'student_id' => 3,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'activity',
                'score' => 9,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:44:31',
                'updated_at' => '2025-08-31 00:44:31',
            ),
            13 => 
            array (
                'id' => 14,
                'student_id' => 4,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'midterm',
                'score' => 9,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:44:57',
                'updated_at' => '2025-08-31 00:44:57',
            ),
            14 => 
            array (
                'id' => 15,
                'student_id' => 4,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'homework',
                'score' => 9,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:45:21',
                'updated_at' => '2025-08-31 00:45:21',
            ),
            15 => 
            array (
                'id' => 16,
                'student_id' => 7,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'homework',
                'score' => 9,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:45:43',
                'updated_at' => '2025-08-31 00:45:43',
            ),
            16 => 
            array (
                'id' => 17,
                'student_id' => 7,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'midterm',
                'score' => 7,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:46:02',
                'updated_at' => '2025-08-31 00:46:02',
            ),
            17 => 
            array (
                'id' => 18,
                'student_id' => 7,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'final',
                'score' => 7,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:46:41',
                'updated_at' => '2025-08-31 00:46:41',
            ),
            18 => 
            array (
                'id' => 19,
                'student_id' => 7,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'activity',
                'score' => 7,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:46:53',
                'updated_at' => '2025-08-31 00:46:53',
            ),
            19 => 
            array (
                'id' => 20,
                'student_id' => 8,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'midterm',
                'score' => 7,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:47:13',
                'updated_at' => '2025-08-31 00:47:13',
            ),
            20 => 
            array (
                'id' => 21,
                'student_id' => 8,
                'teacher_id' => 1,
                'term_id' => 1,
                'exam_type' => 'final',
                'score' => 7,
                'max_score' => 10,
                'date' => '2025-08-31',
                'teacher_note' => 'good',
                'created_at' => '2025-08-31 00:47:28',
                'updated_at' => '2025-08-31 00:47:28',
            ),
        ));
        
        
    }
}