@extends('layouts.base')

@section('title', 'Gestionar ' . $modelName)

@section('styles')
<link rel="stylesheet" href="{{ asset('css/crud/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/crud/index.css') }}">
@endsection

@section('content')
<main class="index-wrapper">
    <div class="index-header">
        <h1>{{ $modelName }} Registrados</h1>
        <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary">+ Nuevo {{ $modelName }}</a>
    </div>

    <form method="GET" class="filter-form">
        <input type="text" name="search" placeholder="Buscar por marca o modelo" value="{{ $search }}" class="form-control">
        <select name="estado" class="form-control">
            <option value="">Todos los estados</option>
            <option value="Operativo" {{ $estado == 'Operativo' ? 'selected' : '' }}>Operativo</option>
            <option value="Mantenimiento" {{ $estado == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
            <option value="Obsoleto" {{ $estado == 'Obsoleto' ? 'selected' : '' }}>Obsoleto</option>
            <option value="Baja" {{ $estado == 'Baja' ? 'selected' : '' }}>Baja</option>
        </select>
        <button type="submit" class="btn btn-secondary">Filtrar</button>
    </form>

    <div class="table-container">
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
                @forelse($items as $item)
                <tr>
                    <td>{{ $item->marca }}</td>
                    <td>{{ $item->modelo }}</td>
                    <td><span class="badge badge-{{ strtolower($item->estado) }}">{{ $item->estado }}</span></td>
                    <td class="actions">
                        <a href="{{ route($routePrefix . '.edit', $item) }}" class="action-link">Editar</a>
                        <form action="{{ route($routePrefix . '.destroy', $item) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-delete" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="empty-row">No hay registros disponibles.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $items->links() }}
    </div>
</main>
@endsection
