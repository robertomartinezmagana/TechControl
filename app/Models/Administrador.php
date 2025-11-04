<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Administrador extends Model
{
    protected $table = 'administradores';
    protected $primaryKey = 'id_administrador';
    public $timestamps = true;
    protected $fillable = [
        'id_usuario',
    ];

    // Relación 1-1 Administrador-Usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relación 1-M Administrador-Reportes
    public function reportes(): HasMany
    {
        return $this->hasMany(Reporte::class, 'id_usuario_admin');
    }

    // Relación 1-M Administrador-Notificaciones
    public function notificaciones(): HasMany
    {
        return $this->hasMany(Notificacion::class, 'id_usuario_destino');
    }
}
