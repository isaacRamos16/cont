<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamento = Departamento::all();
        return view('departamento.index', compact( 'departamento'));
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departamento = Departamento::all();
        return view('departamento.create', compact( 'departamento'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'departamento' => 'required|string|max:255|unique:departamento,departamento',
        ]);
    
        Departamento::create([
            'departamento' => $request->departamento,
        ]);
    
        return redirect()->route('departamento.index')->with('success', 'Departamento registrado correctamente.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Departamento $departamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departamento $departamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
    {
        $request->validate([
            'departamento' => 'required|string|max:255|unique:departamento,departamento,' . $id . ',id_departamento',
        ]);

        $departamento = Departamento::findOrFail($id);
        $departamento->departamento = $request->departamento;
        $departamento->save();

        return redirect()->route('departamento.index')->with('success', 'Departamento actualizado correctamente.');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departamento $departamento)
    {
        try {
            $departamento->delete();
            return redirect()->route('departamento.index')->with('success', 'Departamento eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('departamento.index')->with('error', 'No se pudo eliminar el departamento.');
        }
    }
    
}
