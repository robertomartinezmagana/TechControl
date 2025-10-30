@extends('layouts.base')

@section('title', $modelName . ' - ' . ($action == 'create' ? 'Nuevo' : 'Editar'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/crud/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/crud/form.css') }}">
@endsection

@section('content')
<main class="form-wrapper">
    <div class="form-header">
        <h1>{{ $action == 'create' ? 'Nuevo' : 'Editar' }} {{ $modelName }}</h1>
        <p class="subtext">Completa los campos requeridos para continuar con el registro.</p>
    </div>

    <form action="{{ $action == 'create' ? route($routePrefix . '.store') : route($routePrefix . '.update', $item) }}" method="POST" class="form-card">
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

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                {{ $action == 'create' ? 'Crear Registro' : 'Actualizar Registro' }}
            </button>
        </div>
    </form>
</main>
@endsection
