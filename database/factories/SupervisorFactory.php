<?php

namespace Database\Factories;

use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supervisor>
 */
class SupervisorFactory extends Factory
{
    protected $model = Supervisor::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // ينشئ يوزر جديد ويربطه بالمشرف
            'status' => $this->faker->randomElement(['active', 'on_leave', 'resigned']),
        ];
    }
}
