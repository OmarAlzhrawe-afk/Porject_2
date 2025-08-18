<?php

namespace Database\Factories;

use App\Models\Education_level;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InstallmentPlan>
 */
class InstallmentPlanFactory extends Factory
{
    protected $model = \App\Models\Installment_Plan::class;

    public function definition(): array
    {
        $numberOfInstallments = $this->faker->numberBetween(2, 12);
        $totalAmount = $this->faker->numberBetween(1000, 5000);

        return [
            'name' => $this->faker->words(2, true),
            'education_level_id' => Education_level::inRandomOrder()->first()->id ?? 1,
            'total_amount' => $totalAmount,
            'number_of_installments' => $numberOfInstallments,
            'count_of_days_per_each_installment' => $this->faker->numberBetween(15, 60),
            'description' => $this->faker->sentence(),
        ];
    }
    public function forEducationLevel(Education_level $educationLevel): Factory
    {
        return $this->state(function () use ($educationLevel) {
            return [
                'education_level_id' => $educationLevel->id,
            ];
        });
    }
}
