<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $table = 'incidencias';
    public static function config()
    {
        return [
            'name' => 'Incidencia',
            'plural' => 'Incidencias',
            'fields' => ['titulo', 'estado', 'prioridad', 'fecha_reporte'],
            'filters' => [
                'estado' => ['Abierta', 'En Proceso', 'Resuelta', 'Cerrada'],
                'prioridad' => ['Alta', 'Media', 'Baja'],
                'titulo' => 'text',
            ],
            'form' => [
                'titulo' => ['type' => 'text', 'label' => 'Título', 'required' => true],
                'descripcion' => ['type' => 'textarea', 'label' => 'Descripción', 'required' => true],
                'fecha_reporte' => ['type' => 'date', 'label' => 'Fecha de Reporte', 'required' => true],
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
