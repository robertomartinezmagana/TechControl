@extends('layouts.base')

@section('title', 'Gestionar {{ $modelName }}')

@section('content')
<main class="content">
    <h1>{{ $modelName }} Registrados</h1>
    <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary">Nuevo {{ $modelName }}</a>

    <table class="table">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->marca }}</td>
                <td>{{ $item->modelo }}</td>
                <td>{{ $item->estado }}</td>
                <td>
                    <a href="{{ route($routePrefix . '.edit', $item) }}">Editar</a>
                    <form action="{{ route($routePrefix . '.destroy', $item) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection
