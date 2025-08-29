<?php

namespace Database\Factories;

use App\Models\Cultural_book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CulturalBookFactory extends Factory
{
    protected $model = Cultural_book::class;
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3), // عنوان الكتاب
            'author' => $this->faker->name(), // اسم المؤلف
            'publisher' => $this->faker->company(), // دار النشر
            'publication_year' => $this->faker->date('Y-m-d'), // سنة النشر
            'type' => $this->faker->randomElement(['paper', 'pdf', 'audio']), // نوع الكتاب
            'format_url' => $this->faker->optional()->url(), // رابط الملف إن وجد
            'copies_available' => $this->faker->numberBetween(0, 50), // نسخ متاحة
            'avg_student_rating' => $this->faker->randomFloat(1, 0, 5), // متوسط تقييم الطلاب
            'avg_teacher_rating' => $this->faker->randomFloat(1, 0, 5), // متوسط تقييم المدرسين
            'total_student_reviews' => $this->faker->numberBetween(0, 200), // عدد تقييمات الطلاب
            'total_teacher_reviews' => $this->faker->numberBetween(0, 50), // عدد تقييمات المدرسين
            'description' => $this->faker->paragraph(), // وصف الكتاب
        ];
    }
}
