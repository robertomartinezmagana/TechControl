@extends('layouts.base')

@section('title', 'Dashboard Administrador')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<main class="dashboard-main">

    <!-- Contenedor principal: sidebar + contenido -->
    <div class="dashboard-container">

        <!-- Sidebar -->
        <aside class="dashboard-sidebar">
            <div class="sidebar-header">
                <h2>TechControl</h2>
                <p class="sub">Administrador</p>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('admin.equipos.index') }}" class="sidebar-link">Gestionar Equipos</a>
                <a href="{{ route('admin.software.index') }}" class="sidebar-link">Gestionar Software</a>
                <a href="{{ route('admin.mantenimientos.index') }}" class="sidebar-link">Gestionar Mantenimientos</a>
                <a href="{{ route('admin.notificaciones.index') }}" class="sidebar-link">Alertas</a>
                <a href="{{ route('admin.reportes.index') }}" class="sidebar-link">Generar Reportes</a>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <section class="dashboard-content">
            <div class="dashboard-header">
                <h1>Bienvenido, {{ auth()->user()->nombre }}</h1>
                <p class="sub">Panel de administración de TechControl</p>
            </div>

            <div class="dashboard-grid">
                <div class="stat-card">
                    <h2>{{ $totalEquipos ?? 0 }}</h2>
                    <p>Equipos registrados</p>
                </div>
                <div class="stat-card">
                    <h2>{{ $totalSoftware ?? 0 }}</h2>
                    <p>Software instalado</p>
                </div>
                <div class="stat-card">
                    <h2>{{ $mantenimientosPendientes ?? 0 }}</h2>
                    <p>Mantenimientos pendientes</p>
                </div>
                <div class="stat-card">
                    <h2>{{ $alertasPendientes ?? 0 }}</h2>
                    <p>Alertas por revisar</p>
                </div>
            </div>
        </section>

    </div>
</main>

@endsection
