<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Empleado;
use Illuminate\Database\Seeder;

class EmpleadoPruebaSeeder extends Seeder
{
    public function run(): void
    {
        $user = Usuario::create([
            'name' => 'Miguel Castillo',
            'nombre' => 'Miguel',
            'apellidos' => 'Castillo',
            'email' => 'empleado1@empleados.com',
            'password' => 'Hola12345?',
            'telefono' => '5512345678',
            'activo' => true,
        ]);

        Empleado::create(['id_usuario' => $user->id]);
    }
}
