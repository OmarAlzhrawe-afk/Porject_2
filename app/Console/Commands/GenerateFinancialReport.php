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
use App\Models\Transaction;
use App\Notifications\FinancialReportNotification;
use App\Notifications\TeacherReportNotification;
use Carbon\Carbon;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Notification;

class GenerateFinancialReport extends Command
{

    protected $signature = 'report:financial';
    protected $description = 'Mention all Transactions On month';
    public function handle()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // 
        $transactions = Transaction::where('status', 'paid')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->orderBy('created_at', 'asc')
            ->get();

        // 
        $totalIn = $transactions->where('type', 'in')->sum('amount');

        // 
        $totalOut = $transactions->where('type', 'out')->sum('amount');
        // generate Html & pdf File 
        $html = view('reports.financial', compact(['transactions', 'totalOut', 'totalIn']))->render();
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
        $filename = 'financial_report_' . now()->format('Y-m') . '.pdf';
        $public_path = public_path('reports/FinancialReports');
        if (!file_exists($public_path)) {
            mkdir($public_path, 0755, true);
        }
        $file_path  = $public_path . '/' . $filename;
        // save pdf file in public 
        file_put_contents($file_path, $mpdf->Output('', 'S'));
        // getting related User 
        $users = User::where('role', 'admin')->get();
        // Save Url  
        $relativeUrl = 'reports/FinancialReports/' . $filename;
        // Sending Notifications To Users 
        Notification::send($users, new FinancialReportNotification($relativeUrl));
        // store Report in DataBase 
        $report = new Report();
        $report->report_type = 'financial_transactions';
        $report->term_id = HelpersFunctions::getCurrentTermId();
        $report->report_url = $relativeUrl;
        $report->report_description = "Financial Report For Year : " . now()->year() . " Month :  " . now()->month();
        $report->report_date = now()->format('Y-m');
        $report->save();
    }
}
