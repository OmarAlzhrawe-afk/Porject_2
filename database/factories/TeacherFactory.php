<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

namespace Database\Factories;

use App\Models\Teacher;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),      // ينشئ مستخدم جديد للمعلم
            'subject_id' => Subject::factory(), // ينشئ مادة جديدة
            'Academic_qualification' => $this->faker->randomElement(['Bachelor', 'Master', 'PhD']),
            'Employment_status' => $this->faker->randomElement(['active', 'suspended', 'resigned']),
            'Payment_type' => $this->faker->randomElement(['monthly', 'hourly']),
            'Contract_type' => $this->faker->randomElement(['permanent', 'temporary', 'part_time']),
            'The_beginning_of_the_contract' => $this->faker->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
            'End_of_contract' => $this->faker->dateTimeBetween('now', '+3 years')->format('Y-m-d'),
            'number_of_lesson_in_week' => $this->faker->numberBetween(5, 30),
            'wages_per_lesson' => $this->faker->numberBetween(10, 100),
        ];
    }
    public function withUser(User $user)
    {
        return $this->state(fn() => ['user_id' => $user->id]);
    }
    public function withSubject(Subject $subject)
    {
        return $this->state(fn() => ['subject_id' => $subject->id]);
    }
}
