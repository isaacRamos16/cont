<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    protected $table = 'suscripciones';
    protected $primaryKey = 'id';  // Define la clave primaria correctamente

    protected $fillable = [
        'id_equipo',
        'id_cliente',
        'fecha_inicio',
        'fecha_fin',
        'activa',
        'id_usuario_asigno',
     


    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo');
    }

    /**
     * Relación: una suscripción pertenece a un cliente.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    /**
     * Relación: una suscripción es asignada por un usuario.
     */
    public function usuarioAsignado()
    {
        return $this->belongsTo(User::class, 'id_usuario_asigno');
    }
}
 