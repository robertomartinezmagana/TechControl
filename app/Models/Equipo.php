<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';
    public static function config()
    {
        return [
            'name' => 'Equipo',
            'plural' => 'Equipos',
            'fields' => ['marca', 'modelo', 'estado'],
            'filters' => [
                'marca' => 'text',
                'modelo' => 'text',
                'estados' => ['Operativo', 'Mantenimiento', 'Obsoleto', 'Baja'],
            ],
            'form' => [
                'marca' => ['type' => 'text', 'label' => 'Marca', 'required' => true],
                'modelo' => ['type' => 'text', 'label' => 'Modelo', 'required' => true],
                'numero_serie' => ['type' => 'text', 'label' => 'Número de Serie', 'required' => true],
                'estado' => ['type' => 'select', 'label' => 'Estado', 'options' => ['Operativo', 'Mantenimiento', 'Obsoleto', 'Baja'], 'required' => true],
            ],
            'id_empleado_asignado' => [
                'type' => 'select-model',
                'label' => 'Empleado Asignado',
                'model' => \App\Models\Empleado::class,
                'display' => 'nombre_completo', // o 'nombre' si no tienes nombre completo
                'subtext' => 'email', // opcional: para mostrar email como subtítulo
                'required' => false
            ],
        ];
    }

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
