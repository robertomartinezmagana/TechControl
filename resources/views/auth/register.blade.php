@extends('layouts.base')

@section('title', "Registro: $role")

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="form-card">
  <div class="top-icon">{{ $icon ?? '🧑' }}</div>
  <h2>Registro</h2>
  <p class="sub">Cree una cuenta de {{ ucfirst($role) }}</p>

  <form action="{{ route($role.'.register.submit') }}" method="POST" novalidate>
    @csrf
    <input type="hidden" name="role" value="{{ $role }}" />

    <div class="form-row">
        <label>Nombre(s):</label>
        <input name="nombre" type="text" required value="{{ old('nombre') }}" />
        @error('nombre')
            <span class="req invalid">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-row">
        <label>Apellidos:</label>
        <input name="apellidos" type="text" required value="{{ old('apellidos') }}" />
        @error('apellidos')
            <span class="req invalid">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-row">
        <label>Correo electrónico:</label>
        <input name="email" type="email" required value="{{ old('email') }}" />
        @error('email')
            <span class="req invalid">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-row">
        <label>Teléfono:</label>
        <input name="telefono" type="tel" value="{{ old('telefono') }}" />
        @error('telefono')
            <span class="req invalid">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-row">
      <label>Contraseña:</label>
      <div class="pwd-container">
        <input type="password" id="pass1-{{ $role }}" name="password" required data-role="{{ $role }}">
        <button type="button" class="toggle-pwd" data-target="pass1-{{ $role }}">👁</button>
      </div>
      @error('password')
          <span class="req invalid">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-row">
      <label>Verifica Contraseña:</label>
      <div class="pwd-container">
        <input type="password" id="pass2-{{ $role }}" name="password_confirmation" required data-role="{{ $role }}">
        <button type="button" class="toggle-pwd" data-target="pass2-{{ $role }}">👁</button>
      </div>
    </div>

    @include('partials.password-rules', ['role' => $role])

    <button type="submit" id="submit-{{ $role }}" class="submit-btn">Registrar Usuario</button>
  </form>

  <div class="form-footer">
    ¿Ya tiene una cuenta? <a href="{{ route($role.'.login') }}">Inicie sesión</a><br>
    <a href="{{ url('/') }}">Volver al portal</a>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/password-rules.js') }}"></script>
<script src="{{ asset('js/password-show.js') }}"></script>
@endsection
