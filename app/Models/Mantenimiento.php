<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_mantenimiento';
    protected $fillable = [
        'tipo', 'fecha_programada', 'fecha_realizada', 'descripcion', 'estado', 'observaciones', 'id_equipo', 'id_usuario_tecnico'
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo');
    }

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class, 'id_usuario_tecnico');
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, 'id_mantenimiento');
    }
}
