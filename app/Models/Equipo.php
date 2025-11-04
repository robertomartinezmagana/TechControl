<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';
    protected $primaryKey = 'id_equipo';
    protected $fillable = [
        'marca', 'modelo', 'numero_serie', 'tipo_equipo', 'ubicacion', 'estado', 'fecha_registro', 'id_empleado_asignado'
    ];

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
                'estado' => [
                    'type' => 'select',
                    'label' => 'Estado',
                    'options' => ['Operativo', 'Mantenimiento', 'Obsoleto', 'Baja'],
                    'required' => true
                ],
                'id_empleado_asignado' => [
                    'type' => 'select-model',
                    'label' => 'Empleado Asignado',
                    'model' => \App\Models\Empleado::class,
                    'display' => 'name',
                    'subtext' => 'email',
                    'required' => false
                ],
            ],

        ];
    }

    // Relación M-1 Equipo-Empleado (al que es asignado)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado_asignado');
    }

    // Relación 1-M Equipo-Incidencias (que presenta)
    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'id_equipo');
    }

    // Relación 1-M Equipo-Mantenimientos (que tuvo)
    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'id_equipo');
    }

    // Relación 1-M Equipo-EquipoSoftware
    public function softwareInstalado()
    {
        return $this->hasMany(EquipoSoftware::class, 'id_equipo');
    }

    // Relación virtual (con un pivot) M-M Equipo-Software
    public function software()
    {
        return $this->belongsToMany(Software::class, 'equipo_software', 'id_equipo', 'id_software')
            ->using(EquipoSoftware::class)
            ->withPivot('fecha_instalacion', 'version_instalada');
    }
}
