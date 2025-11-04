<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $table = 'reportes';
    protected $primaryKey = 'id_reporte';
    protected $fillable = [
        'tipo', 'formato', 'ruta_archivo', 'id_usuario_admin'
    ];

    public static function config()
    {
        return [
            'name' => 'Reporte',
            'plural' => 'Reportes',
            'fields' => ['tipo', 'formato', 'ruta_archivo'],
            'filters' => [
                'tipo' => ['Incidencias', 'Mantenimientos', 'Inventario', 'Usuarios'],
                'formato' => ['PDF', 'Excel', 'CSV'],
            ],
            'form' => [
                'tipo' => [
                    'type' => 'select',
                    'label' => 'Tipo de Reporte',
                    'options' => ['Incidencias', 'Mantenimientos', 'Inventario', 'Usuarios'],
                    'required' => true
                ],
                'formato' => [
                    'type' => 'select',
                    'label' => 'Formato',
                    'options' => ['PDF', 'Excel', 'CSV'],
                    'required' => true
                ],
                'ruta_archivo' => [
                    'type' => 'text',
                    'label' => 'Ruta del Archivo',
                    'required' => true
                ],
                'id_usuario_admin' => [
                    'type' => 'select-model',
                    'label' => 'Administrador Responsable',
                    'model' => \App\Models\Administrador::class,
                    'display' => 'nombre',
                    'subtext' => 'email',
                    'required' => true
                ],
            ],
        ];
    }

    // Relación M-1 Reporte-Administrador (que lo genera)
    public function admin()
    {
        return $this->belongsTo(Administrador::class, 'id_admin');
    }
}
