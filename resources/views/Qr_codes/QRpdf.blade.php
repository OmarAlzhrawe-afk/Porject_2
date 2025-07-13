<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Code FOr Class {{$class_name}} </title>
    <style>
        body {
            text-align: center;
            font-family: sans-serif;
        }
        .qr-box {
            margin-top: 50px;
            background-color: white;
        }
    </style>
</head>
<body>
    <h1>QR Code FOr Class {{$class_name}} </h1>
    <h2>Teacher Please Scan THe QR Code To assign Attendance</h2>
    <div class="qr-box">
      <h1>QR Code</h1>
    <img src="{{$image }}" alt="QR Code">
    </div>
    </body>
</html>