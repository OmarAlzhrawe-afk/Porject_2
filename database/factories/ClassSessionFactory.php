<?php

namespace Database\Factories;

use App\Models\Class_room;
use App\Models\Class_session;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClassSessionFactory extends Factory
{
    protected $model = Class_session::class;

    public function definition()
    {
        return [
            'teacher_id' => Teacher::inRandomOrder()->first()->id,
            'class_room_id' => Class_room::inRandomOrder()->first()->id,
            'session_day' => $this->faker->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']),
            'start_time' => $this->faker->time('H:i:s'),
            'end_time' => $this->faker->time('H:i:s'),
        ];
    }

    public function forTeacher(Teacher $teacher)
    {
        return $this->state(fn() => [
            'teacher_id' => $teacher->id,
        ]);
    }
}
