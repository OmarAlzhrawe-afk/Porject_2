<?php

namespace Database\Factories;

use App\Models\Staff_salary_deductions;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DeductionFactory extends Factory
{
    protected $model = Staff_salary_deductions::class;

    public function definition()
    {
        return [
            'user_id' => User::whereIn('role', ['teacher', 'supervisor', 'librarian'])
                ->inRandomOrder()
                ->first()
                ->id,
            'amount' => $this->faker->numberBetween(10, 50),
            'type' => $this->faker->randomElement(['deducation', 'Bonos']),
            'reason' => $this->faker->sentence(6),
        ];
    }
}
