<?php

namespace Database\Factories;

use App\Models\Salary;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Salary>
 */
class SalaryFactory extends Factory
{
    protected $model = Salary::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'Base_salary' => $this->faker->randomFloat(2, 500, 2000),
            'bonus' => $this->faker->randomFloat(2, 0, 500),
            'deductions' => $this->faker->randomFloat(2, 0, 300),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['paid', 'pending']),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
