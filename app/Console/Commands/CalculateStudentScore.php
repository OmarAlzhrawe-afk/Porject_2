<?php

namespace App\Console\Commands;

use App\Helpers\HelpersFunctions;
use App\Models\Mark;
use App\Models\Student;
use Illuminate\Console\Command;

class CalculateStudentScore extends Command
{
    protected $signature = 'students:calculate-scores';
    protected $description = 'Calculate students scores for each term and update Student_profile';

    public function handle()
    {
        // Get And Check If Term Is Exist
        $currentTermID = HelpersFunctions::getCurrentTermId();
        if (!$currentTermID) {
            $this->error("No current term found!");
            return;
        }
        // getting Students With marks and Profiles 
        $students = Student::with([
            'marks' => function ($query) use ($currentTermID) {
                $query->where('term_id', $currentTermID);
            },
            'profile'
        ])->get();
        // Determine The important for each typ eof mark type  
        $weights = [
            'final'    => 0.5,
            'midterm'  => 0.3,
            'quiz'     => 0.1,
            'homework' => 0.05,
            'activity' => 0.05,
        ];
        // looping in students
        foreach ($students as $student) {
            //getting students ids for looping in it 
            $subjects = $student->marks->pluck('subject_id')->unique();
            $subjectScores = [];
            // looping in subjects
            foreach ($subjects as $subjectId) {
                $weightedAvg = 0;
                // looping in types of mark for each subject
                foreach ($weights as $type => $weight) {
                    // grtting all marks of one type 
                    $marksOfType = $student->marks
                        ->where('subject_id', $subjectId)
                        ->where('exam_type', $type);
                    // if no marks for this type in subject
                    if ($marksOfType->isEmpty()) {
                        continue;
                    }

                    // convert max score to 100 in  mark
                    $percentages = $marksOfType->map(function ($mark) {
                        if ($mark->max_score > 0) {
                            return ($mark->score / $mark->max_score) * 100;
                        }
                        return 0;
                    });

                    // summing and calculate avg for type
                    $avgPercentage = $percentages->avg();

                    // summing to subjectscore and multiple with type weight
                    $weightedAvg += $avgPercentage * $weight;
                }

                $subjectScores[] = $weightedAvg;
            }

            // caculate final score by summing array of avg for student subjects
            $finalScore = collect($subjectScores)->avg() ?? 0;

            // updating student profile
            if ($student->profile) {
                $student->profile->score = $finalScore;
                $student->profile->save();
            }
        }

        $this->info("All students scores calculated successfully.");
    }
}
