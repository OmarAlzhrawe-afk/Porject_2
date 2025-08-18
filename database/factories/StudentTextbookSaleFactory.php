<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Student_textbook_sale;
use App\Models\Text_book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StudentTextbookSaleFactory extends Factory
{
    protected $model = Student_textbook_sale::class;

    public function definition()
    {
        $quantity = $this->faker->numberBetween(1, 5);
        $textBook = Text_book::inRandomOrder()->first() ?? Text_book::factory()->create();
        $price = $textBook->price ?? $this->faker->numberBetween(10, 100);

        return [
            'student_id' => Student::inRandomOrder()->first()->id ?? Student::factory()->create()->id,
            'textbook_id' => $textBook->id,
            'sale_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'quantity' => $quantity,
            'total_price' => $quantity * $price,
        ];
    }
}
