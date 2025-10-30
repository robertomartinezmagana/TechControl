<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $table = 'mantenimientos';
    public static function config()
    {
        return [
            'name' => 'Mantenimiento',
            'plural' => 'Mantenimientos',
            'fields' => ['tipo', 'estado', 'fecha_programada', 'fecha_realizada'],
            'filters' => [
                'estado' => ['Pendiente', 'En Proceso', 'Completado', 'Cancelado'],
                'tipo' => ['Preventivo', 'Correctivo'],
            ],
            'form' => [
                'tipo' => [
                    'type' => 'select',
                    'label' => 'Tipo de Mantenimiento',
                    'options' => ['Preventivo', 'Correctivo'],
                    'required' => true
                ],
                'fecha_programada' => [
                    'type' => 'date',
                    'label' => 'Fecha Programada',
                    'required' => true
                ],
                'fecha_realizada' => [
                    'type' => 'date',
                    'label' => 'Fecha Realizada',
                    'required' => false
                ],
                'descripcion' => [
                    'type' => 'textarea',
                    'label' => 'Descripción',
                    'required' => true
                ],
                'estado' => [
                    'type' => 'select',
                    'label' => 'Estado',
                    'options' => ['Pendiente', 'En Proceso', 'Completado', 'Cancelado'],
                    'required' => true
                ],
                'observaciones' => [
                    'type' => 'textarea',
                    'label' => 'Observaciones',
                    'required' => false
                ],
                'id_equipo' => [
                    'type' => 'select-model',
                    'label' => 'Equipo Asociado',
                    'model' => \App\Models\Equipo::class,
                    'display' => 'modelo',
                    'subtext' => 'numero_serie',
                    'required' => true
                ],
                'id_usuario_tecnico' => [
                    'type' => 'select-model',
                    'label' => 'Técnico Responsable',
                    'model' => \App\Models\Tecnico::class,
                    'display' => 'nombre',
                    'subtext' => 'email',
                    'required' => true
                ],
            ],
        ];
    }

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
