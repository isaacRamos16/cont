<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agencia extends Model
{
    protected $table = 'agencias';
    protected $primaryKey = 'id_agencia';
    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'id_departamento',
        'id_provincia',
        'id_distrito',
        'direccion'
    ];

    // Relaciones
    public function cliente() {
    return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
}


    public function departamento() {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }

    public function provincia() {
        return $this->belongsTo(Provincia::class, 'id_provincia');
    }

    public function distrito() {
        return $this->belongsTo(Distrito::class, 'id_distrito');
    }
}
