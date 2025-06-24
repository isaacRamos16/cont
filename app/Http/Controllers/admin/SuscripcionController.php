<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Suscripcion;
use App\Models\Equipo;
use App\Models\Cliente;
use App\Models\SuscripcionLog;

use Illuminate\Http\Request;

class SuscripcionController extends Controller 
{
    public function index()
    {
        $suscripcion = Suscripcion::all();
        $equipo = Equipo::all();
        $cliente = Cliente::all();
        return view('suscripcion.index', compact('suscripcion','equipo','cliente'));
    }

    public function create()
    {
        $suscripcion = Suscripcion::all();
        $equipo = Equipo::all();
        $cliente = Cliente::all();
        return view('suscripcion.create', compact('suscripcion','equipo','cliente'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'id_equipo' => 'required|exists:equipos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);

        $usuario_id = auth()->user()->id;

        $suscripcion = Suscripcion::create([
            'id_cliente' => $request->id_cliente,
            'id_equipo' => $request->id_equipo,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'activa' => 1,
            'id_usuario_asigno' => $usuario_id,
        ]);

        $this->logSuscripcion($suscripcion, 'Registro de nueva suscripción', $usuario_id);

        return redirect()->route('suscripcion.index')->with('success', 'Suscripción registrada correctamente.');
    }

    protected function logSuscripcion($suscripcion, $comentarios, $usuario_id)
    {
        SuscripcionLog::create([
            'suscripcion_id' => $suscripcion->id,
            'usuario_id' => $usuario_id,
            'comentarios' => $comentarios,
            'fecha_inicio' => $suscripcion->fecha_inicio,
            'fecha_fin' => $suscripcion->fecha_fin,
            'id_cliente' => $suscripcion->id_cliente,
            'id_equipo' => $suscripcion->id_equipo,
            'estado' => (int) $suscripcion->activa,
        ]);
    }

    public function show(Suscripcion $suscripcion)
    {
        //
    }

    public function edit(Suscripcion $suscripcion)
    {
        //
    }
 
    public function update(Request $request, Suscripcion $suscripcion)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'id_equipo' => 'required|exists:equipos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'activa' => 'required|boolean',
        ]);

        $suscripcion->id_cliente = $request->id_cliente;
        $suscripcion->id_equipo = $request->id_equipo;
        $suscripcion->fecha_inicio = $request->fecha_inicio;
        $suscripcion->fecha_fin = $request->fecha_fin;
        $suscripcion->activa = (int) $request->activa;
        $suscripcion->id_usuario_asigno = auth()->user()->id;
        $suscripcion->save();

        $this->logSuscripcion($suscripcion, 'Actualización de suscripción', auth()->user()->id);

        return redirect()->route('suscripcion.index')->with('success', 'Suscripción actualizada correctamente.');
    }

    public function destroy(Suscripcion $suscripcion)
    {
        if (!auth()->user()->es_superadmin) {
            return redirect()->route('suscripcion.index')->with('error', 'No tienes permiso para eliminar suscripciones.');
        }

        $user_id = auth()->user()->id;
        $this->logSuscripcion($suscripcion, 'Eliminación de suscripción', $user_id);
        $suscripcion->delete();

        return redirect()->route('suscripcion.index')->with('success', 'Suscripción eliminada correctamente.');
    }
}
