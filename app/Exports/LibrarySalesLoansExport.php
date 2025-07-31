<?php

namespace App\Exports;

use App\Models\Book_loan;
use App\Models\Student_textbook_sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class LibrarySalesLoansExport implements
    FromCollection,
    WithTitle,
    WithEvents,
    WithHeadings,
    WithCustomStartCell,
    WithDrawings
{

    public function collection()
    {
        // 🟢 إحضار مبيعات الكتب
        $sales = Student_textbook_sale::with(['student.user', 'book'])->get();

        $salesData = $sales->map(function ($sale) {
            return [
                'type' => 'Sale',
                'student' => $sale->student->user->name ?? 'غير معروف',
                'book' => $sale->textbook->title ?? 'غير معروف',
                'notes_or_price' => $sale->total_price . ' $',
                'date_or_duration' => $sale->sale_date,
            ];
        });

        // 🟢 إحضار إعارات الكتب
        $loans = Book_loan::with(['user', 'book_loan'])->get();

        $loansData = $loans->map(function ($loan) {
            return [
                'type' => 'Loan',
                'student' => $loan->user->name ?? 'غير معروف',
                'book' => $loan->book_loan->title ?? 'غير معروف',
                'notes_or_price' => '—', // لا يوجد ملاحظات حالياً
                'date_or_duration' => '—', // لا يوجد مدة إعارة حالياً
            ];
        });

        $total = $sales->sum('total_price');

        $totalRow = collect([[
            'type' => 'Total Sales',
            'student' => '',
            'book' => '',
            'notes_or_price' => $total . ' $',
            'date_or_duration' => '',
        ]]);

        return $salesData
            ->merge($loansData)
            ->merge($totalRow);
    }

    public function headings(): array
    {
        return ['Type', 'Student Name', 'Book Title', 'Price/Notes', 'Date/Duration'];
    }

    public function startCell(): string
    {
        return 'A3';
    }


    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                // get object of sheet to edit it

                $sheet = $event->sheet->getDelegate();

                // merge many cells in one for write title 
                $sheet->mergeCells('A1:D1');
                // write title 
                $sheet->setCellValue('A1', '📚 Library Sales and Loans Report - ' . now()->format('Y-m-d'));
                // make unique format for title
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
            },
        ];
    }
    public function title(): string
    {
        return '📚 Report For Library Activity IN Date :  ' . now()->format('Y-m-d');
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName(' Al-Awael ');
        $drawing->setDescription('School Logo');
        $drawing->setPath(public_path('appLogo.png')); // مسار الصورة
        $drawing->setHeight(60); // ارتفاع الصورة
        $drawing->setCoordinates('A1'); // مكان الصورة (الزاوية العلوية)

        return [$drawing];
    }
}
