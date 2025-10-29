@extends('layouts.base')

@section('title', 'Dashboard Técnico')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="portal-card">
    <h1>Bienvenido, {{ auth()->user()->nombre }}</h1>
    <p class="sub">Panel de soporte TechControl</p>

    {{-- Estadísticas rápidas --}}
    <div class="dashboard-grid">
        <div class="stat-card">
            <h2>{{ $mantenimientosAsignados ?? 0 }}</h2>
            <p>Mantenimientos asignados</p>
        </div>
        <div class="stat-card">
            <h2>{{ $incidenciasAsignadas ?? 0 }}</h2>
            <p>Incidencias asignadas</p>
        </div>
        <div class="stat-card">
            <h2>{{ $alertasPendientes ?? 0 }}</h2>
            <p>Alertas por revisar</p>
        </div>
    </div>

    {{-- Accesos CRUD --}}
    <div class="dashboard-actions">
        <a href="{{ route('tecnico.mantenimientos.index') }}" class="role-btn">Gestionar Mantenimientos</a>
        <a href="{{ route('tecnico.incidencias.index') }}" class="role-btn">Gestionar Incidencias</a>
        <a href="{{ route('tecnico.notificaciones.index') }}" class="role-btn">Alertas</a>
    </div>
</div>

@endsection
