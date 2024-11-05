@extends('index')

@section('title', 'Lista de Carros')

@section('content')
    <h2>Carros</h2>
    <a href="{{ route('carros.create') }}" class="btn btn-success mb-3">Adicionar Novo Carro</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Modelo</th>
                <th>Tipo</th>
                <th>Placa</th>
                <th>Disponibilidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carros as $carro)
                <tr>
                    <td>{{ $carro->modelo }}</td>
                    <td>{{ $carro->tipo }}</td>
                    <td>{{ $carro->placa }}</td>
                    <td>{{ $carro->disponibilidade ? 'Disponível' : 'Indisponível' }}</td>
                    <td>
                        <a href="{{ route('carros.edit', $carro->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('carros.destroy', $carro->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
