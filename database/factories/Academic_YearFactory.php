<?php

namespace Database\Factories;

use App\Models\Academic_year;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Academic_year>
 */
class Academic_YearFactory extends Factory
{
    protected $model = Academic_year::class;
    public function definition()
    {
        $start = $this->faker->dateTimeBetween('-5 years', '+2 years');
        $end = (clone $start)->modify('+1 year');

        return [
            'name' => $this->faker->year . '/' . ($this->faker->year + 1), // مثال: 2024/2025
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'is_current' => $this->faker->boolean(20),
        ];
    }
}
