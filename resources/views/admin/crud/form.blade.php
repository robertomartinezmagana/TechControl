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

        @foreach($formFields as $name => $field)
            <div class="form-group">
                <label for="{{ $name }}">{{ $field['label'] }}</label>

                @if($field['type'] === 'select' || $field['type'] === 'select-model')
                    <select name="{{ $name }}" id="{{ $name }}" class="form-control" {{ $field['required'] ? 'required' : '' }}>
                        <option value="">-- Selecciona --</option>
                        @foreach($field['options'] as $option)
                            <option value="{{ is_array($option) ? $option['value'] : $option }}"
                                {{ old($name, $item->$name ?? '') == (is_array($option) ? $option['value'] : $option) ? 'selected' : '' }}>
                                {{ is_array($option) ? $option['label'] : $option }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <input type="{{ $field['type'] }}" name="{{ $name }}" id="{{ $name }}" class="form-control"
                           value="{{ old($name, $item->$name ?? '') }}" {{ $field['required'] ? 'required' : '' }}>
                @endif
            </div>
        @endforeach

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                {{ $action == 'create' ? 'Crear Registro' : 'Actualizar Registro' }}
            </button>
        </div>
    </form>
</main>
@endsection
