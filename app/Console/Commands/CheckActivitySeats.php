<?php

namespace App\Console\Commands;

use App\Events\lockedActivity;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckActivitySeats extends Command
{

    protected $signature = 'activities:check-seats';
    protected $description = 'Close activities when participant count reaches seats limit Or date is greater than deadLine date';

    public function handle()
    {
        $activities1 = Activity::withCount('participants')
            ->where('is_open', true)
            ->whereNotNull('seats_limit')
            ->get();

        foreach ($activities1 as $activity) {
            if ($activity->participants_count >= $activity->seats_limit) {
                $activity->is_open = false;
                $activity->save();
                event(new lockedActivity($activity));
                Log::info("Activity ID {$activity->id} closed because seats limit reached.");
            }
        }
        $activities2 = Activity::where('registration_deadline', '<', Carbon::today());
        foreach ($activities2 as $activity) {
            $activity->is_open = false;
            $activity->save();
            event(new lockedActivity($activity));
            Log::info("Activity ID {$activity->id} closed because date Registeration Is Finish reached.");
        }
        $this->info('Activities checked and updated if needed.');
    }
}
