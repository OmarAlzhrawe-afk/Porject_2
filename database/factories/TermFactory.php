<?php

namespace Database\Factories;

use App\Models\Academic_year;
use App\Models\Term;
use Illuminate\Database\Eloquent\Factories\Factory;
use SebastianBergmann\Type\TrueType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Term>
 */
class TermFactory extends Factory
{
    protected $model = Term::class;

    public function definition()
    {
        // تاريخ البداية والنهاية في نفس السنة تقريباً
        $startDate = $this->faker->dateTimeBetween('2025-01-01', '2025-06-01');
        $endDate = (clone $startDate)->modify('+4 months');

        return [
            // إذا لم يمرر academic_year_id سننشئ واحد جديد من AcademicYearFactory
            'academic_year_id' => Academic_year::factory(),
            'name' => $this->faker->randomElement(['First Term', 'Second Term', 'Summer Term']),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'is_current' => $this->faker->boolean(true),
        ];
    }
}
