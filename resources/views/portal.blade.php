@extends('layouts.base')

@section('title', 'Portal de Usuarios')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/portal.css') }}">
@endsection

@section('content')
<h1 style="text-align:center;">Inicio de sesión</h1>
<div class="portal-card">
  <h2>Portal de Usuarios</h2>

  @foreach(['admin' => '🛡', 'empleado' => '👨‍💼', 'soporte' => '🧰'] as $role => $icon)
    <a class="role-btn" href="{{ route($role.'.login') }}" aria-label="{{ ucfirst($role) }}">
      <span>{{ $icon }}</span>
      <span>{{ ucfirst($role) }}</span>
    </a>
  @endforeach
</div>
@endsection
