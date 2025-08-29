<?php

namespace App\Console\Commands;

use App\Helpers\HelpersFunctions;
use App\Models\Report;
use App\Models\Teacher;
use App\Models\User;
use App\Notifications\TeacherReportNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;

class GenerateTeachersReport extends Command
{
    protected $signature = 'report:teacher';
    protected $description = 'Generate monthly Teacher PDF report';
    private function  getLeaves($teacher, $month)
    {
        return $teacher->user->leaves()
            ->whereMonth('leave_date', Carbon::parse($month)->month)
            ->whereYear('leave_date', Carbon::parse($month)->year)
            ->get()->map(function ($leave) {
                return [
                    'leave_date' => $leave->leave_date->toDateString(),
                    'period' => $leave->period,
                    'leave_type' => $leave->type,
                    'status' => $leave->status,
                    'notes' => $leave->notes,
                ];
            });
    }
    private function  getActivities($teacher, $month)
    {
        return $teacher->user->activities()
            ->whereMonth('date', Carbon::parse($month)->month)
            ->whereYear('date', Carbon::parse($month)->year)
            ->get()->map(function ($activity) {
                return [
                    'activity_name' => $activity->name,
                    'payment_status' => $activity->is_paid ? 'paid' : 'free_activity',
                    'attendance' => $activity->pivot->attendance ?? false,
                ];
            });
    }
    private function  getStatusChanges($teacher)
    {
        return $teacher->only(['Payment_type', 'Contract_type', 'Employment_status']);
    }
    public function handle()
    {
        $teachers = Teacher::with(['user', 'subject'])->get();
        $month = Carbon::now()->format('Y-m');
        $report_data = collect();
        foreach ($teachers as $teacher) {
            $report_data->push([
                "Teacher_name" => $teacher->user->name,
                "subject_name" => $teacher->subject->name,
                "report_month" => Carbon::now()->format('Y-m'),
                "leaves" => $this->getLeaves($teacher, $month),
                "activities" => $this->getActivities($teacher, $month),
                "StatusChanges" => $this->getStatusChanges($teacher),
            ]);
        }
        $html = view('reports.teacher_report', compact('report_data'))->render();
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
        $filename = 'Teacher_Report_' . now()->format('Y-m') . '.pdf';
        $public_path = public_path('reports/TeacherReports');
        if (!file_exists($public_path)) {
            mkdir($public_path, 0755, true);
        }
        $file_path  = $public_path . '/' . $filename;
        // save pdf file in public 
        file_put_contents($file_path, $mpdf->Output('', 'S'));
        // getting related User 
        $users = User::whereIn('role', ['admin', 'supervisor'])->get();
        // Save Url  
        $relativeUrl = 'reports/TeacherReports/' . $filename;
        // Sending Notifications To Users 
        Notification::send($users, new TeacherReportNotification($relativeUrl));
        // store Report in DataBase 
        $report = new Report();
        $report->report_type = 'teachers';
        $report->term_id = HelpersFunctions::getCurrentTermId();
        $report->report_url = $relativeUrl;
        $report->report_description = "teachers Report For Year : " . now()->year() . " Month :  " . now()->month();
        $report->report_date = now()->format('Y-m'); // 'F Y'
        $report->save();
    }
}
