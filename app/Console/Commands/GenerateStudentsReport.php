<?php

namespace App\Console\Commands;

use App\Models\Activity_participants;
use App\Models\Class_room;
use App\Models\Installment_payment;
use App\Models\Student_attendance;
use App\Models\User;
use Illuminate\Console\Command;
use App\Helpers\HelpersFunctions;
use App\Models\Report;
use App\Notifications\TeacherReportNotification;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Notification;

class GenerateStudentsReport extends Command
{
    protected $signature = 'report:students';
    protected $description = 'Generate Report Descriping Status For all Students in School';

    public function handle()
    {
        $classes = Class_room::with(['students.user', 'students.profile'])->get();
        $report_data = collect();
        foreach ($classes as $class) {
            $student_data = collect();
            foreach ($class->students as $student) {
                $student_attendance  = Student_attendance::where('student_id', $student->id)
                    ->where('excused', true)
                    ->count();
                $student_abcence  = Student_attendance::where('student_id', $student->id)
                    ->where('excused', false)
                    ->count();
                $activities = Activity_participants::whereHas('activity', function ($q) {
                    $q->whereMonth('date', now()->month())->whereYear('date', now()->year());
                })
                    ->with('activity')
                    ->where('user_id', $student->user_id)
                    ->get()
                    ->pluck('activity.Title');
                $unpaid_installments = Installment_payment::where('student_id', $student->id)
                    ->where('paid', false)
                    ->get(['amount', 'due_date']);

                $student_data->push([
                    'name' => $student->user->name,
                    'attendance_days' => $student_attendance,
                    'absence_days' => $student_abcence,
                    'teacher_notes' => $student->profile?->teacher_feedback ?? '',
                    'activities' => $activities,
                    'unpaid_installments' => $unpaid_installments
                ]);
            }
            $report_data[$class->name] = $student_data; //$report_data[$class->name]->push($student_data);
        }
        $html = view('reports.students_report', compact('report_data'))->render();
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'L',
            'default_font' => 'dejavusans',
            'tempDir' => storage_path('app/temp'), // مجلد مؤقت
            'margin_top' => 10,
            'margin_left' => 10,
            'margin_right' => 10,
            'default_font_size' => 12
        ]);
        $mpdf->SetDirectionality('rtl');
        $mpdf->WriteHTML($html);
        // handle File path And store file in public path 
        $filename = 'Student_Report_' . now()->format('Y-m') . '.pdf';
        $public_path = public_path('reports/StudentReports');
        if (!file_exists($public_path)) {
            mkdir($public_path, 0755, true);
        }
        $file_path  = $public_path . '/' . $filename;
        // save pdf file in public 
        file_put_contents($file_path, $mpdf->Output('', 'S'));
        // getting related User 
        $users = User::whereIn('role', ['admin', 'supervisor'])->get();
        // Save Url  
        $relativeUrl = 'reports/StudentReports/' . $filename;
        // Sending Notifications To Users 
        Notification::send($users, new TeacherReportNotification($relativeUrl));
        // store Report in DataBase 
        $report = new Report();
        $report->report_type = 'students';
        $report->term_id = HelpersFunctions::getCurrentTermId();
        $report->report_url = $relativeUrl;
        $report->report_description = "students Report For Year : " . now()->year() . " Month :  " . now()->month();
        $report->report_date = now()->format('Y-m'); // 'F Y'
        $report->save();
        $this->info("Generating Student Report Done");
    }
}
