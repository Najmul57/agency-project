<!DOCTYPE html>
<html>

<head>
    <title>Payment Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 32px;
            color: #ffffff;
            text-transform: uppercase;
        }

        .content {
            padding: 20px;
            color: #444444;
            text-align: center;
        }

        .details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: left;
        }

        .details p {
            margin: 10px 0;
            color: #333333;
        }

        .footer {
            text-align: center;
            color: #777777;
            font-size: 14px;
            padding: 20px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            background-color: #f4f4f4;
        }

        .button {
            display: inline-block;
            background-color: #ff4500;
            color: #ffffff;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 50px;
            transition: background-color 0.3s;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .button:hover {
            background-color: #ff6a36;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Payment Notification</h1>
        </div>
        <div class="content">
            <p>Hello Admin,</p>
            <p style="font-size: 18px;">A new payment has been made:</p>
            <div class="details">
                {{ $payment }}
                <p><strong>System ID:</strong> {{ $payment->user->system_id }}</p>
                <p><strong>Receipt ID:</strong> {{ $payment->receipt_id }}</p>
                <p><strong>Name:</strong> {{ ucfirst($payment->name) }}</p>
                <p><strong>Email:</strong> {{ $payment->email }}</p>
                <p><strong>Amount:</strong>
                    {{ isset($payment->display_amount) && $payment->display_amount !== '' ? $payment->display_amount : $payment->grand_total }}
                    BDT.
                </p>
            </div>
        </div>
        <div class="footer">
            <p>&copy; <?php echo date('Y'); ?> SIAC. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
