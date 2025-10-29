@extends('layouts.base')

@section('title', "Registro: $role")

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
        <input name="nombre" type="text" required />
    </div>
    <div class="form-row">
        <label>Apellidos:</label>
        <input name="apellidos" type="text" required />
    </div>
    <div class="form-row">
        <label>Correo electrónico:</label>
        <input name="correo" type="email" required value="{{ old('correo') }}" />
        @error('correo')
            <span class="req invalid">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-row">
        <label>Teléfono:</label>
        <input name="telefono" type="tel" />
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
        <input type="password" id="pass2-{{ $role }}" name="password_confirmation" required>
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
