<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer Letter Details</title>

</head>

<body>
    <div class="container">
        <h2>Offer Letter {{ ucfirst($offerletter->name) }} Documents Details</h2>
        <h4><strong>Full Name:</strong> {{ ucfirst($offerletter->name) }}</h4>
        <h4><strong>Mohter's Name:</strong> {{ ucfirst($offerletter->m_name) }}</h4>
        <h4><strong>Father's Name:</strong> {{ ucfirst($offerletter->f_name) }}</h4>
        <h4><strong>Date of Birth:</strong> {{ ucfirst($offerletter->dob) }}</h4>

        <?php
        $unicoursename = \App\Models\PrimiumUniversityCourse::find($offerletter->regis__uni__course)->name ?? 'Unknown';
        ?>
        <h4><strong>Subject:</strong> {{ ucfirst($unicoursename) }}</h4>

        <h4><strong>Email:</strong> {{ ucfirst($offerletter->email) }}</h4>
        <h4><strong>City:</strong> {{ ucfirst($offerletter->city) }}</h4>
        <h4><strong>Phone:</strong> {{ ucfirst($offerletter->phone) }}</h4>
        <h4><strong>Address:</strong> {{ ucfirst($offerletter->address) }}</h4>

    </div>
</body>

</html>
