<?php

namespace Database\Factories;

use App\Models\Qr_Code;
use App\Models\Staff_attendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StaffAttendanceFactory extends Factory
{
    protected $model = Staff_attendance::class;

    public function definition()
    {
        $qr = Qr_Code::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();

        return [
            'QR_id' => $qr ? $qr->id : null,
            'user_id' => $user ? $user->id : null,
            'Attendance_status' => $this->faker->randomElement(['present', 'absent', 'justified']),
            'nots' => $this->faker->optional()->sentence(),
        ];
    }
}
