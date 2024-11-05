@extends('index')

@section('title', 'Editar Carro')

@section('content')
    <h2>Editar Carro</h2>
    <form action="{{ route('carros.update', $carro->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo" value="{{ $carro->modelo }}" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="tipo" value="{{ $carro->tipo }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
@endsection
