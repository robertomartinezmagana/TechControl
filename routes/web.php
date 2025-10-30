<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Role list
$roles = [
    'admin' => 'Administrador',
    'empleado' => 'Empleado',
    'soporte' => 'Tecnico'
];

// Portal & splash
Route::get('/', function () {
    return view('splash');
})->name('splash');

Route::get('/portal', function () {
    return view('portal');
})->name('portal');

// Authentication routes per role
foreach ($roles as $role => $label) {
    Route::prefix($role)->name("$role.")->group(function () use ($role) {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

        Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/registro', [AuthController::class, 'register'])->name('register.submit');
    });
}

// Protected routes
Route::middleware(['auth'])->group(function () use ($roles) {
    foreach ($roles as $role => $label) {

        Route::prefix($role)->name("$role.")->group(function () use ($role, $label) {

            // Dashboard
            $controllerClass = "App\Http\Controllers\\$label\\DashboardController";
            Route::get('/dashboard', [$controllerClass, 'index'])->name('dashboard');

            // CRUD resources (only if role has access)
            $resources = match($role) {
                'admin' => ['equipos', 'software', 'mantenimientos', 'notificaciones', 'reportes'],
                'empleado' => ['equipos', 'incidencias', 'notificaciones'],
                'soporte' => ['mantenimientos', 'incidencias', 'notificaciones'],
            };

            foreach ($resources as $resource) {
                $resourceController = "App\Http\Controllers\\$label\\".ucfirst($resource)."Controller";
                Route::resource($resource, $resourceController);
            }
        });
    }
});
