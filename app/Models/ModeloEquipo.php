<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeloEquipo extends Model
{
    protected $table = 'modelo_equipo';
    protected $primaryKey = 'id_modelo';  // Define la clave primaria correctamente

    protected $fillable = [
        'nombre_modelo',
        'ruc',
    ];
}
 