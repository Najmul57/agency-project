<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background-color: #f2f2f2;
            /* Light gray background color */
            border: 1px solid #ddd;
            /* Light gray border */
            padding: 8px;
            text-align: left;
        }

        td {
            border: 1px solid #ddd;
            /* Light gray border */
            padding: 8px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
            /* Alternate row background color */
        }

        .loginbar {
            background: #f4d432;
            text-align: center;
            margin: 15px 0;
        }

        .loginbar a {
            text-decoration: none;
            color: #fff;
            background: #6a2c8f;
            padding: 10px 50px;
            margin: 5px;
            display: inline-block;
            font-weight: 700;
            border-radius: 50px;
        }

        .logo img {
            width: 115px;
        }

        .logo {
            width: 50%;
            text-align: center;
            float: left;
        }

        .query {
            width: 50%;
            float: right;
            text-align: center;
            margin-bottom: 20px;
        }

        .query p {
            font-size: 12px;
            margin: 0;
        }

        .query h1 {
            margin: 0;
            font-size: 20px;
        }

        .query a {
            text-decoration: none;
            color: #000;
            font-size: 15px;
        }

        .main_body h3 {
            margin: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            margin: 0;
        }

        .main_body p {
            margin-top: 5px;
            margin-bottom: 20px;
        }

        .social__link a {
            width: 40px;
            display: inline-block;
            height: 40px;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            font-size: 20px;
            /* Adjust font size for icons */
            color: #fff;
            /* Set icon color */
        }

        .social__link a i {
            vertical-align: middle;
        }

        .social__logo img {
            width: 100px;
            float: left;
            margin-left: 80px;
        }

        .social__logo {
            width: 60%;
            float: left;
            text-align: center;
        }

        .social__link {
            width: 40%;
            float: right;
            text-align: center;
        }

        footer {
            background: #314b98;
            margin-top: 10px;
            padding: 10px;
            display: inline-block;
            text-align: center;
            width: 97%;
        }

        footer a {
            display: inline-block;
            color: #fff;
            position: relative;
            text-decoration: none;
            left: 10%;
        }

        footer a span {
            background: #fff;
            color: #000;
            display: inline-block;
            padding: 5px 10px;
            margin-left: 5px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="wrapper" style="max-width: 700px; margin: auto">
        <header>
            <h1>Welcome to <strong>SIAC Abroad</strong></h1>
            <div class="query">
                <p>Bridging Dreams, Beyond Borders</p>
                <h1>Call for Any Queries</h1>
                <a href="tel:+8801871010852">+8801871010852</a>
            </div>
        </header>
        <div class="main_body">
            <h3><strong>{{ ucfirst($name) }}</strong></h3>
            <p>
                <b>Congratulations</b> on completing the first step towards a global
                career. Kindly complete your Further Process as soon as possible.
            </p>
            <table>
                <tr>
                    <th style="width: 50%">System Id</th>
                    <td>{{ $system_id }}</td>
                </tr>
                <tr>
                    <th style="width: 50%">Email</th>
                    <td>{{ $email }}</td>
                </tr>
                <tr>
                    <th style="width: 50%">Temporary Password
                    <td>{{ $password }}</td>
                </tr>
            </table>

            <div class="loginbar">
                <a href="http://localhost/siac/public/login">LOGIN</a>
            </div>
        </div>

        <footer style="position: relative;left:50%;transform:translate(-50%)">
            <a href="mailto:contact@siacabroad.com"><i
                    class="fas fa-envelope"></i><span>contact@siacabroad.com</span></a>
            <a href="tel:+8801786067794"><i class="fas fa-phone"></i><span>+8801786067794</span></a>
            <a href="http://siacabroad.com"><i class="fas fa-globe"></i><span>http://siacabroad.com</span></a>
        </footer>
    </div>
</body>

</html>
