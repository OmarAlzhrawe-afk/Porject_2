<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Text_book;
use App\Models\Education_level;

class TextBookSeeder extends Seeder
{
    public function run()
    {
        $subjects = Subject::all();
        $levels = Education_level::all();
        $books = [];

        foreach ($levels as $level) {
            foreach ($subjects as $subject) {
                $totalQuantity = rand(20, 100);
                $soldQuantity = rand(0, $totalQuantity);

                $books[] = [
                    'subject_id' => $subject->id,
                    'education_level_id' => $level->id,
                    'title' => fake()->title(),
                    'total_quantity' => $totalQuantity,
                    'sold_quantity' => $soldQuantity,
                    'available_quantity' => $totalQuantity - $soldQuantity,
                    'price' => rand(5, 50),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        foreach (array_chunk($books, 50) as $chunk) {
            Text_book::insert($chunk);
        }
    }
}
