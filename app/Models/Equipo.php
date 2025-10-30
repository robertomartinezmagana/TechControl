<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_equipo';
    protected $fillable = [
        'marca', 'modelo', 'numero_serie', 'tipo_equipo', 'ubicacion', 'estado', 'fecha_registro', 'id_empleado_asignado'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado_asignado');
    }

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'id_equipo');
    }

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'id_equipo');
    }

    public function software()
    {
        return $this->belongsToMany(Software::class, 'equipo_software', 'id_equipo', 'id_software')
            ->withPivot('fecha_instalacion', 'version_instalada');
    }
}
