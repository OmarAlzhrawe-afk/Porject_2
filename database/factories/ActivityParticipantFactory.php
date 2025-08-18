<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Activity_participants;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ActivityParticipantFactory extends Factory
{
    protected $model = Activity_participants::class;

    public function definition()
    {
        return [
            'activity_id' => Activity::inRandomOrder()->first()->id ?? Activity::factory(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'cancelled', 'free_activity']),
            'attendance' => $this->faker->boolean(),
            'payment_reference' => $this->faker->optional()->uuid(),
            'payment_method' => $this->faker->optional()->randomElement(['cash', 'OnLine']),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
