@extends('index')

@section('title', 'Reservas')

@section('content')
    <h2>Reservas</h2>
    <a href="{{ route('reservas.create') }}" class="btn btn-success mb-3">Nova Reserva</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Veículo</th>
                <th>Data Início</th>
                <th>Data Fim</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
       
