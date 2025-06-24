<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ModeloEquipo;
use Illuminate\Http\Request;

class ModeloEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modelo_equipo = ModeloEquipo::all();

        return view('modelo_equipo.index', compact('modelo_equipo'));
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modelo_equipo = ModeloEquipo::all();

        return view('modelo_equipo.create', compact('modelo_equipo'));
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
{
    $request->validate([
        'nombre_modelo' => 'required|string|max:255',
    ]);

    ModeloEquipo::create([
        'nombre_modelo' => $request->nombre_modelo,
    ]);

    return redirect()->route('modelo_equipo.index')->with('success', 'Modelo de equipo registrado correctamente.');
}


    /**
     * Display the specified resource.
     */
    public function show(ModeloEquipo $modeloEquipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModeloEquipo $modeloEquipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, $id){
    $request->validate([
        'nombre_modelo' => 'required|string|max:255',
    ]);

    $modelo = ModeloEquipo::findOrFail($id);
    $modelo->nombre_modelo = $request->nombre_modelo;
    $modelo->save();

    return redirect()->route('modelo_equipo.index')->with('success', 'Modelo actualizado correctamente.');
}


    /**
     * Remove the specified resource from storage.
     */
     public function destroy($id_modelo) {
            try {
                $modeloEquipo = ModeloEquipo::findOrFail($id_modelo);
                $modeloEquipo->delete();

                return redirect()->route('modelo_equipo.index')->with('success', 'Modelo de equipo eliminado correctamente.');
            } catch (\Exception $e) {
                return redirect()->route('modelo_equipo.index')->with('error', 'No se pudo eliminar el modelo de equipo.');
            }
        }

}
