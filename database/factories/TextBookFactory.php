<?php

namespace Database\Factories;

use App\Models\Education_level;
use App\Models\Subject;
use App\Models\Text_book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TextBook>
 */
class TextBookFactory extends Factory
{
    protected $model = Text_book::class;

    public function definition()
    {
        // $subject = Subject::inRandomOrder()->first();
        // $educationLevel = Education_level::inRandomOrder()->first();
        $totalQuantity = $this->faker->numberBetween(20, 100);
        $soldQuantity = $this->faker->numberBetween(0, $totalQuantity);
        return [
            // 'subject_id' => $subject->id,
            // 'education_level_id' => $educationLevel->id,
            'title' => $this->faker->title(),
            'total_quantity' => $totalQuantity,
            'sold_quantity' => $soldQuantity,
            'price' => $this->faker->numberBetween(5, 50),
            'available_quantity' => $totalQuantity - $soldQuantity,
        ];
    }
}
