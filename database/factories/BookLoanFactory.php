<?php

namespace Database\Factories;

use App\Models\Book_loan;
use App\Models\Cultural_book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookLoanFactory extends Factory
{
    protected $model = Book_loan::class;

    public function definition()
    {
        return [
            'user_id' => User::whereIN('role', ['student', 'teacher'])
                ->inRandomOrder()
                ->first()
                ->id,
            'cultural_book_id' => Cultural_book::inRandomOrder()->first()->id,
            'type' => $this->faker->randomElement(['monthly', 'weekly']),
            'status' => $this->faker->randomElement(['returned', 'unreturned']),
        ];
    }
}
