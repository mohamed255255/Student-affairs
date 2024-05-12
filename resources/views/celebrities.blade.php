<!-- celebrities.blade.php -->
<h2>Actors born on {{ $formattedDate }}</h2>
@if (!empty($actorNames))
    <ul>
        @foreach ($actorNames as $name)
            <li>{{ $name }}</li>
        @endforeach
    </ul>
@else
    <p>No actors found for the given date.</p>
@endif
