<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>
</head>
<body>
<h1>Courses</h1>
<ul>
    @foreach ($courses as $course)
        <li>
            <strong>{{ $course->CourseName }}</strong><br>
            Author: {{ $course->AuthorName }}<br>
            Description: {{ $course->description }}<br>
            Price: ${{ $course->price }}<br>

            <a href="{{ route('lesson.index', ['course_id' => $course->id]) }}">View Lessons</a>
        </li>

    @endforeach
</ul>
</body>
</html>
