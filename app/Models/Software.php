<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;

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
