<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Teachers Monthly Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            direction: rtl;
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #333;
        }

        th,
        td {
            padding: 8px;
            font-size: 13px;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <h1>تقرير المدرسين الشهري - {{ now()->format('F Y') }}</h1>

    <table>
        <thead>
            <tr>
                <th>اسم المدرس</th>
                <th>المادة</th>
                <th>الشهر</th>
                <th>الإجازات</th>
                <th>الأنشطة</th>
                <th>تغييرات الحالة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report_data as $report)
            <tr>
                <td>{{ $report['Teacher_name'] }}</td>
                <td>{{ $report['subject_name'] }}</td>
                <td>{{ $report['report_month'] }}</td>
                <td>
                    @if(!empty($report['leaves']))
                    <ul>
                        @foreach($report['leaves'] as $leave)
                        <li>{{ $leave }}</li>
                        @endforeach
                    </ul>
                    @else
                    لا يوجد
                    @endif
                </td>
                <td>
                    @if(!empty($report['activities']))
                    <ul>
                        @foreach($report['activities'] as $activity)
                        <li>{{ $activity }}</li>
                        @endforeach
                    </ul>
                    @else
                    لا يوجد
                    @endif
                </td>
                <td>
                    @if(!empty($report['StatusChanges']))
                    <ul>
                        @foreach($report['StatusChanges'] as $status)
                        <li>{{ $status }}</li>
                        @endforeach
                    </ul>
                    @else
                    لا يوجد
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>