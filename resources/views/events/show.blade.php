@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Resultados de búsqueda</h1>
    <hr>
    @foreach($events as $event)
    <div class="card mb-3">
        <div class="card-header">{{ $event->title }}</div>
        <div class="card-body">
            <p class="card-text">{{ $event->description }}</p>
            <p class="card-text">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
            <p class="card-text">{{ $event->location }}</p>
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

            <div class="d-flex justify-content-between">
                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-primary">Editar</a>
                <a href="{{ route('events.register', $event->id) }}" class="btn btn-success">Registrar asistentes</a>

                <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
