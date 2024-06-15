<!DOCTYPE html>
<html>
<head>
    <title>Confirmation of Unsubscription</title>
</head>
<body>
<h1>Hello, {{ $full_name }}</h1>
<p>We have received your request to unsubscribe from our conference. We're sorry to see you go.</p>
<p>Here are some details about the conference you've unsubscribed from:</p>
<ul>
    <li>Date start: {{ $event->start_date }}</li>
    <li>Date end: {{ $event->end_date }}</li>
    <li>Location: {{ $event->location }}</li>
</ul>
<p>If you change your mind or have any questions, feel free to contact us at {{ $email }}.</p>
<p>Best regards,</p>
<p>The {{ $event->title }} Team</p>
</body>
</html>
