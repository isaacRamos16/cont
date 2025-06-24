<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuscripcionLog extends Model
{
    protected $table = 'suscripcion_logs';
    protected $primaryKey = 'id';  // Define la clave primaria correctamente

    protected $fillable = [
        'suscripcion_id',
        'usuario_id',
        'comentarios',
        'fecha_inicio',
        'fecha_fin',
        'id_cliente',
        'id_equipo',
        'estado', // ✅ Asegúrate que esté aquí
    ];

    public $timestamps = false;
      /**
     * Relación: un log de suscripción pertenece a una suscripción.
     */
    public function suscripcion()
    {
        return $this->belongsTo(Suscripcion::class, 'suscripcion_id');
    }

    /**
     * Relación: un log de suscripción pertenece a un usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Relación: un log de suscripción pertenece a un cliente.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    /**
     * Relación: un log de suscripción pertenece a un equipo.
     */
    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo');
    }
}
