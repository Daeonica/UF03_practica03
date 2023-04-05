@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="d-flex justify-content-between">
                <a href="{{ route('events.create') }}" class="btn btn-primary">Crear Evento</a>
            </div>
            <form action="{{ route('events.show') }}" method="GET">
                <div class="input-group mt-3">
                    <input type="text" name="search" class="form-control" placeholder="Buscar evento por título o descripción">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <h1>Eventos</h1>
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
                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-primary">Editar evento</a>
                <a href="{{ route('events.register', $event->id) }}" class="btn btn-success">Registrar asistentes</a>
                <form action="{{ route('events.showAttendees', $event->id) }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-danger">Eliminar asistentes</button>
                </form>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar evento</button>
                </form>
            </div>
        </div>
    </div>

    @endforeach
    <div class="d-flex justify-content-center">
        {{ $events->links() }}
    </div>
</div>

@endsection