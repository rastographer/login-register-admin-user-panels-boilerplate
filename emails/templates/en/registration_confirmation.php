<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Registration Confirmation</h1>
        <p>Dear <?= $data['userFullName']; ?>,</p>
        <p>Thank you for registering at [Name of your Business]! Your registration was successful.</p>
        <!-- Add more content as needed -->
        <p>Best regards,<br>[Name of your Business] Team</p>
    </div>
</body>
</html>
