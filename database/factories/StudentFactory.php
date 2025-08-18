<?php

namespace Database\Factories;

use App\Models\Class_room;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),        // الطالب نفسه
            'parent_id' => User::factory(),      // ولي الأمر
            'class_id' => Class_room::factory(), // الصف
            'installment_total_amount' => $this->faker->randomFloat(2, 500, 5000),
            'installment_count' => $this->faker->numberBetween(1, 12),
            'installment_interval_days' => $this->faker->randomElement([30, 60, 90]),
            'status' => $this->faker->randomElement(['active', 'suspended', 'graduated', 'left']),
        ];
    }
    public function withParent(User $parent)
    {
        return $this->state(fn() => [
            'parent_id' => $parent->id,
        ]);
    }

    public function withUser(User $user)
    {
        return $this->state(fn() => [
            'user_id' => $user->id,
        ]);
    }

    public function withClass($class)
    {
        return $this->state(fn() => [
            'class_id' => is_object($class) ? $class->id : $class,
        ]);
    }
}
