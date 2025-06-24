<?php

namespace App\Http\Controllers\admin; 

use App\Http\Controllers\Controller;
use App\Models\Provincia;
use App\Models\Departamento;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamento = Departamento::all();
        $provincia = Provincia::all();
        return view('provincia.index', compact( 'provincia','departamento'));
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departamento = Departamento::all();
        $provincia = Provincia::all();
        return view('provincia.create', compact( 'provincia','departamento'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'provincia' => 'required|string|max:255|unique:provincia,provincia',
            'id_departamento' => 'required|exists:departamento,id_departamento',
        ]);
    
        Provincia::create([
            'provincia' => strtoupper($request->provincia),
            'id_departamento' => $request->id_departamento,
        ]);
    
        return redirect()->route('provincia.index')->with('success', 'Provincia registrada correctamente.');
    }
    
    
    

    /**
     * Display the specified resource.
     */
    public function show(Provincia $provincia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provincia $provincia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $request->validate([
        'provincia' => 'required|string|max:255|unique:provincia,provincia,' . $id . ',id_provincia',
        'id_departamento' => 'required|exists:departamento,id_departamento',
    ]);

    $provincia = Provincia::findOrFail($id);
    $provincia->update([
        'provincia' => strtoupper($request->provincia),
        'id_departamento' => $request->id_departamento,
    ]);

    return redirect()->route('provincia.index')->with('success', 'Provincia actualizada correctamente.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provincia $provincia)
    {
        //
    }
}
