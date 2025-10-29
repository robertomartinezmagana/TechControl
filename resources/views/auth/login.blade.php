@extends('layouts.base')

@section('title', "Inicio de Sesión: $role")

@section('content')
<div class="form-card">
  <div class="top-icon">{{ $icon ?? '🔐' }}</div>
  <h2>Inicio de Sesión: {{ ucfirst($role) }}</h2>
  <p class="sub">Ingrese su usuario y contraseña</p>

  <form action="{{ route($role.'.login.submit') }}" method="POST">
    @csrf
    <input type="hidden" name="role" value="{{ $role }}" />

    <div class="form-row">
      <label for="usuario">Usuario:</label>
      <input id="usuario" name="usuario" type="text" required />
    </div>

    <div class="form-row pw-row">
      <label for="password">Contraseña:</label>
      <input id="password" name="password" type="password" required />
      <span class="pw-toggle" data-target="#password"></span>
    </div>

    <button class="submit-btn" type="submit">Iniciar sesión</button>
  </form>

  <div class="form-footer">
    ¿No tiene una cuenta?
    <a href="{{ route($role.'.register') }}">Regístrese aquí</a>
  </div>
</div>
@endsection
