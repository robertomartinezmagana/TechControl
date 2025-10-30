<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_notificacion';
    protected $fillable = [
        'titulo', 'mensaje', 'tipo', 'fecha_envio', 'leida', 'id_usuario_destino', 'id_mantenimiento', 'id_incidencia'
    ];

    public function usuarioDestino()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_destino');
    }

    public function mantenimiento()
    {
        return $this->belongsTo(Mantenimiento::class, 'id_mantenimiento');
    }

    public function incidencia()
    {
        return $this->belongsTo(Incidencia::class, 'id_incidencia');
    }
}
