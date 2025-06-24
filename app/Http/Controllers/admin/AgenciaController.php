<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Agencia;
use App\Models\Cliente;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use Illuminate\Http\Request;

class AgenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $agencias = Agencia::with(['cliente', 'departamento', 'provincia', 'distrito'])->get();
    $clientes = Cliente::all(); // Cargar todos los clientes
    $departamentos = Departamento::all(); 
    $provincias = Provincia::all(); 
    $distritos = Distrito::all(); 

    return view('agencias.index', compact('agencias', 'clientes','departamentos','provincias','distritos'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $departamentos = Departamento::all();
        $provincias = Provincia::all();
        $distritos = Distrito::all();

        return view('agencias.create', compact('clientes', 'departamentos', 'provincias', 'distritos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'id_departamento' => 'required|exists:departamento,id_departamento',
            'id_provincia' => 'required|exists:provincia,id_provincia',
            'id_distrito' => 'required|exists:distrito,id_distrito',
            'direccion' => 'required|string|max:255',
        ]);

        Agencia::create($request->only([
            'id_cliente',
            'id_departamento',
            'id_provincia',
            'id_distrito',
            'direccion',
        ]));

        return redirect()->route('agencias.index')->with('success', 'Agencia registrada correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agencia $agencia)
    {
        $clientes = Cliente::all();
        $departamentos = Departamento::all();
        $provincias = Provincia::all();
        $distritos = Distrito::all();

        return view('agencias.edit', compact('agencia', 'clientes', 'departamentos', 'provincias', 'distritos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agencia $agencia)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'id_departamento' => 'required|exists:departamento,id_departamento',
            'id_provincia' => 'required|exists:provincia,id_provincia',
            'id_distrito' => 'required|exists:distrito,id_distrito',
            'direccion' => 'required|string|max:255',
        ]);

        $agencia->update($request->only([
            'id_cliente',
            'id_departamento',
            'id_provincia',
            'id_distrito',
            'direccion',
        ]));

        return redirect()->route('agencias.index')->with('success', 'Agencia actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agencia $agencia)
    {
        try {
            $agencia->delete();
            return redirect()->route('agencias.index')->with('success', 'Agencia eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('agencias.index')->with('error', 'No se pudo eliminar la agencia.');
        }
    }
}
