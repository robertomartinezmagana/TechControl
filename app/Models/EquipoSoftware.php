<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoSoftware extends Model
{
    use HasFactory;

    protected $table = 'equipo_software';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id_equipo', 'id_software', 'fecha_instalacion', 'fecha_vencimiento', 'version_instalada'
    ];

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
                'fecha_vencimiento_licencia' => [
                    'type' => 'date',
                    'label' => 'Vencimiento de Licencia',
                    'required' => false
                ],
            ],
        ];
    }

    // Relación 1-M EquipoSoftware-Equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo');
    }

    // Relación 1-M EquipoSoftware-Software
    public function software()
    {
        return $this->belongsTo(Software::class, 'id_software');
    }
}
