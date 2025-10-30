<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoSoftware extends Model
{
    use HasFactory;

    protected $table = 'equipo_software';
    public $timestamps = false;

    protected $fillable = [
        'id_equipo', 'id_software', 'fecha_instalacion', 'version_instalada'
    ];
}
