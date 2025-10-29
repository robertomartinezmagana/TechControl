<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Example data for the Blade
        $data = [
            'totalEquipos' => 12,
            'totalSoftware' => 5,
            'mantenimientosPendientes' => 3,
            'alertasPendientes' => 2,
        ];

        return view('admin.dashboard', $data);
    }
}
