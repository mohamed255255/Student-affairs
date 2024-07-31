<!DOCTYPE html>
<html>
<head>
    <title>Student Panel</title>
</head>
<body>
<h1>Student Panel</h1>
<ul id="notifications"></ul>

<script type="module" src="{{ mix('resources/js/app.js') }}"></script>
<script>
    window.Echo.channel('notifications')
        .listen('NotificationEvent', (e) => {
            let notifications = document.getElementById('notifications');
            let notification = document.createElement('li');
            notification.textContent = e.message;
            notifications.appendChild(notification);
        });
</script>
</body>
</html>
