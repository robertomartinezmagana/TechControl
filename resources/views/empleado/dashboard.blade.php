@extends('layouts.base')

@section('title', 'Dashboard Empleado')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="portal-card">
    <h1>Bienvenido, {{ auth()->user()->nombre }}</h1>
    <p class="sub">Panel de usuario TechControl</p>

    {{-- Estadísticas rápidas --}}
    <div class="dashboard-grid">
        <div class="stat-card">
            <h2>{{ $misEquipos ?? 0 }}</h2>
            <p>Equipos asignados</p>
        </div>
        <div class="stat-card">
            <h2>{{ $misIncidencias ?? 0 }}</h2>
            <p>Incidencias reportadas</p>
        </div>
        <div class="stat-card">
            <h2>{{ $alertasPendientes ?? 0 }}</h2>
            <p>Alertas por revisar</p>
        </div>
    </div>

    {{-- Accesos CRUD --}}
    <div class="dashboard-actions">
        <a href="{{ route('empleado.equipos.index') }}" class="role-btn">Mis Equipos</a>
        <a href="{{ route('empleado.incidencias.index') }}" class="role-btn">Reportar Incidencia</a>
        <a href="{{ route('empleado.incidencias.mis') }}" class="role-btn">Mis Incidencias</a>
        <a href="{{ route('empleado.notificaciones.index') }}" class="role-btn">Alertas</a>
    </div>
</div>

@endsection
