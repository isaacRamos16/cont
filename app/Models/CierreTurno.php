<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CierreTurno extends Model
{
    protected $table = 'cierres_turno';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_equipo',
        'machine_id',
        'user_id',
        'user_name',
        'transaction_no',
        'fecha_generada',
        'automatic_close',
        'archivo_origen',
        'created_at'
    ];

    public function equipo()
{
    return $this->belongsTo(\App\Models\Equipo::class, 'id_equipo');
}



}
