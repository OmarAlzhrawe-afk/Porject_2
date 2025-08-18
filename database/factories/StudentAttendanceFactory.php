<?php

namespace Database\Factories;

use App\Helpers\HelpersFunctions;
use App\Models\Class_room;
use App\Models\Student;
use App\Models\Student_attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StudentAttendanceFactory extends Factory
{
    protected $model = Student_attendance::class;

    public function definition()
    {
        $student = Student::inRandomOrder()->first();
        $class = Class_room::inRandomOrder()->first();
        // $term = Term::inRandomOrder()->first();

        return [
            'student_id' => $student ? $student->id : null,
            'class_room_id' => $class ? $class->id : null,
            'term_id' => HelpersFunctions::getCurrentTermId(),
            'date' => $this->faker->dateTimeThisYear()->format('Y-m-d'),
            'excused' => $this->faker->boolean(30),
        ];
    }
}
