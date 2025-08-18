<?php

namespace Database\Factories;

use App\Models\Education_level;
use App\Models\Installment_Plan;
use App\Models\Pre_registration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PreRegistration>
 */
class PreRegistrationFactory extends Factory
{
    protected $model = Pre_registration::class;

    public function definition()
    {
        return [
            'education_level_id' => Education_level::inRandomOrder()->first()->id,
            'installment_plan_id' => Installment_Plan::inRandomOrder()->first()->id,
            'payment_reference' => $this->faker->optional()->uuid,
            'payment_status' => $this->faker->boolean(20),
            'student_name' => $this->faker->name,
            'student_email' => $this->faker->unique()->email(),
            'parent_name' => $this->faker->name,
            'parent_email' => $this->faker->unique()->email(),
            'phone_number' => $this->faker->phoneNumber,
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
            'documents' => json_encode([$this->faker->word . '.pdf']),
        ];
    }
}
