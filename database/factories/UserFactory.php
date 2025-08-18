<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Supervisor;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $this->faker->unique(true);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->email(),
            'password' => 'password123', // يمكنك وضع أي كلمة مرور افتراضية
            'role' => $this->faker->randomElement(['admin', 'teacher', 'librarian', 'supervisor', 'student', 'parent']),
            'hire_date' => $this->faker->optional()->date(),
            'ID_documents' => [
                'father_ID'   => 'father_sample.pdf',
                'Mother_ID'   => 'mother_sample.pdf',
                'Personal_ID' => 'personal_sample.pdf',
            ],
            // 'ID_documents' => [
            //     'father_ID' => $this->faker->file(
            //         public_path("uploads/users/IDs/2/17528540310_SE2_2022-2023-2.pdf"),
            //         public_path("uploads/users/IDs/2/17528540310_SE2_2022-2023-2.pdf"),
            //         true
            //     ),
            //     'Mother_ID' => $this->faker->file(
            //         public_path("uploads/users/IDs/2/17528540310_SE2_2022-2023-2.pdf"),
            //         public_path("uploads/users/IDs/2/17528540310_SE2_2022-2023-2.pdf"),
            //         true
            //     ),
            //     'Personal_ID' => $this->faker->file(
            //         storage_path("uploads/users/IDs/2/17528540310_SE2_2022-2023-2.pdf"),
            //         storage_path("uploads/users/IDs/2/17528540310_SE2_2022-2023-2.pdf"),
            //         true
            //     )
            // ],
            'phone_number' => $this->faker->phoneNumber(),
            'salary' => $this->faker->optional()->numberBetween(2000, 10000),
            'birth_date' => $this->faker->optional()->date(),
            'gender' => $this->faker->optional()->randomElement(['male', 'female']),
            'email_verified_at' => now(),
            'address' => $this->faker->optional()->address(),
            'remember_token' => Str::random(10),
        ];
    }

    // State 
    public function student()
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'student',
            'password' => null,
        ])->afterCreating(function (User $user) {
            Student::factory()->create(array_merge(
                ['user_id' => $user->id],
                Student::factory()->definition()
            ));


            $user->assignRole('student');
        });
    }

    public function teacher()
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'teacher',
            'password' => null,
        ])->afterCreating(function (User $user) {
            // إنشاء سجل teacher مرتبط بالـ User
            Teacher::factory()->create(array_merge(
                ['user_id' => $user->id],
                Teacher::factory()->definition()
            ));

            // تعيين الدور في Spatie
            $user->assignRole('teacher');
        });
    }

    // State 
    public function supervisor()
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'supervisor',
            'password' => null,
        ])->afterCreating(function (User $user) {
            Supervisor::factory()->create(array_merge(
                Supervisor::factory()->definition(),
                ['user_id' => $user->id]
            ));
            $user->assignRole('supervisor');
        });
    }
    // 'admin', 'teacher', 'supervisor', 'student', 'parent', 'librarian'
    // State لأدوار أخرى بدون جدول فرعي
    public function admin()
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'admin',
            'password' => 'Admin123Admin',
        ])->afterCreating(function (User $user) {
            $user->assignRole('admin');
        });
    }
    // State لأدوار أخرى بدون جدول فرعي
    public function parent()
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'parent',
            'password' => null,
        ])->afterCreating(function (User $user) {
            $user->assignRole('parent');
        });
    }
    public function librarian()
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'librarian',
            'password' => null,
        ])->afterCreating(function (User $user) {
            $user->assignRole('librarian');
        });
    }
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
