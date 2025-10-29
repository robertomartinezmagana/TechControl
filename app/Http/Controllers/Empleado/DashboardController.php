<?php

namespace App\Http\Controllers\Empleado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Incidencia;
use App\Models\Notificacion;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Middleware para asegurar que solo empleados accedan
        $this->middleware('auth');
        $this->middleware('role:empleado'); // Si tienes middleware por rol
    }

    public function index()
    {
        $userId = Auth::id();

        // Equipos asignados al empleado
        $misEquipos = Equipo::where('id_empleado_asignado', $userId)->count();

        // Incidencias reportadas por el empleado
        $misIncidencias = Incidencia::where('id_usuario_reporta', $userId)->count();

        // Alertas pendientes para el empleado
        $alertasPendientes = Notificacion::where('id_usuario_destino', $userId)
            ->where('leida', false)
            ->count();

        return view('empleado.dashboard', compact('misEquipos', 'misIncidencias', 'alertasPendientes'));
    }
}
