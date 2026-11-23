<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Subnest Reminder</title>
</head>
<body>
    <h1>Subscription reminder</h1>

    <p>This is a reminder for your <strong>{{ $reminder->subscription->name }}</strong> subscription.</p>

    <p>{{ $reminder->message }}</p>

    <p>
        Reminder date:
        {{ \Carbon\Carbon::parse($reminder->reminder_date)->format('d M Y') }}
    </p>

    <p>Thank you for using Subnest!</p>
</body>
</html>