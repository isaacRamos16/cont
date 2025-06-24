<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamento';
    protected $primaryKey = 'id_departamento';

    protected $fillable = [
        'departamento',
    ];

    public $timestamps = false; // ⛔️ Desactiva created_at y updated_at
}
