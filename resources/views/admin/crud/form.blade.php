@extends('layouts.base')

@section('title', $modelName . ' - ' . ($action == 'create' ? 'Nuevo' : 'Editar'))

@section('content')
<main class="content">
    <h1>{{ $modelName }} - {{ $action == 'create' ? 'Crear' : 'Editar' }}</h1>

    <form action="{{ $action == 'create' ? route($routePrefix . '.store') : route($routePrefix . '.update', $item) }}" method="POST">
        @csrf
        @if($action == 'edit') @method('PUT') @endif

        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" name="marca" id="marca" class="form-control" value="{{ old('marca', $item->marca ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" name="modelo" id="modelo" class="form-control" value="{{ old('modelo', $item->modelo ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="numero_serie">Número de Serie</label>
            <input type="text" name="numero_serie" id="numero_serie" class="form-control" value="{{ old('numero_serie', $item->numero_serie ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="Operativo" {{ old('estado', $item->estado ?? '') == 'Operativo' ? 'selected' : '' }}>Operativo</option>
                <option value="Mantenimiento" {{ old('estado', $item->estado ?? '') == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                <option value="Obsoleto" {{ old('estado', $item->estado ?? '') == 'Obsoleto' ? 'selected' : '' }}>Obsoleto</option>
                <option value="Baja" {{ old('estado', $item->estado ?? '') == 'Baja' ? 'selected' : '' }}>Baja</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ $action == 'create' ? 'Crear' : 'Actualizar' }}</button>
    </form>
</main>
@endsection
