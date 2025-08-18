<?php

namespace Database\Factories;

use App\Models\Academic_year;
use App\Models\Education_level;
use App\Models\Supervisor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EducationLevel>
 */
class EducationLevelFactory extends Factory
{
    protected $model = Education_level::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(), // اسم المستوى
            'description' => $this->faker->sentence(10), // وصف قصير
            'price' => $this->faker->numberBetween(500, 5000), // سعر التسجيل
            'is_fully' => $this->faker->boolean(20), // مكتمل أو لا
            'academic_year_id' => Academic_year::inRandomOrder()->value('id') ??  Academic_year::factory(), // علاقة مع academic_years
            'supervisor_id' => Supervisor::inRandomOrder()->value('id') ?? Supervisor::factory(),
        ];
    }
}
