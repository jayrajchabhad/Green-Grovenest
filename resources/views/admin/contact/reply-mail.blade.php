<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Your Inquiry</title>
</head>
<body>
    <p>Hello {{ $contact->name }},</p>

    <p>Thank you for reaching out to us. Below is our reply to your inquiry:</p>

    <p><strong>Our Reply:</strong> {{ $reply }}</p>

    <p>If you have any further questions, feel free to reach out again.</p>

    <p>Best regards,<br>Green Grovenest</p>
</body>
</html>