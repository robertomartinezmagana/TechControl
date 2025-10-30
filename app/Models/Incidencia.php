<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_incidencia';
    protected $fillable = [
        'titulo', 'descripcion', 'fecha_reporte', 'estado', 'prioridad', 'id_usuario_reporta', 'id_usuario_tecnico', 'id_equipo'
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo');
    }

    public function usuarioReporta()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_reporta');
    }

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class, 'id_usuario_tecnico');
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, 'id_incidencia');
    }
}
