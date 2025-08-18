<?php

namespace Database\Factories;

use App\Models\Installment_payment;
use App\Models\Installment_Plan;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class InstallmentPaymentFactory extends Factory
{
    protected $model = Installment_payment::class;

    public function definition()
    {
        $student = Student::inRandomOrder()->first();
        $plan = Installment_Plan::inRandomOrder()->first();

        return [
            'student_id' => $student ? $student->id : null,
            'installment_plan_id' => $plan ? $plan->id : null,
            'due_date' => $this->faker->dateTimeBetween('now', '+6 months'),
            'amount' => $plan ? $plan->total_amount / $plan->number_of_installments : $this->faker->numberBetween(50, 200),
            'paid' => $this->faker->boolean(70),
            'payment_date' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
