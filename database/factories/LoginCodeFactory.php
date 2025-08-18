<?php

namespace Database\Factories;

use App\Models\Login_code;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LoginCodeFactory extends Factory
{
    protected $model = Login_code::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'code' => $this->faker->regexify('[0-9]{6}'),
            'created_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
