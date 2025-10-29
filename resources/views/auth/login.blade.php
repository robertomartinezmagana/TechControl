@extends('layouts.base')

@section('title', "Inicio de Sesión: $role")

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="form-card">
  <div class="top-icon">{{ $icon ?? '🔐' }}</div>
  <h2>Inicio de Sesión: {{ ucfirst($role) }}</h2>
  <p class="sub">Ingrese su usuario y contraseña</p>

  <form action="{{ route($role.'.login.submit') }}" method="POST">
    @csrf

    <div class="form-row">
      <label for="email">Correo electrónico:</label>
      <input id="email" name="email" type="email" required value="{{ old('email') }}" />
      @error('email')
          <span class="req invalid">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-row pw-row">
      <label for="password">Contraseña:</label>
      <div class="pwd-container">
        <input id="password" name="password" type="password" required />
        <button type="button" class="toggle-pwd" data-target="password">👁</button>
      </div>
      @error('password')
          <span class="req invalid">{{ $message }}</span>
      @enderror
    </div>

    <button class="submit-btn" type="submit">Iniciar sesión</button>
  </form>

  <div class="form-footer">
    ¿No tiene una cuenta?
    <a href="{{ route($role.'.register') }}">Regístrese aquí</a>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/password-rules.js') }}"></script>
<script src="{{ asset('js/password-show.js') }}"></script>
@endsection
