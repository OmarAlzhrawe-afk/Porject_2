<?php

namespace Database\Factories;

use App\Models\Class_room;
use App\Models\Education_level;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Class_room>
 */
class ClassRoomFactory extends Factory
{
    protected $model = Class_room::class;

    public function definition(): array
    {
        return [
            'education_level_id' => Education_level::factory(),
            'name' => $this->faker->unique()->word() . ' Room',
            'capacity' => $this->faker->numberBetween(20, 50),
            'current_count' => $this->faker->numberBetween(0, 20),
            'floor' => $this->faker->numberBetween(1, 4),
        ];
    }
    public function withEducationLevel($educationLevelId)
    {
        return $this->state(function (array $attributes) use ($educationLevelId) {
            return [
                'education_level_id' => $educationLevelId
            ];
        });
    }
}
