<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

abstract class UsuarioBase extends Model
{
    public $timestamps = true;
    protected $fillable = ['id_usuario'];

    // Relación 1-1 con Usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Accessor para nombre completo
    public function getNombreCompletoAttribute(): string
    {
        return $this->user ? $this->user->name : '(Sin usuario)';
    }

    // Accessor para email
    public function getEmailAttribute(): string
    {
        return $this->user ? $this->user->email : '(Sin email)';
    }

    // Accesor combinado para nombre y correo
    public function getNombreConEmailAttribute(): string
    {
        if (!$this->user) return '(Sin usuario)';
        return $this->nombre_completo . ' (' . $this->email . ')';
    }
}
