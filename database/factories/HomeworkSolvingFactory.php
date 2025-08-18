<?php

namespace Database\Factories;

use App\Models\Home_work;
use App\Models\Homeworksolving;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HomeworkSolving>
 */
class HomeworkSolvingFactory extends Factory
{
    protected $model = Homeworksolving::class;

    public function definition()
    {
        $homework = Home_work::inRandomOrder()->first();
        if ($homework) {
            $students = $homework->class->students;
            $student = $students->random();
        } else {
            $student = Student::inRandomOrder()->first();
        }

        return [
            'homework_id' => $homework ? $homework->id : null,
            'student_id' => $student ? $student->id : null,
            'solve_url' => $this->faker->url(),
        ];
    }
}
