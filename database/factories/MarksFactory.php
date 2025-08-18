<?php

namespace Database\Factories;

use App\Helpers\HelpersFunctions;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Term;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MarksFactory extends Factory
{
    protected  $model = Mark::class;
    public function definition()
    {
        return [
            'student_id' => fn() => Student::inRandomOrder()->first()->id,  // اختيار طالب عشوائي
            'teacher_id' => fn() => Teacher::inRandomOrder()->first()->id,  // اختيار مدرس عشوائي
            'term_id'    => fn() => HelpersFunctions::getCurrentTermId(),     // اختيار فصل دراسي عشوائي
            'exam_type'  => $this->faker->randomElement(['quiz', 'midterm', 'final', 'homework', 'activity']),
            'score'      => $this->faker->numberBetween(0, 10),
            'max_score'  => 10,
            'date'       => $this->faker->date(),
            'teacher_note' => $this->faker->optional()->sentence(),
        ];
    }
}
