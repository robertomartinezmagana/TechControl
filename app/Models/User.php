<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'nombre',
        'apellidos',
        'email',
        'password',
        'telefono',
        'activo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'activo' => 'boolean',
        'email_verified_at' => 'datetime', // in case you use email verification later
    ];

    /**
     * Automatically hash the password when setting it.
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    /**
     * Role relationships
     */
    public function administrador()
    {
        return $this->hasOne(Administrador::class, 'id_usuario', 'id');
    }

    public function empleado()
    {
        return $this->hasOne(Empleado::class, 'id_usuario', 'id');
    }

    public function tecnico()
    {
        return $this->hasOne(Tecnico::class, 'id_usuario', 'id');
    }

    /**
     * Convenience: Get the user role as a string.
     */
    public function getRoleAttribute(): ?string
    {
        if ($this->administrador) return 'admin';
        if ($this->empleado) return 'empleado';
        if ($this->tecnico) return 'soporte';
        return null;
    }
}
