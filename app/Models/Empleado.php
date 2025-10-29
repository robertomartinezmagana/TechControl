<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empleado extends Model
{
    protected $table = 'empleado';
    protected $primaryKey = 'id_empleado';
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',
    ];

    // Relation to User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relation: equipment assigned to employee
    public function equipos(): HasMany
    {
        return $this->hasMany(Equipo::class, 'id_empleado_asignado');
    }

    // Relation: incidencias reported by employee
    public function incidencias(): HasMany
    {
        return $this->hasMany(Incidencia::class, 'id_usuario_reporta');
    }
}
