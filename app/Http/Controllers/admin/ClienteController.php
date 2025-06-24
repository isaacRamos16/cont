<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            
        $clientes = Cliente::all();
        return view('clientes.index', compact( 'clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('clientes.create', compact( 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:clientes,name',
        'ruc' => 'nullable|string|max:20',
        'direccion' => 'nullable|string|max:255',
        'telefono' => 'nullable|string|max:20',
        'email_empresa' => 'nullable|email|max:255',
    ], [
        'name.required' => 'El nombre del cliente es obligatorio.',
        'name.unique' => 'Ya existe un cliente con ese nombre.',
        'email_empresa.email' => 'El correo electrónico no es válido.',
    ]);

    try {
        Cliente::create([
            'name' => $request->name,
            'ruc' => $request->ruc,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email_empresa' => $request->email_empresa,
            'estado' => 1, // Activo por defecto
        ]);

        return redirect()->route('admin.clientes.index')->with('success', 'Cliente registrado exitosamente.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Ocurrió un error al registrar el cliente.');
    }
}

    
    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:clientes,name,' . $cliente->id,
            'ruc' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email_empresa' => 'nullable|email|max:255',
            'estado' => 'required|boolean',
        ]);
    
        $cliente->update($request->all());
    
        return redirect()->route('admin.clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();
            return redirect()->route('admin.clientes.index')->with('success', 'Cliente eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.clientes.index')->with('error', 'No se pudo eliminar el cliente.');
        }
    }
    
}
