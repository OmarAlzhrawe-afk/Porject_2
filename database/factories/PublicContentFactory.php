<?php

namespace Database\Factories;

use App\Models\Public_content;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PublicContent>
 */
class PublicContentFactory extends Factory
{
    protected $model = Public_content::class;

    public function definition()
    {
        return [
            'content_type' => $this->faker->randomElement(['about', 'vision', 'Frequently_asked_questions']),
            'content' => $this->faker->paragraphs(3, true),
        ];
    }
}
