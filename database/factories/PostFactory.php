<?php

namespace Database\Factories;

use App\Models\School_post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    protected $model = School_post::class;
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->paragraph(3, true),
            'post_type' => $this->faker->randomElement(['lesson', 'news', 'event']),
            'file_url' => $this->faker->imageUrl(300, 300, null, true),
            'is_public' => $this->faker->boolean(40)
        ];
    }
}
