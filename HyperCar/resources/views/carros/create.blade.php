@extends('index')

@section('title', 'Adicionar Carro')

@section('content')
    <h2>Adicionar Novo Carro</h2>
    <form action="{{ route('carros.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="tipo" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection
