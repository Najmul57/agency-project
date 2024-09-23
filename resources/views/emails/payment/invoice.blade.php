<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        p {
            margin: 0;
            padding: 0;
        }

        .wrapper {
            max-width: 800px;
            margin: auto;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            padding: 20px;
            border-radius: 10px;
        }

        .payment_table th,
        .payment_table tr,
        .payment_table td,
        .payment_table {
            border: 1px solid #000;
            text-align: left;
            padding: 8px;
        }

        .received {
            position: absolute;
            font-size: 60px;
            z-index: -1;
            color: #ddd;
            top: 40%;
            transform: rotate(-62deg);
            left: 16%;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="info" style="position: relative;">

            <?php
            $pdfRoute = 'payment';
            ?>

            <div id="qr_code" style="position: absolute;right:-40px;top:-40px">
                <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?= urlencode($pdfRoute) ?>&size=200x200"
                    alt="QR Code" style="max-width: 100px;">
            </div>

            <table style="width: 100%">
                <tr>
                    <td style="width: 400px">
                        <div class="logo" style="width: 100%">
                            <h1 style="width: 300px;font-size:40px"><strong>SIAC Abroad</strong></h1>
                        </div>
                    </td>
                    <td style="text-align: end">
                        <p><strong>SIAC Abroad</strong></p>
                        <p>www.siacabroad.com</p>
                        <p><strong>{{ $setting->main_email }}</strong></p>
                        <p><strong>{{ $setting->support_email }}</strong></p>
                        <p>{{ $setting->phone_one }}, {{ $setting->phone_two }}</p>
                    </td>
                </tr>
            </table>
            <table style="width: 100%;margin-bottom: 20px;">
                <tr>
                    <td>
                        <div class="student_info">
                            <h3>Student Details</h3>
                            <p><strong>Name:</strong>{{ ucfirst($paymentData['name']) }}</p>
                            <p><strong>Email: </strong>{{ $paymentData['email'] }}</p>
                            <p><strong>Phone: </strong>{{ $paymentData['number'] }}</p>
                        </div>
                    </td>
                    <td>
                        <div class="invoice_info">
                            <p><strong>Invoice Date:
                                </strong>{{ date('F j, Y', strtotime($paymentData['created_at'])) }}</p>
                            <p><strong>Ref No: </strong>{{ $paymentData['phone'] }}</p>
                            <p><strong>Invoice No: </strong>{{ $paymentData['receipt_id'] }}</p>
                        </div>
                    </td>
                </tr>
            </table>

            <table style="width: 100%;" class="payment_table">
                <tr>
                    <th style="width: 5%;">SL</th>
                    <th style="width: 80%;">Purpose of Payment</th>
                    <th style="width: 15%;">Payment</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>
                        <h3 style="margin: 0;"><strong>{{ $paymentData['display_type'] }}</strong></h3>
                        <p><strong>University : </strong> {{ $paymentData['university_name'] }}</p>
                        <p><strong>Fees :</strong> {{ $paymentData['display_amount'] }}</p>
                    </td>
                    <td>{{ $paymentData['display_amount'] }}</td>
                </tr>
                <tr>
                    <td style="text-align: end;" colspan="2"><strong>Subtotal : </strong></td>
                    <td style="text-align: left;">{{ $paymentData['display_amount'] }}</td>
                </tr>
                <tr>
                    <td style="text-align: end;" colspan="2"><strong>Total : </strong></td>
                    <td style="text-align: left;">{{ $paymentData['display_amount'] }}</td>
                </tr>
            </table>

            <div class="payment_method" style="margin: 30px 0;">
                <p><strong>Payment Method : </strong>{{ $paymentData['payment_method_item'] }}</p>
                <p><strong>Transition ID : </strong>{{ $paymentData['txt_number'] }}</p>
            </div>

            <div class="received">
                Received
            </div>
            <div class="footer">
                <p>This Payment Non-Refundable. Maybe Can Adjusment as per the SIAC Rules</p>
                <h3><strong>Thank You.</strong></h3>
            </div>
        </div>
    </div>
</body>

</html>
