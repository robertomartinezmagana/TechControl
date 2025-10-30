<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';
    public static function config()
    {
        return [
            'name' => 'Notificación',
            'plural' => 'Notificaciones',
            'fields' => ['titulo', 'tipo', 'fecha_envio', 'leida'],
            'filters' => [
                'tipo' => ['Sistema', 'Manual', 'Automática'],
                'leida' => ['Sí', 'No'],
                'titulo' => 'text',
            ],
            'form' => [
                'titulo' => [
                    'type' => 'text',
                    'label' => 'Título',
                    'required' => true
                ],
                'mensaje' => [
                    'type' => 'textarea',
                    'label' => 'Mensaje',
                    'required' => true
                ],
                'tipo' => [
                    'type' => 'select',
                    'label' => 'Tipo de Notificación',
                    'options' => ['Sistema', 'Manual', 'Automática'],
                    'required' => true
                ],
                'fecha_envio' => [
                    'type' => 'datetime-local',
                    'label' => 'Fecha de Envío',
                    'required' => true
                ],
                'leida' => [
                    'type' => 'select',
                    'label' => '¿Leída?',
                    'options' => ['Sí', 'No'],
                    'required' => true
                ],
                'id_usuario_destino' => [
                    'type' => 'select-model',
                    'label' => 'Usuario Destinatario',
                    'model' => \App\Models\Usuario::class,
                    'display' => 'nombre',
                    'subtext' => 'email',
                    'required' => true
                ],
                'id_mantenimiento' => [
                    'type' => 'select-model',
                    'label' => 'Mantenimiento Relacionado',
                    'model' => \App\Models\Mantenimiento::class,
                    'display' => 'tipo',
                    'subtext' => 'fecha_programada',
                    'required' => false
                ],
                'id_incidencia' => [
                    'type' => 'select-model',
                    'label' => 'Incidencia Relacionada',
                    'model' => \App\Models\Incidencia::class,
                    'display' => 'titulo',
                    'subtext' => 'prioridad',
                    'required' => false
                ],
            ],
        ];
    }

    protected $primaryKey = 'id_notificacion';
    protected $fillable = [
        'titulo', 'mensaje', 'tipo', 'fecha_envio', 'leida', 'id_usuario_destino', 'id_mantenimiento', 'id_incidencia'
    ];

    public function usuarioDestino()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_destino');
    }

    public function mantenimiento()
    {
        return $this->belongsTo(Mantenimiento::class, 'id_mantenimiento');
    }

    public function incidencia()
    {
        return $this->belongsTo(Incidencia::class, 'id_incidencia');
    }
}
