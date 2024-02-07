<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
    <style>
        /* Add your email styles here */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            color: #ffffff;
            background-color: #007bff;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello there <?= $data['userFullName']; ?>,</h2>
        <p>This is [Your Name], an Admin at [Name of your Business]!</p>
        <p><?= $data['itemDetails']; ?></p>
        <p>Thank you for choosing [Name of your Business]! If you have any questions, feel free to contact our support or reply to this email.</p>
        
        <p>Note: If you have trouble logging into your account try clicking on forgot password to reset your credentials.</p>
        <!-- Add more content as needed -->

        <!-- Include a link to your website or a button to redirect users -->
        <a class="button" href="#">Visit Our Website</a>
    </div>
</body>
</html>
