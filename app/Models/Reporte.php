<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_reporte';
    protected $fillable = [
        'tipo', 'fecha_generacion', 'formato', 'ruta_archivo', 'id_usuario_admin'
    ];

    public function usuarioAdmin()
    {
        return $this->belongsTo(Administrador::class, 'id_usuario_admin');
    }
}
