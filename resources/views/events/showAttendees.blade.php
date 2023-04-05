@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Asistentes del evento "{{ $event->title }}"</h1>
    <hr>
    @if ($attendees->count() > 0)
    <ul>
        @foreach ($attendees as $attendee)
        <li>
            {{ $attendee->name }} ({{ $attendee->email }})
            <form action="{{ route('events.destroyAttendee', [$event->id, $attendee->id]) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Eliminar</button>
</form>
        </li>
        @endforeach
    </ul>
    @else
    <p>No hay asistentes registrados para este evento.</p>
    @endif
    <div class="d-flex justify-content-center">
        <a href="{{ route('events.events', $event->id) }}" class="btn btn-secondary">Volver a los eventos</a>
    </div>
</div>
@endsection