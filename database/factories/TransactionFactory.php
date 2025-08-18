<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        $user = User::inRandomOrder()->first();

        $payment_methods = ['cash', 'visa', 'Transfer(shamcash)'];
        $transaction_sources = ['pay_salary', 'buy_book', 'pre_registration', 'installment_student', 'Enroll_activity'];
        $status = ['pending', 'paid', 'failed'];
        $type = ['in', 'out'];

        return [
            'user_id' => $user ? $user->id : null,
            'payment_method' => $this->faker->randomElement($payment_methods),
            'amount' => $this->faker->numberBetween(20, 500),
            'type' => $this->faker->randomElement($type),
            'transaction_source' => $this->faker->randomElement($transaction_sources),
            'status' => $this->faker->randomElement($status),
            'installment_number' => $this->faker->optional()->numberBetween(1, 10),
            'payment_reference' => $this->faker->optional()->uuid(),
            'is_installment' => $this->faker->boolean(),
        ];
    }
}
