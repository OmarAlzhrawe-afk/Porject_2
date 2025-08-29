<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Activity_participants;
use App\Models\Class_room;
use App\Models\Education_level;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityParticipantsTableSeeder extends Seeder
{
    public function run()
    {
        $activities = Activity::all();
        $users = User::all();
        if ($activities->count() == 0 || $users->count() == 0) {
            $this->command->warn("لا يوجد أنشطة أو مستخدمين لإنشاء مشاركين.");
            return;
        }
        foreach ($activities as $activity) {
            $userIds = collect();
            if ($activity->class_room_id) {
                $class = Class_room::with(['students.user', 'sessions.teacher.user'])
                    ->find($activity->class_room_id);
                $students = $class->students->pluck('user_id')->unique();
                $teachers = $class->sessions->pluck('teacher.user_id')->unique();
                $userIds = $students->merge($teachers);
            } elseif ($activity->education_level_id) {
                $level = Education_level::with(['classes.students', 'classes.sessions.teacher'])
                    ->find($activity->education_level_id);
                $students = $level->classes->flatMap->students->pluck('user_id')->unique();
                $teachers = $level->classes->flatMap->sessions->pluck('teacher.user_id')->unique();
                $userIds = $students->merge($teachers);
            } else {
                $userIds = User::inRandomOrder()->take(rand(5, 15))->pluck('id');
            }
            foreach ($userIds as $userId) {
                Activity_participants::create([
                    'activity_id' => $activity->id,
                    'user_id' => $userId,
                    'payment_status' => fake()->randomElement(['pending', 'paid', 'cancelled', 'free_activity']),
                    'attendance' => fake()->boolean(),
                    'payment_reference' => fake()->optional()->uuid(),
                    'payment_method' => fake()->optional()->randomElement(['cash', 'OnLine']),
                    'notes' => fake()->optional()->sentence(),
                ]);
            }
        }
    }
}
