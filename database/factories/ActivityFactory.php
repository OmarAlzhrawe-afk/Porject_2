<?php

namespace Database\Factories;

use App\Helpers\HelpersFunctions;
use App\Models\Activity;
use App\Models\Class_room;
use App\Models\Education_level;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition()
    {
        $targetGroup = $this->faker->randomElement(['all', 'class', 'stage', 'specific']);
        $classRoomId = null;
        $educationLevelId = null;
        if ($targetGroup === 'class') {
            $classRoomId = Class_room::inRandomOrder()->first()?->id;
        } elseif ($targetGroup === 'stage') {
            $educationLevelId = Education_level::inRandomOrder()->first()?->id;
        }
        return [
            'Title' => $this->faker->sentence(3),
            'class_room_id' => $classRoomId,
            'education_level_id' => $educationLevelId,
            'term_id' => HelpersFunctions::getCurrentTermId(),

            'Description' => $this->faker->paragraph(),
            'activity_type' => $this->faker->randomElement(['trip', 'sports', 'art', 'competition', 'course', 'other']),
            'date' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
            'location' => $this->faker->city(),

            'target_group' => $targetGroup,
            'is_paid' => $this->faker->boolean(),
            'cost' => $this->faker->numberBetween(10, 200),
            'seats_limit' => $this->faker->optional()->numberBetween(10, 100),
            'registration_deadline' => $this->faker->dateTimeBetween('now', '+1 month'),
            'is_open' => true,

            'gallery_urls' => json_encode($this->faker->words(3, false)),
            'required_skills' => json_encode($this->faker->words(2, false)),

            'auto_filter_participants' => $this->faker->boolean(),
        ];
    }
}
