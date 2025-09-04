<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تقرير المكتبة</title>
    {{-- <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            direction: rtl;
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
        }
        th {
            background-color: #f0f0f0;
        }
        h2 {
            text-align: center;
            margin-top: 0;
        }
        .logo {
            text-align: left;
            margin-bottom: 10px;
        }
    </style> --}}
    {{-- new Styling  --}}
      {{-- <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            direction: rtl;
            text-align: right;
            margin: 30px;
            background-color: #fafafa;
        }
        .logo {
            text-align: left;
            margin-bottom: 10px;
        }
        h1.report-title {
            text-align: center;
            font-size: 22px;
            margin: 0 0 20px 0;
            padding: 12px;
            background: #2c3e50;
            color: #fff;
            border-radius: 8px;
            letter-spacing: 1px;
        }
        h2.section-title {
            font-size: 18px;
            margin-top: 30px;
            margin-bottom: 10px;
            padding: 8px 12px;
            background: #3498db;
            color: #fff;
            border-radius: 6px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 30px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        tr:hover {
            background: #f1f1f1;
        }
        .total-row td {
            background: #ecf0f1;
            font-weight: bold;
        }
    </style> --}}
    {{-- New New Styling --}}
    <style>
    body {
        font-family: DejaVu Sans, sans-serif;
        line-height: 1.6;
        direction: rtl;
    }

    h2 {
        text-align: center;
        background-color: #f5f5f5;
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 25px;
        color: #333;
    }

    h3 {
        padding: 10px;
        margin: 20px 0 10px 0;
        border-right: 6px solid #4CAF50; /* لون مختلف لكل قسم */
        background-color: #e8f5e9;
        border-radius: 6px;
        color: #2e7d32;
    }

    .sales-section h3 {
        border-right-color: #2196F3;
        background-color: #e3f2fd;
        color: #1565c0;
    }

    .loans-section h3 {
        border-right-color: #FF9800;
        background-color: #fff3e0;
        color: #e65100;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        margin-bottom: 25px;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 8px 12px;
        text-align: center;
    }

    table th {
        background-color: #f1f1f1;
        color: #333;
    }

    table tr:nth-child(even) {
        background-color: #fafafa;
    }
</style>
</head>
<body>

    <div class="logo">
        <img src="{{ public_path('appLogo.png') }}" height="60">
    </div>

    <h2> تقرير مبيعات وإعارات المكتبة - {{ now()->format('Y-m') }}</h2>

    {{-- 🟢 جدول مبيعات الكتب --}}
    <h3> مبيعات الكتب:</h3>
    <table>
        <thead>
            <tr>
                <th>اسم الطالب</th>
                <th>اسم الكتاب</th>
                <th>السعر</th>
                <th>تاريخ البيع</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale['student'] }}</td>
                    <td>{{ $sale['book'] }}</td>
                    <td>{{ $sale['price'] }} $</td>
                    <td>{{ $sale['date'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2"><strong>الإجمالي:</strong></td>
                <td colspan="2"><strong>{{ $totalSales }} $</strong></td>
            </tr>
        </tbody>
    </table>

    {{-- 🟢 جدول إعارات الكتب --}}
    <h3> إعارات الكتب:</h3>
    <table>
        <thead>
            <tr>
                <th>اسم المستخدم</th>
                <th>اسم الكتاب</th>
                <th>حالة الأرجاع</th>
                <th>مدة الإعارة</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td>{{ $loan['user'] ?? 'غير معروف' }}</td>
                    <td>{{ $loan['book'] ?? 'غير معروف' }}</td>
                    <td>{{ $loan['Loan_Status'] ?? 'غير معروف' }}</td>
                    <td>{{ $loan['duration'] ?? 'غير معروف' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
