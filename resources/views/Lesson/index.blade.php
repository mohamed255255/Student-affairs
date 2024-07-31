<!DOCTYPE html>
<html>
<head>
    <title>Lessons</title>
</head>
<body>
<h1>Lessons</h1>
<ul>
    @foreach ($lessons as $lesson)
        <li>
            Video Path: {{ $lesson->video_path }}<br>
            Course ID: {{ $lesson->course_id }}
        </li>
    @endforeach
</ul>
</body>
</html>
