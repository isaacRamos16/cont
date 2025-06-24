<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepositosXml extends Model
{
    protected $table = 'depositos_xml';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_equipo',
        'machine_id',
        'user_id',
        'user_name',
        'transaction_no',
        'fecha_generada',
        'moneda',
        'denominacion',
        'cantidad',
        'total',
        'archivo_origen',
        'created_at'
    ];

    // En app/Models/DepositosXml.php
public function equipo()
{
    return $this->belongsTo(Equipo::class, 'id_equipo');
}

 


}
