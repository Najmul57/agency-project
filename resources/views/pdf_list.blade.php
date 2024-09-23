<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF List</title>
</head>

<body>
    <div>
        <h1>PDF List</h1>
        @foreach ($pdfData as $pdf)
            <div>
                <h3>{{ $pdf->name }}</h3>
                <a href="{{ route('payment.serve', ['id' => $pdf->id]) }}" target="_blank">View PDF</a>
            </div>
        @endforeach
    </div>
</body>

</html>
