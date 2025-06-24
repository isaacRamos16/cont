<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetirosDeposito extends Model
{
    protected $table = 'retiros_deposito';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_evento_equipo',
        'id_equipo',
        'moneda',
        'denominacion',
        'cantidad',
        'total',
        'created_at',
    ];

    public function evento()
    {
        return $this->belongsTo(EventosEquipo::class, 'id_evento_equipo');
    }

public function equipo()
{
    return $this->belongsTo(Equipo::class, 'id_equipo');
}




}
