<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_cliente',
        'id_cargo',
        'es_superadmin',
        'estado',
         'id_agencia',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'es_superadmin' => 'boolean',
            'estado' => 'boolean',
        ];
    } 

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    /**
     * Relación: Usuario pertenece a un Cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    /**
     * Relación: Usuario pertenece a un Cargo
     */
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'id_cargo');
    }

    /**
     * Scope: Solo usuarios activos
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', 1);
    }


      public function Agencia() {
        return $this->belongsTo(Agencia::class, 'id_agencia');
    }


}
