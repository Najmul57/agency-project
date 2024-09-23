<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Define A4 size */
        @page {
            size: A4;
            margin: 0;
        }

        /* Set background image to cover entire page */
        body {
            background-image: url({{ asset('backend/assets/noc_pdf.jpg') }});
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>

    <div class="content">
        <div class="row">
            <div class="col-6">
                <p>Name: {{ $data->name }}</p>
            </div>
            <div class="col-6">
                <p>Father's Name: {{ $data->f_name }}</p>
            </div>
        </div>
        <!-- Add more content as needed -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
