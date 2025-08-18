<?php

namespace Database\Factories;

use App\Models\Class_room;
use App\Models\Home_work;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class HomeworkFactory extends Factory
{
    protected $model = Home_work::class;

    public function definition()
    {
        $teacher = Teacher::inRandomOrder()->first();
        $class = Class_room::inRandomOrder()->first();

        return [
            'teacher_id' => $teacher ? $teacher->id : null,
            'class_id' => $class ? $class->id : null,
            'description' => $this->faker->sentence(),
            'homework_url' => $this->faker->url(),
            'last_date' => $this->faker->dateTimeBetween('now', '+2 weeks'),
        ];
    }
}
