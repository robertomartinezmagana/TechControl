<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoSoftware extends Model
{
    use HasFactory;

    protected $table = 'equipo_software';
    public static function config()
    {
        return [
            'name' => 'Instalación de Software',
            'plural' => 'Instalaciones de Software',
            'fields' => ['id_equipo', 'id_software', 'version_instalada', 'fecha_instalacion'],
            'filters' => [
                'version_instalada' => 'text',
                'fecha_instalacion' => 'date',
            ],
            'form' => [
                'id_equipo' => [
                    'type' => 'select-model',
                    'label' => 'Equipo',
                    'model' => \App\Models\Equipo::class,
                    'display' => 'modelo',
                    'subtext' => 'numero_serie',
                    'required' => true
                ],
                'id_software' => [
                    'type' => 'select-model',
                    'label' => 'Software',
                    'model' => \App\Models\Software::class,
                    'display' => 'nombre',
                    'subtext' => 'version',
                    'required' => true
                ],
                'version_instalada' => [
                    'type' => 'text',
                    'label' => 'Versión Instalada',
                    'required' => true
                ],
                'fecha_instalacion' => [
                    'type' => 'date',
                    'label' => 'Fecha de Instalación',
                    'required' => true
                ],
            ],
        ];
    }

    public $timestamps = false;

    protected $fillable = [
        'id_equipo', 'id_software', 'fecha_instalacion', 'version_instalada'
    ];
}
