@extends('layouts.base')

@section('title', 'Gestionar ' . $modelName)

@section('styles')
<link rel="stylesheet" href="{{ asset('css/crud/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/crud/index.css') }}">
@endsection

@section('content')
<main class="index-wrapper">
    <div class="index-header">
        <h1>{{ $modelPlural }} Registrados</h1>
        <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary">+ Nuevo {{ $modelName }}</a>
    </div>

    <form method="GET" class="filter-form">
        @foreach($filters as $field => $type)
            @if(is_array($type))
                <select name="{{ $field }}" class="form-control">
                    <option value="">{{ $filterLabels[$field] }}</option>
                    @foreach($type as $option)
                        <option value="{{ $option }}" {{ request($field) == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            @else
                <input type="text" name="{{ $field }}" placeholder="Buscar por {{ ucfirst($field) }}" value="{{ request($field) }}" class="form-control">
            @endif
        @endforeach
        <button type="submit" class="btn btn-secondary">Filtrar</button>
    </form>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    @foreach($fields as $field)
                        <th>{{ ucfirst($field) }}</th>
                    @endforeach
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    @foreach($fields as $field)
                        <td>
                            @if($field === 'estado')
                                <span class="badge badge-{{ strtolower($item->$field) }}">{{ $item->$field }}</span>
                            @else
                                {{ $item->$field }}
                            @endif
                        </td>
                    @endforeach
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
                    <td colspan="{{ count($fields) + 1 }}" class="empty-row">No hay registros disponibles.</td>
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
