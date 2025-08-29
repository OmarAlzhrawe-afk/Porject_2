<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تقرير مالي للشهر الحالي</title>
    <style>
        body {
            font-family: DejaVuSans, sans-serif;
            direction: rtl;
            margin: 20px;
            color: #333;
        }
        h1, h2 {
            text-align: center;
        }
        .summary {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
        }
        .summary div {
            padding: 10px 20px;
            border-radius: 8px;
            color: #fff;
            font-weight: bold;
            width: 200px;
            text-align: center;
        }
        .income {
            background-color: #4CAF50; /* أخضر */
        }
        .expenses {
            background-color: #F44336; /* أحمر */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: center;
            font-size: 13px;
        }
        th {
            background-color: #1976D2; /* أزرق */
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #e3f2fd;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>

<h1>تقرير مالي شهري</h1>
<h2>الشهر الحالي: {{ now()->format('F Y') }}</h2>

<div class="summary">
    <div class="income">إجمالي المال الداخل: {{ number_format($totalIn, 2) }} $</div>
    <div class="expenses">إجمالي المال الخارج: {{ number_format($totalOut, 2) }} $</div>
</div>

<table>
    <thead>
        <tr>
            <th>التاريخ</th>
            <th>الموظف / الطالب</th>
            <th>المبلغ</th>
            <th>نوع العملية</th>
            <th>مصدر العملية</th>
            <th>طريقة الدفع</th>
            <th>رقم القسط / المرجع</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $transaction)
        <tr>
            <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
            <td>{{ $transaction->user->name ?? '-' }}</td>
            <td>{{ number_format($transaction->amount, 2) }}</td>
            <td>{{ $transaction->type == 'in' ? 'وارد' : 'صادر' }}</td>
            <td>{{ $transaction->transaction_source }}</td>
            <td>{{ $transaction->payment_method }}</td>
            <td>
                @if($transaction->is_installment)
                    قسط رقم {{ $transaction->installment_number }}
                @else
                    {{ $transaction->payment_reference ?? '-' }}
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    تم إنشاء التقرير بواسطة نظام إدارة المدرسة - {{ now()->format('d/m/Y H:i') }}
</div>

</body>
</html>