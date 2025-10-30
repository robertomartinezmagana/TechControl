<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;

    protected $table = 'software';
    public static function config()
    {
        return [
            'name' => 'Software',
            'plural' => 'Software',
            'fields' => ['nombre', 'version', 'licencia', 'fabricante'],
            'filters' => [
                'nombre' => 'text',
                'licencia' => ['Libre', 'Comercial', 'OEM', 'Trial'],
                'fabricante' => 'text',
            ],
            'form' => [
                'nombre' => [
                    'type' => 'text',
                    'label' => 'Nombre del Software',
                    'required' => true
                ],
                'version' => [
                    'type' => 'text',
                    'label' => 'Versión',
                    'required' => true
                ],
                'licencia' => [
                    'type' => 'select',
                    'label' => 'Tipo de Licencia',
                    'options' => ['Libre', 'Comercial', 'OEM', 'Trial'],
                    'required' => true
                ],
                'fabricante' => [
                    'type' => 'text',
                    'label' => 'Fabricante',
                    'required' => true
                ],
                'fecha_instalacion' => [
                    'type' => 'date',
                    'label' => 'Fecha de Instalación',
                    'required' => false
                ],
                'fecha_vencimiento_licencia' => [
                    'type' => 'date',
                    'label' => 'Vencimiento de Licencia',
                    'required' => false
                ],
            ],
        ];
    }

    protected $primaryKey = 'id_software';
    protected $fillable = [
        'nombre', 'version', 'licencia', 'fabricante', 'fecha_instalacion', 'fecha_vencimiento_licencia'
    ];

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'equipo_software', 'id_software', 'id_equipo')
            ->withPivot('fecha_instalacion', 'version_instalada');
    }
}
