<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تقرير المكتبة</title>
    <style>
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
    </style>
</head>
<body>

    <div class="logo">
        <img src="{{ public_path('appLogo.png') }}" height="60">
    </div>

    <h2>📚 تقرير مبيعات وإعارات المكتبة - {{ now()->format('Y-m') }}</h2>

    {{-- 🟢 جدول مبيعات الكتب --}}
    <h3>📘 مبيعات الكتب:</h3>
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
    <h3>📗 إعارات الكتب:</h3>
    <table>
        <thead>
            <tr>
                <th>اسم المستخدم</th>
                <th>اسم الكتاب</th>
                <th>ملاحظات</th>
                <th>مدة الإعارة</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td>{{ $loan['user'] ?? 'غير معروف' }}</td>
                    <td>{{ $loan['book'] ?? 'غير معروف' }}</td>
                    <td>{{ $loan['notes'] ?? 'غير معروف' }}</td>
                    <td>{{ $loan['duration'] ?? 'غير معروف' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
