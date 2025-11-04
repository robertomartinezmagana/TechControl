<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empleado extends Model
{
    protected $table = 'empleados';
    protected $primaryKey = 'id_empleado';
    public $timestamps = true;
    protected $fillable = [
        'id_usuario',
    ];

    // Relación 1-1 Empleado-Usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relación 1-M Empleado-Equipos (asignados a éste)
    public function equipos(): HasMany
    {
        return $this->hasMany(Equipo::class, 'id_empleado_asignado');
    }

    // Relación 1-M Empleado-Incidencias (reportadas por éste)
    public function incidencias(): HasMany
    {
        return $this->hasMany(Incidencia::class, 'id_usuario_reporta');
    }
}
