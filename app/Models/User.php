<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
        if (!empty($value)) {
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

    // Para obtener su rol
    public function getRoleAttribute(): ?string
    {
        if ($this->administrador) return 'admin';
        if ($this->empleado) return 'empleado';
        if ($this->tecnico) return 'soporte';
        return null;
    }
}
