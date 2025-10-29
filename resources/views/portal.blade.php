@extends('layouts.base')

@section('title', $splash ? 'TechControl' : 'Portal de Usuarios')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/portal.css') }}">
@endsection

@section('content')
@if($splash)
  <div class="splash">
    <div class="overlay"></div>
    <div class="logo-container">
      <h1 class="logo-text">Tech<span>Control</span></h1>
    </div>
  </div>
@else
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
@endif
@endsection

@section('scripts')
@if($splash)
<script>
setTimeout(() => {
    window.location.href = "{{ url('/portal') }}";
}, 5000);
</script>
@endif
@endsection
