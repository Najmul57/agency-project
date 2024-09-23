<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap');
    </style>
    <style>
        * {
            margin: 0;
            padding: 0;
            outline: none;
            box-sizing: border-box;
            font-size: 14px;
            font-family: 'Roboto Slab', serif;
        }

        .page {
            background-color: white;
            display: block;
            margin: 0 auto;
            position: relative;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        }

        .page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            position: relative;
        }

        ul {
            padding: 0;
            margin: 0;
        }

        li {
            list-style: none;
        }

        .customer__info ul li {
            float: left;
            margin-bottom: 5px;
            width: 50%;
        }

        .customer__info ul li h4 {
            font-size: 18px;
            font-weight: 500;
        }

        .customer__info ul li h4 span {
            font-weight: normal;
            font-size: 18px;
        }

        .customer__info {
            padding: 35px 45px;
            padding-top: 15px;
        }

        .invoice__body {
            padding-top: 170px;
        }


        .table__space {
            padding: 40px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            text-align: center;
            border-collapse: collapse;
            padding: 5px;
        }

        .my-page {
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat
        }

        .invoice__body h1 {
            text-transform: uppercase;
            margin-left: 48px;
            font-size: 40px;
            font-weight: 800;
        }

        .my-page {
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <div class="my-page page" size="A4">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('backend/assets/images/pad.jpg'))) }}"
            style="width: 100%" alt="Image">
        <div class="invoice__body" style="width: 100%; position: absolute;top:0;left:0">

            <div id="qr_code" style="position: absolute;right:40px;top:0;padding-right:10px;padding-top:10px">
                <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code" style="max-width: 80px;">
            </div>

            <h1>invoice</h1>
            @php
                $currentDate = date('M-j-Y');
            @endphp
            <div style="position: absolute;right:80px;top:15%">
                <p style="margin-bottom: 5px"><strong style="width: 80px;display:inline-block">Date</strong>
                    :
                    <?= $currentDate ?>
                </p>
                <p style="margin-bottom: 5px"><strong style="width: 80px;display:inline-block">Ref No</strong>:
                    {{ $admissionLetter->referanceId }}
                </p>
                <p><strong style="width: 80px;display:inline-block">Receipt
                        No</strong>: SIAC-{{ date('Y') }}{{ $admissionLetter->id }}</p>
            </div>

            <div class="customer__info">
                <h2 style="font-size: 20px;margin-bottom:0">To</h2>
                <h4 style="font-size: 25px;font-weight:normal;margin-bottom:10px">{{ $admissionLetter->user->name }}
                </h4>

                <p><span style="width: 100px;display:inline-block">Phone Number </span>
                    : {{ $admissionLetter->user->phone }}
                </p>
                <p><span style="width: 100px;display:inline-block"> Email Id </span> :
                    {{ $admissionLetter->user->email }}</p>
                <p><span style="width: 100px;display:inline-block">Address </span> :
                    {{ $admissionLetter->user->address }}
                </p>
                <p><span style="width: 100px;display:inline-block">University ID </span> :
                    {{ $admissionLetter->universityId }}</p>
            </div>

            <div class="table__pricing" style="margin-left: 80px;max-width:620px;width:100%">
                <div style="width:33.33%;float:left">
                    <h3 style="background: #2661AC;padding:5px;color:white;text-align:center">DESCRIPTION</h3>
                    <div>
                        <h6 style="background:#BDC7D5;padding:5px;font-weight:normal;margin-top:10px;font-size:14px">
                            Admission Fees</h6>
                        <h6 style="background:#BDC7D5;padding:5px;font-weight:normal;margin-top:10px;font-size:14px">
                            Tuition Fees</h6>
                        <h6 style="background:#BDC7D5;padding:5px;font-weight:normal;margin-top:10px;font-size:14px">
                            Other Fees</h6>
                        <h5
                            style="background:#2661AC;padding:5px;font-weight:bolder;margin-top:10px; color:white;font-size:14px">
                            GRAND TOTAL </h5>
                    </div>
                </div>
                <div style="width:33.33%;float:left">
                    <h3 style="background: #2661AC;padding:5px;color:white">
                        <h6 style="opacity: 0">siac</h6>
                    </h3>
                    <div style="text-align: center;margin-top:40px">
                        <p style="color: #3493DD">Payment Received For</p>
                        <h6 style="text-transform:uppercase;padding:10px 0;font-size:12px">
                            {{ $admissionLetter->user->course->name }}
                        </h6>
                        <h3 style="font-size: 16px">{{ ucwords($admissionLetter->user->premiumUniversity->name) }}</h3>
                    </div>
                </div>
                <div style="width:33.33%;float:left">
                    <h3 style="background: #2661AC;padding:5px;color:white;text-align:center">TOTAL</h3>
                    <div>
                        <!-- Individual fees -->
                        <p style="background:#BDC7D5;padding:5px;font-weight:normal;margin-top:10px;font-size:14px">
                            Admission Fee: {{ $admissionLetter->admissionFees }} INR</p>
                        <p style="background:#BDC7D5;padding:5px;font-weight:normal;margin-top:10px;font-size:14px">
                            Tuition Fee: {{ $admissionLetter->tuitionFees }} INR</p>
                        <p style="background:#BDC7D5;padding:5px;font-weight:normal;margin-top:10px;font-size:14px">
                            Others Fee: {{ $admissionLetter->otherFees }} INR</p>

                        <!-- Total amount -->
                        @php
                            function convertNumberToWords($number)
                            {
                                $words = [
                                    0 => 'zero',
                                    1 => 'one',
                                    2 => 'two',
                                    3 => 'three',
                                    4 => 'four',
                                    5 => 'five',
                                    6 => 'six',
                                    7 => 'seven',
                                    8 => 'eight',
                                    9 => 'nine',
                                    10 => 'ten',
                                    11 => 'eleven',
                                    12 => 'twelve',
                                    13 => 'thirteen',
                                    14 => 'fourteen',
                                    15 => 'fifteen',
                                    16 => 'sixteen',
                                    17 => 'seventeen',
                                    18 => 'eighteen',
                                    19 => 'nineteen',
                                    20 => 'twenty',
                                    30 => 'thirty',
                                    40 => 'forty',
                                    50 => 'fifty',
                                    60 => 'sixty',
                                    70 => 'seventy',
                                    80 => 'eighty',
                                    90 => 'ninety',
                                ];

                                if ($number < 21) {
                                    return $words[$number];
                                }

                                if ($number < 100) {
                                    $units = $number % 10;
                                    $tens = floor($number / 10) * 10;

                                    $word = $words[$tens];
                                    if ($units > 0) {
                                        $word .= '-' . $words[$units];
                                    }

                                    return $word;
                                }

                                if ($number < 1000) {
                                    $hundreds = floor($number / 100);
                                    $remainder = $number % 100;

                                    $word = $words[$hundreds] . ' hundred';
                                    if ($remainder > 0) {
                                        $word .= ' and ' . convertNumberToWords($remainder);
                                    }

                                    return $word;
                                }

                                if ($number < 100000) {
                                    $thousands = floor($number / 1000);
                                    $remainder = $number % 1000;

                                    $word = convertNumberToWords($thousands) . ' thousand';
                                    if ($remainder > 0) {
                                        $word .= ' ' . convertNumberToWords($remainder);
                                    }

                                    return $word;
                                }

                                if ($number < 10000000) {
                                    $lakhs = floor($number / 100000);
                                    $remainder = $number % 100000;

                                    $word = convertNumberToWords($lakhs) . ' lakh';
                                    if ($remainder > 0) {
                                        $word .= ' ' . convertNumberToWords($remainder);
                                    }

                                    return $word;
                                }

                                if ($number < 1000000000) {
                                    $crores = floor($number / 10000000);
                                    $remainder = $number % 10000000;

                                    $word = convertNumberToWords($crores) . ' crore';
                                    if ($remainder > 0) {
                                        $word .= ' ' . convertNumberToWords($remainder);
                                    }

                                    return $word;
                                }
                            }

                            $totalAmount =
                                $admissionLetter->admissionFees +
                                $admissionLetter->tuitionFees +
                                $admissionLetter->otherFees;
                            $totalAmountInWords = convertNumberToWords($totalAmount);
                        @endphp

                        <p id="amount"
                            style="background:#2661AC;padding:5px;font-weight:normal;margin-top:10px; color:white;font-size:14px">
                            Total Amount: {{ $totalAmount }} INR
                        </p>
                        <h5 style="margin-top: 30px;width:100%;text-transform: capitalize;">{{ $totalAmountInWords }}
                            INR only</h5>
                    </div>

                </div>
            </div>

            <div style="margin-top: 400px;padding: 0 55px;">
                <h2 style="color: #2661AC;font-size: 20px;">Term and Conditions :</h2>
                <p style="font-size: 11px;"> Study International Admission Care gives suggestions to students for
                    studying abroad. SIAC will not be responsible for any kind of wrong decision or wrong activities
                    by the student at present and in the future. and also, we do not have any refund policy after
                    reporting the student. ..</p>
                <p style="text-align: center;color: #ff2d2d;font-size: 10px;"> The Fees Deposited is Non-Refundable,
                    Non-Transferable as per the rules of SIAC</p>
            </div>

            <div style="margin-top: 50px;padding: 0 55px;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('upload/authorsignature/' . $setting->signature))) }}"
                    alt="">

                <h2 style="color: #2661AC;font-size: 20px;"> Authorized Signature </h2>
            </div>

            <div class="footer" style="margin-top: 53px;text-align: center;">
                <p style="color: white;font-size: 10px;">Office: Kadamtola Bazar, Satkhira Sadar Satkhira-9400</p>
                <p style="color: white;font-size: 10px;">Email: siacadmission@gmail.com, Phone: +8801786-067794,
                    +8801797-874204, Web: www.siacabroad.com</p>
                <p style="color: white;font-size: 10px;">This payment receipt is very confidential and only shared with
                    university/channel partner. Please don’t share with anyone else. This payment receipt is Issued as
                    per Rules Regulation of SIAC Consultancy</p>
            </div>
        </div>
    </div>
</body>

</html>
