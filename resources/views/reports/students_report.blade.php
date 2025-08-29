<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تقرير الطلاب</title>
    <style>
        body {
            font-family: DejaVuSans, sans-serif;
            direction: rtl;
        }
        h1, h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 6px;
            text-align: center;
            font-size: 12px;
        }
        th {
            background-color: #f0f0f0;
        }
        .class-title {
            margin-top: 30px;
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>تقرير الطلاب - {{ now()->format('F Y') }}</h1>

@foreach($report_data as $className => $students)
    <div class="class-title">الصف: {{ $className }}</div>
    <table>
        <thead>
            <tr>
                <th>اسم الطالب</th>
                <th>أيام الحضور</th>
                <th>أيام الغياب</th>
                <th>ملاحظات المعلم</th>
                <th>الأنشطة</th>
                <th>الأقساط غير المدفوعة</th>
            </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student['name'] }}</td>
                <td>{{ $student['attendance_days'] }}</td>
                <td>{{ $student['absence_days'] }}</td>
                <td>{{ $student['teacher_notes'] }}</td>
                <td>
                    @if($student['activities']->count() > 0)
                        {{ $student['activities']->implode(', ') }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($student['unpaid_installments']->count() > 0)
                        @foreach($student['unpaid_installments'] as $inst)
                            {{ $inst->amount }} دولار - {{ $inst->due_date }} <br>
                        @endforeach
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endforeach

</body>
</html>