<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tecnico extends Model
{
    protected $table = 'tecnico';
    protected $primaryKey = 'id_tecnico';
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',
    ];

    // Relation to User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relation: maintenances performed
    public function mantenimientos(): HasMany
    {
        return $this->hasMany(Mantenimiento::class, 'id_usuario_tecnico');
    }

    // Relation: incidencias assigned
    public function incidencias(): HasMany
    {
        return $this->hasMany(Incidencia::class, 'id_usuario_tecnico');
    }
}
