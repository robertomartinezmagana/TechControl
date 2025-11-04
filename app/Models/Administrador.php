<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Administrador extends UsuarioBase
{
    protected $table = 'administradores';
    // Relación 1-M Administrador-Reportes
    public function reportes(): HasMany
    {
        return $this->hasMany(Reporte::class, 'id_admin');
    }

    // Relación 1-M Administrador-Notificaciones
    public function notificaciones(): HasMany
    {
        return $this->hasMany(Notificacion::class, 'id_usuario_destino');
    }
}
