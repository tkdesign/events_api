<!DOCTYPE html>
<html>
<head>
    <title>Thank you for your registration</title>
</head>
<body>
<h1>Hello, {{ $full_name }}</h1>
<p>Thank you for registering for our conference. We're excited to have you join us.</p>
<p>Here are some details about the conference:</p>
<ul>
    <li>Date start: {{ $event->start_date }}</li>
    <li>Date end: {{ $event->end_date }}</li>
    <li>Location: {{ $event->location }}</li>
</ul>
<p>If you have any questions, feel free to contact us at {{ $email }}.</p>
<p>Best regards,</p>
<p>The {{ $event->title }} Team</p>
</body>
</html>
