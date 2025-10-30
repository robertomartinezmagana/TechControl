<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Equipo;
use App\Models\Software;
use App\Models\Mantenimiento;
use App\Models\Incidencia;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtén los datos necesarios para el dashboard
        $totalEquipos = Equipo::count();
        $totalSoftware = Software::count();
        $mantenimientosPendientes = Mantenimiento::where('estado', 'Pendiente')->count();
        $alertasPendientes = Incidencia::where('estado', 'Pendiente')->count();

        // Pasar los datos a la vista
        return view('admin.dashboard', compact('totalEquipos', 'totalSoftware', 'mantenimientosPendientes', 'alertasPendientes'));
    }
}
