<?php

namespace Database\Seeders;

use App\Helpers\HelpersFunctions;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarkSeeder extends Seeder
{

    public function run()
    {
        $term_id = HelpersFunctions::getCurrentTermId();
        Teacher::all()->each(function ($teacher) use ($term_id) {
            $teacher->sessions->each(function ($session) use ($teacher, $term_id) {
                $classRoom = $session->class_room;
                if (!$classRoom) return;

                $students = $classRoom->students;
                if ($students->isEmpty()) return;

                foreach ($students as $student) {
                    foreach (['quiz', 'midterm', 'final'] as $examType) {
                        Mark::factory()->create([
                            'student_id' => $student->id,
                            'teacher_id' => $teacher->id,
                            'term_id'    => $term_id,
                            'exam_type'  => $examType,
                            'max_score'  => 10,
                            'score'      => rand(0, 10),
                        ]);
                    }
                }
            });
        });
    }
}
