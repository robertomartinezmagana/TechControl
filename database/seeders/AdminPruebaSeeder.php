<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Administrador;
use Illuminate\Database\Seeder;

class AdminPruebaSeeder extends Seeder
{
    public function run()
    {
        $user = Usuario::create([
            'name' => 'Alejandro Aramilla',
            'nombre' => 'Alejandro',
            'apellidos' => 'Aramilla',
            'email' => 'admin1@admin.com',
            'password' => 'Hola12345?',
            'telefono' => '123456789',
            'activo' => true,
        ]);

        Administrador::create(['id_usuario' => $user->id]);
    }
}
