<?php

namespace App\Console\Commands;

use App\Helpers\HelpersFunctions;
use Illuminate\Console\Command;
use App\Models\Book_loan;
use App\Models\Report;
use App\Models\Student_textbook_sale;
use App\Models\User;
use App\Notifications\LibraryReportNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Notification;

class GenerateLibraryReport extends Command
{
    protected $signature = 'report:library';
    protected $description = 'Generate monthly library PDF report';

    public function handle()
    {
        $salesModels = Student_textbook_sale::with(['student.user', 'book'])->get();
        $loansModels = Book_loan::with(['user', 'book_loan'])->get();

        $sales = $salesModels->map(fn($sale) => [
            'student' => $sale->student->user->name ?? '-',
            'book' => $sale->textbook->title ?? '-',
            'price' => $sale->total_price,
            'date' => $sale->sale_date,
        ]);

        $loans = $loansModels->map(fn($loan) => [
            'user' => $loan->user->name ?? 'unKnown',
            'book' => $loan->book_loan->title ?? 'unKnown',
            'notes' => '—',
            'duration' => '—',
        ]);

        $totalSales = $salesModels->sum('total_price');

        $html = view('reports.library', compact('sales', 'loans', 'totalSales'))->render();
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
        $filename = 'Library_Report_' . now()->format('Y-m') . '.pdf';
        $public_path = public_path('reports/LibraryReports');
        if (!file_exists($public_path)) {
            mkdir($public_path, 0755, true);
        }
        $file_path  = $public_path . '/' . $filename;
        // save pdf file in public 
        file_put_contents($file_path, $mpdf->Output('', 'S'));
        // getting related User 
        $users = User::whereIn('role', ['admin', 'librarian'])->get();
        // Save Url  
        $relativeUrl = 'reports/libraryReports/' . $filename;
        // Sending Notifications To Users 
        Notification::send($users, new LibraryReportNotification($relativeUrl));
        // store Report in DataBase 
        $report = new Report();
        $report->report_type = 'library';
        $report->term_id = HelpersFunctions::getCurrentTermId();
        $report->report_url = $relativeUrl;
        $report->report_description = "Library Report For Year : " . now()->year() . " Month :  " . now()->month();
        $report->report_date = now()->format('Y-m'); // 'F Y'
        $report->save();
        // $mpdf->move(public_path('uploads/reprts/libraryreports'), $filename);
        $this->info("creating Report  " . $filename . "  Done ");
    }
}
