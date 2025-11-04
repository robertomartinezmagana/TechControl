<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'descripcion', 'estado', 'prioridad', 'id_usuario_reporta', 'id_usuario_tecnico', 'id_equipo'
    ];

    public static function config()
    {
        return [
            'name' => 'Incidencia',
            'plural' => 'Incidencias',
            'fields' => ['titulo', 'estado', 'prioridad'],
            'filters' => [
                'estado' => ['Abierta', 'En Proceso', 'Resuelta', 'Cerrada'],
                'prioridad' => ['Alta', 'Media', 'Baja'],
                'titulo' => 'text',
            ],
            'form' => [
                'titulo' => ['type' => 'text', 'label' => 'Título', 'required' => true],
                'descripcion' => ['type' => 'textarea', 'label' => 'Descripción', 'required' => true],
                'estado' => [
                    'type' => 'select',
                    'label' => 'Estado',
                    'options' => ['Abierta', 'En Proceso', 'Resuelta', 'Cerrada'],
                    'required' => true
                ],
                'prioridad' => [
                    'type' => 'select',
                    'label' => 'Prioridad',
                    'options' => ['Alta', 'Media', 'Baja'],
                    'required' => true
                ],
                'id_usuario_reporta' => [
                    'type' => 'select-model',
                    'label' => 'Usuario que Reporta',
                    'model' => \App\Models\Usuario::class,
                    'display' => 'nombre',
                    'subtext' => 'email',
                    'required' => true
                ],
                'id_usuario_tecnico' => [
                    'type' => 'select-model',
                    'label' => 'Técnico Asignado',
                    'model' => \App\Models\Tecnico::class,
                    'display' => 'nombre',
                    'subtext' => 'email',
                    'required' => false
                ],
                'id_equipo' => [
                    'type' => 'select-model',
                    'label' => 'Equipo Relacionado',
                    'model' => \App\Models\Equipo::class,
                    'display' => 'modelo',
                    'subtext' => 'numero_serie',
                    'required' => false
                ],
            ],
        ];
    }

    // Relación M-1 Incidencia-Equipo (en el que se presenta)
    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo');
    }

    // Relación 1-1 Incidencia-Usuario (que reporta)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    // Relación 1-1 Incidencia-Tecnico (que la atiende)
    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class, 'id_tecnico');
    }

    // Relación 1-M Incidencia-Notificaciones (que genera)
    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, 'id_incidencia');
    }
}
