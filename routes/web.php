<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('portal', ['splash' => true]);
});

Route::get('/portal', function () {
    return view('portal', ['splash' => false]);
});

// Rutas de autenticación por rol
foreach (['admin', 'empleado', 'soporte'] as $role) {
    // Mostrar formularios
    Route::get("/$role/login", [AuthController::class, 'showLogin'])->name("$role.login");
    Route::get("/$role/registro", [AuthController::class, 'showRegister'])->name("$role.register");

    // Procesar formularios
    Route::post("/$role/login", [AuthController::class, 'login'])->name("$role.login.submit");
    Route::post("/$role/registro", [AuthController::class, 'register'])->name("$role.register.submit");
}

