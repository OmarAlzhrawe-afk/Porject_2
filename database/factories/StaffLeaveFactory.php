<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Staff_leaves;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StaffLeaveFactory extends Factory
{
    protected $model = Staff_leaves::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'leave_date' => $this->faker->dateTimeThisYear()->format('Y-m-d'),
            'period' => $this->faker->randomElement(['day', '3day', 'week', '2week', 'month', 'year']),
            'leave_type' => $this->faker->randomElement(['sick', 'personal', 'unpaid', 'emergency']),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'notes' => $this->faker->optional()->paragraph,
        ];
    }
}
