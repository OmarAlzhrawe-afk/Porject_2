<?php

namespace Database\Factories;

use App\Models\Class_room;
use App\Models\Education_content;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EducationContentFactory extends Factory
{
    protected $model = Education_content::class;

    public function definition()
    {
        return [
            'teacher_id' => Teacher::inRandomOrder()->first()->id, // معلم عشوائي
            'class_room_id' => Class_room::inRandomOrder()->first()->id, // صف عشوائي
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'content_type' => $this->faker->randomElement(['video', 'pdf', 'link', 'image', 'text', 'quiz']),
            'file_url' => function (array $attributes) {
                if (in_array($attributes['content_type'], ['pdf', 'video', 'image'])) {
                    return 'storage/contents/' . $this->faker->lexify('file_????') . '.' . $attributes['content_type'];
                }
                if ($attributes['content_type'] == 'link') {
                    return $this->faker->url();
                }
                return null;
            },
        ];
    }
    public function forTeacherAndClass($teacherId, $classRoomId)
    {
        return $this->state(fn() => [
            'teacher_id' => $teacherId,
            'class_room_id' => $classRoomId,
        ]);
    }
}
