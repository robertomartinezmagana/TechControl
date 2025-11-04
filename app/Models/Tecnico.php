<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Tecnico extends UsuarioBase
{
    protected $table = 'tecnicos';
    protected $primaryKey = 'id_tecnico';

    // Relación 1-M Técnico-Mantenimientos (los que ha llevado a cabo)
    public function mantenimientos(): HasMany
    {
        return $this->hasMany(Mantenimiento::class, 'id_usuario_tecnico');
    }

    // Relación 1-M Técnico-Incidencias (las que ha atendido)
    public function incidencias(): HasMany
    {
        return $this->hasMany(Incidencia::class, 'id_usuario_tecnico');
    }
}
