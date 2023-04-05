@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Asistente</h1>
    <hr>
    <form method="POST" action="{{ route('events.storeAttendee', $event->id) }}">
        @csrf
        <div class="form-group">
            <label for="name">Nombre completo</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <h2>Asistentes registrados</h2>
        @if ($event->attendees->count() > 0)
        <ul>
            @foreach ($event->attendees as $attendee)
            <li>{{ $attendee->name }} ({{ $attendee->email }})</li>
            @endforeach
        </ul>
        @else
        <p class="card-text">Aún no hay asistentes</p>
        @endif

        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
@endsection