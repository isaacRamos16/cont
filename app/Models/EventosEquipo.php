<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventosEquipo extends Model
{
    protected $table = 'eventos_equipo';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_equipo',
        'machine_id',
        'user_id',
        'user_name',
        'transaction_no',
        'fecha_generada',
        'function',
        'archivo_origen',
        'created_at',
        'status_detalle',
    ];

    public function retiros()
    {
        return $this->hasMany(RetirosDeposito::class, 'id_evento_equipo');
    }

    public function equipo()
{
    return $this->belongsTo(Equipo::class, 'id_equipo');
}



}
