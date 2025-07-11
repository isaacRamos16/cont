<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;
    protected $table = 'clientes';

    protected $fillable = [
        'id',
        'name',
        'ruc',
        'direccion',
        'telefono',
        'email_empresa',
        'estado',
    ];
    
}
