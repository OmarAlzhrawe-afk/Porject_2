<?php

namespace Database\Factories;

use App\Models\Education_level;
use App\Models\Student;
use App\Models\Student_profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentProfile>
 */
class StudentProfileFactory extends Factory
{
    protected $model = Student_profile::class;

    public function definition()
    {
        return [
            'student_id' => Student::factory(),
            'education_level_id' => Education_level::factory(),
            'total_absences' => $this->faker->numberBetween(0, 20),
            'unexcused_absences' => $this->faker->numberBetween(0, 10),
            'score' => $this->faker->optional()->randomFloat(2, 0, 100),
            'behavior_notes' => $this->faker->optional()->paragraph(),
            'health_notes' => $this->faker->optional()->paragraph(),
            'interests' => $this->faker->optional()->randomElements(['sports', 'music', 'reading', 'art', 'science'], 3),
            'activities_participated' => $this->faker->optional()->randomElements(['math competition', 'science fair', 'football tournament', 'debate club'], 2),
            'achievements' => $this->faker->optional()->randomElements(['award1', 'award2', 'certificate1', 'certificate2'], 2),
            'guardian_feedback' => $this->faker->optional()->paragraph(),
            'teacher_feedback' => $this->faker->optional()->paragraph(),
            'skills' => $this->faker->optional()->randomElements(['math', 'science', 'writing', 'programming'], 2),
        ];
    }
}
