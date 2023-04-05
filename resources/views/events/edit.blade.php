@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Evento</h1>

        <form action="{{ route('events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $event->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="date">Fecha</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d', strtotime($event->date)) }}" required>
            </div>

            <div class="form-group">
                <label for="location">Ubicación</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ $event->location }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
