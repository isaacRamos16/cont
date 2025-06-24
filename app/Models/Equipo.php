<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory; 

    // Asegúrate de que estos campos se pueden rellenar
    protected $fillable = [
        'nombre_equipo',
        'id_modelo',  // Actualizado a 'id_modelo'
        'numero_serie',
        'id_cliente',
        'id_usuario', 
        'id_agencia',

    ];

    /**
     * Relación: un equipo pertenece a un cliente.
     */
        public function cliente()
        {
            return $this->belongsTo(Cliente::class, 'id_cliente', 'id'); // ✅
        }


    /** 
     * Relación: un equipo pertenece a un modelo.
     */
    public function modeloEquipo()
    {
        return $this->belongsTo(ModeloEquipo::class, 'id_modelo');  // Relación con ModeloEquipo
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');  // Relación con User
    }  

        public function Agencia() {
        return $this->belongsTo(Agencia::class, 'id_agencia');
    }


}
 