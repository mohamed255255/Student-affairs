<!DOCTYPE html>
<html>
<head>
    <title>Send Notification</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<form action="{{ route('send.notification') }}" method="POST">
    @csrf
    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea><br><br>
    <button type="submit">Send Notification</button>
</form>
</body>
</html>
