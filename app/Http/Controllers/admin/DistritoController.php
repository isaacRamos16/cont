<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Distrito;
use App\Models\Provincia;
use Illuminate\Http\Request;

class DistritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $distritos = Distrito::with('provincia')->get();
        $provincias = Provincia::all();
        return view('distrito.index', compact('distritos', 'provincias'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $distritos = Distrito::with('provincia')->get();
        $provincias = Provincia::all();
        return view('distrito.create', compact('distritos', 'provincias'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'distrito' => 'required|string|max:255|unique:distrito,distrito',
        'id_provincia' => 'required|exists:provincia,id_provincia',
    ]);

    Distrito::create([
        'distrito' => strtoupper($request->distrito),
        'id_provincia' => $request->id_provincia,
    ]);

    return redirect()->route('distrito.index')->with('success', 'Distrito registrado correctamente.');
}


    /**
     * Display the specified resource.
     */
    public function show(Distrito $distrito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Distrito $distrito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
    {
        $request->validate([
            'distrito' => 'required|string|max:255|unique:distrito,distrito,' . $id . ',id_distrito',
            'id_provincia' => 'required|exists:provincia,id_provincia',
        ]);

        $distrito = Distrito::findOrFail($id);
        $distrito->update([
            'distrito' => strtoupper($request->distrito),
            'id_provincia' => $request->id_provincia,
        ]);

        return redirect()->route('distrito.index')->with('success', 'Distrito actualizado correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distrito $distrito)
    {
        //
    }
}