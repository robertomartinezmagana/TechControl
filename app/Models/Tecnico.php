<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tecnico extends Model
{
    protected $table = 'tecnicos';
    protected $primaryKey = 'id_tecnico';
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',
    ];

    // Relación 1-1 Técnico-Usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

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
