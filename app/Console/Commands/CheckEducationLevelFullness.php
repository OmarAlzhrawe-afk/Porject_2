<?php

namespace App\Console\Commands;

use App\Models\Education_level;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckEducationLevelFullness extends Command
{

    protected $signature = 'educationlevel:checkfully';

    protected $description = 'Check if all classes in an education level are fully and mark the level as fully';

    public function handle()
    {
        $levels = Education_level::with('classes')->get();
        foreach ($levels as $level) {
            if ($level->classes->isEmpty() || $level->is_fully == true) {
                continue;
            }
            $all_classes_is_fully = $level->classes->every(function ($class) {
                return $class->capacity == $class->current_count;
            });
            if ($all_classes_is_fully) {
                $level->is_fully = $all_classes_is_fully;
                $level->save();
            }
        }
        Log::info("Education level ID {$level->id} updated to is_fully: " . ($all_classes_is_fully ? 'true' : 'false'));
        $this->info('Education checked and Update If Nessesary');
    }
}
