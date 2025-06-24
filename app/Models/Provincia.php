<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = 'provincia';
    protected $primaryKey = 'id_provincia';

    protected $fillable = [
        'provincia',
        'id_departamento', // 👈 ESTE debe estar
    ];

    public $timestamps = false; // ⛔️ Desactiva created_at y updated_at

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }

        // app/Models/Provincia.php
    public function distritos()
    {
        return $this->hasMany(Distrito::class, 'id_provincia', 'id_provincia');
    }



}
 