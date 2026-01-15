<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Geolocalyz!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #0056b3;
        }
        p {
            margin-bottom: 15px;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Geolocalyz!</h1>
        <p>Hello {{ $user->name ?? 'User' }},</p>
        <p>Thank you for your purchase! We're excited to have you on board.</p>

        <h2>Your Account Details:</h2>
        <p><strong>Email:</strong> {{ $user->email ?? 'N/A' }}</p>
        <p><strong>Your Temporary Password:</strong> {{ $generatedPassword }}</p>
        <p>Please log in and change your password for security reasons.</p>

        <h2>Your Localization Service:</h2>
        <p>You can access your localization tracking link here:</p>
        <p><a href="{{ $localizationLink }}" class="button">Access Localization Link</a></p>
        <p>This link allows you to track the location requests you've initiated.</p>

        <h2>Invoice Summary:</h2>
        <p>This is a placeholder for your invoice details. A detailed invoice will be attached or available in your dashboard soon.</p>
        <p>Thank you again for choosing Geolocalyz!</p>
        <p>Best regards,</p>
        <p>The Geolocalyz Team</p>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} Geolocalyz. All rights reserved.</p>
    </div>
</body>
</html>
