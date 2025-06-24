<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cargos = Cargo::all();
        return view('cargo.index', compact('cargos'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cargo = Cargo::all();
        return view('cargo.create', compact( 'cargo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255|unique:cargos,descripcion',
        ], [
            'descripcion.required' => 'La descripción del cargo es obligatoria.',
            'descripcion.unique' => 'Ya existe un cargo con esa descripción.',
        ]);
    
        Cargo::create([
            'descripcion' => $request->descripcion
        ]);
    
        return redirect()->route('cargo.index')->with('success', 'Cargo registrado correctamente.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Cargo $cargo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cargo $cargo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cargo $cargo)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255|unique:cargos,descripcion,' . $cargo->id,
        ]);
    
        $cargo->update([
            'descripcion' => $request->descripcion
        ]);
    
        return redirect()->route('cargo.index')->with('success', 'Cargo actualizado correctamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cargo $cargo)
    {
        try {
            $cargo->delete();
            return redirect()->route('cargo.index')->with('success', 'Cargo eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('cargo.index')->with('error', 'No se pudo eliminar el cargo.');
        }
    }
    
}
