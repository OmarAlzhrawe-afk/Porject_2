<?php

namespace Database\Factories;

use App\Models\Class_room;
use App\Models\Qr_Code;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class QrCodeFactory extends Factory
{
    protected $model = Qr_Code::class;

    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $class = Class_room::inRandomOrder()->first();

        return [
            'class_id' => $class ? $class->id : null,
            'user_id' => $user ? $user->id : null,
            'expires_at' => $this->faker->dateTimeBetween('now', '+1 week'),
            'Unique_code' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'Code_type' => $this->faker->randomElement(['teacher', 'employee']),
            'is_Active' => $this->faker->boolean(90),
        ];
    }
}
