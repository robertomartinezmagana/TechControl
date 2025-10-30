<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrador\CrudController;
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

            // CrudController para todos los recursos
            foreach ($resources as $resource) {
                Route::prefix($resource)->name("$resource.")->group(function () use ($resource) {
                    Route::get('/', fn(Request $request) => app(CrudController::class)->index($resource, $request))->name('index');
                    Route::get('/create', fn() => app(CrudController::class)->create($resource))->name('create');
                    Route::post('/', fn(Request $request) => app(CrudController::class)->store($request, $resource))->name('store');
                    Route::get('/{id}/edit', fn($id) => app(CrudController::class)->edit($resource, $id))->name('edit');
                    Route::put('/{id}', fn(Request $request, $id) => app(CrudController::class)->update($request, $resource, $id))->name('update');
                    Route::delete('/{id}', fn($id) => app(CrudController::class)->destroy($resource, $id))->name('destroy');
                });
            }
        });
    }
});

