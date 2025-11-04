<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Usuario extends User
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $fillable = [
        'name',
        'nombre',
        'apellidos',
        'email',
        'password',
        'telefono',
        'activo',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'activo' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
        {
            if (empty($value)) return;

            // Verifica si ya está hasheada (longitud típica de bcrypt = 60)
            if (strlen($value) === 60 && preg_match('/^\$2[aby]\$.{56}$/', $value)) {
                $this->attributes['password'] = $value;
            } else {
                $this->attributes['password'] = Hash::make($value);
            }
        }

    // Relación 1-1 Usuario-Administrador
    public function administrador()
    {
        return $this->hasOne(Administrador::class, 'id_usuario', 'id');
    }

    // Relación 1-1 Usuario-Empleado
    public function empleado()
    {
        return $this->hasOne(Empleado::class, 'id_usuario', 'id');
    }

    // Relación 1-1 Usuario-Técnico
    public function tecnico()
    {
        return $this->hasOne(Tecnico::class, 'id_usuario', 'id');
    }

    // Relación 1-M Usuario-Incidencias (reportadas por éste)
    public function incidencias(): HasMany
    {
        return $this->hasMany(Incidencia::class, 'id_usuario');
    }

    // Relación 1-M Usuario-Equipos (asignados a éste)
    public function equipos(): HasMany
    {
        return $this->hasMany(Equipo::class, 'id_usuario');
    }

    // Para obtener su rol
    public function getRoleAttribute(): ?string
    {
        if ($this->administrador) return 'admin';
        if ($this->empleado) return 'empleado';
        if ($this->tecnico) return 'soporte';
        return null;
    }
}
