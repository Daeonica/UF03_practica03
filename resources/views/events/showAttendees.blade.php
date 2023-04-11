@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Asistentes del evento "{{ $event->title }}"</h1>
    <div class="d-flex justify-content-center">
        <a href="{{ route('events.register', $event->id) }}" class="btn btn-success">Registrar asistentes</a>
    </div>
    <hr>
    @if ($attendees->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendees as $attendee)
            <tr>
                <td>{{ $attendee->id }}</td>
                <td>{{ $attendee->name }}</td>
                <td>{{ $attendee->email }}</td>
                <td>
                    <form action="{{ route('events.destroyAttendee', [$event->id, $attendee->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar a este asistente?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No hay asistentes registrados para este evento.</p>
    @endif
    <div class="d-flex justify-content-center">
        <a href="{{ route('events.events', $event->id) }}" class="btn btn-secondary">Volver a los eventos</a>
    </div>
</div>
@endsection