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
            top: 50%;
            transform: rotate(-62deg);
            left: 16%;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="info" style="position: relative;">

            <div id="qr_code" style="position: absolute;right:-40px;top:-40px">
                <?php $token = Str::random(6); ?>
                <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?= urlencode(route('payment.pdf', [$payment->id, $token]) . '.pdf') ?>&size=200x200"
                    alt="QR Code" style="max-width: 100px;">
            </div>

            <table style="width: 100%">
                <tr>
                    <td style="width: 400px">
                        <div class="logo" style="width: 100%">
                            <h1
                                style="width: 300px;font-size:40px;position: absolute;color:#22A8F8;top:-90px;left:200px">
                                <strong>Invoice</strong>
                            </h1>
                            <img
                                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('upload/logo/' . $setting->logo))) }}">
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
                            <p><strong>Name : </strong>{{ ucfirst($payment['name']) }}</p>
                            <p><strong>Email: </strong>{{ $payment['email'] }}</p>
                            <p><strong>Phone: </strong>{{ $payment['number'] }}</p>
                        </div>
                    </td>
                    <td>
                        @php
                            use Illuminate\Support\Carbon;
                        @endphp
                        <div class="invoice_info">
                            <p><strong>Invoice Date: </strong>{{ date('F j, Y', strtotime($payment['created_at'])) }}
                            </p>
                            <p><strong>Ref No: </strong>SIAC Abroad</p>
                            <p><strong>Invoice No: </strong>{{ str_replace('.pdf', '', $payment['receipt_id']) }}</p>
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
                        <h3 style="margin: 0;"><strong>{{ $payment['display_type'] }}</strong></h3>
                        <p><strong>University : </strong> {{ $payment['university_name'] }}</p>
                        <p><strong>Fees :</strong>
                            {{ isset($payment->display_amount) && $payment->display_amount !== '' ? $payment->display_amount : $payment->grand_total }}
                            BDT.
                        </p>
                    </td>
                    <td>{{ isset($payment->display_amount) && $payment->display_amount !== '' ? $payment->display_amount : $payment->grand_total }}
                        BDT.
                    </td>
                </tr>
                <tr>
                    <td style="text-align: end;" colspan="2"><strong>Subtotal : </strong></td>
                    <td style="text-align: left;">
                        {{ isset($payment->display_amount) && $payment->display_amount !== '' ? $payment->display_amount : $payment->grand_total }}
                        BDT.
                    </td>
                </tr>
                <tr>
                    <td style="text-align: end;" colspan="2"><strong>Total : </strong></td>
                    <td style="text-align: left;">
                        {{ isset($payment->display_amount) && $payment->display_amount !== '' ? $payment->display_amount : $payment->grand_total }}
                        BDT.
                    </td>
                </tr>
            </table>

            <div class="payment_method" style="margin: 30px 0;">
                <p><strong>Payment Method : </strong>{{ $payment['payment_method_item'] }}</p>
                <p><strong>Transition ID : </strong>{{ $payment['txt_number'] }}</p>
            </div>

            <div class="received">
                Received
            </div>
            <div class="footer">
                <p>This Payment Non-Refundable. Maybe Can Adjusment as per the SIAC Rules</p>
                <h3><strong>Thank You.</strong></h3>
            </div>
            <div style="margin-left: 400px">
                <img
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('upload/payment/signature/' . $payment->signature))) }}">
                <br>
                <span><b>Student Signature</b></span>
            </div>
        </div>
    </div>
</body>

</html>
