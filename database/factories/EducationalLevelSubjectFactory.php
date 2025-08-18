<?php

namespace Database\Factories;

use App\Models\Educationlevelsubject;
use App\Models\Subject;
use App\Models\Education_level;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EducationalLevelSubjectFactory extends Factory
{
    protected $model = Educationlevelsubject::class;

    public function definition()
    {
        $level = Education_level::inRandomOrder()->first();
        $subject = Subject::inRandomOrder()->first();

        return [
            'education_level_id' => $level ? $level->id : null,
            'subject_id' => $subject ? $subject->id : null,
        ];
    }
}
