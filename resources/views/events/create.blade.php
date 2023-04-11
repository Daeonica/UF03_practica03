@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear evento</h1>
    <hr>
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="date">Fecha</label>
            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" required min="2023-04-01">

        </div>
        <div class="form-group">
            <label for="location">Ubicación</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <br>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary justify-content-center">Crear evento</button>
        </div>
    </form>
</div>
@endsection