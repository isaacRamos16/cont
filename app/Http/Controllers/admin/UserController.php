<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cargo;
use App\Models\Cliente;
use App\Models\Agencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



class UserController extends Controller
{
    use AuthorizesRequests;

   public function index() 
{
    $auth = auth()->user();

    $usuarios = User::with(['cliente', 'cargo'])->get();
    $cargo = Cargo::all();
    $cliente = Cliente::all();

    // 🔄 Aquí agregas o reemplazas esta línea
    $agencias = Agencia::select('id_agencia', 'direccion', 'id_cliente')->get();

    return view('usuarios.index', compact('usuarios', 'cargo', 'cliente', 'agencias'));
}


   public function create()
            {
                $auth = auth()->user();

                $clientes = Cliente::all();
                $agencias = Agencia::all();
                $cargos = Cargo::all();

                return view('usuarios.create', compact('clientes', 'agencias', 'cargos'));
            }


   public function store(Request $request)
{
    $auth = auth()->user();

    if ($auth->cargo->descripcion === 'Cajero') {
        abort(403);
    }

    if (!$auth->es_superadmin) {
        $request->merge([
            'id_cliente' => $auth->id_cliente,
            'es_superadmin' => 0
        ]);
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:6',
        'id_cliente' => 'required|exists:clientes,id',
        'id_cargo' => 'required|exists:cargos,id',
        'id_agencia' => 'required|exists:agencias,id_agencia',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'id_cliente' => $request->id_cliente,
        'id_cargo' => $request->id_cargo,
        'id_agencia' => $request->id_agencia,
        'estado' => 0,
        'es_superadmin' => $request->es_superadmin ?? 0,
    ]);

    return redirect()->route('usuarios.index')
        ->with('success', 'Usuario creado correctamente (pendiente de activación).');
}



public function update(Request $request, User $usuarios)
{
    $this->authorize('update', $usuarios); // Ya valida según tu política

    $rules = [
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            'max:255',
            Rule::unique('users')->ignore($usuarios->id),
        ],
        'password' => 'nullable|string|min:6',
        'id_cliente' => 'required|exists:clientes,id',
        'id_cargo' => 'required|exists:cargos,id',
        'id_agencia' => 'required|exists:agencias,id_agencia',
        'estado' => 'required|boolean',
    ];

    $validated = $request->validate($rules);

    $usuarios->name = $validated['name'];
    $usuarios->email = $validated['email'];
    $usuarios->id_cliente = $validated['id_cliente'];
    $usuarios->id_cargo = $validated['id_cargo'];
    $usuarios->id_agencia = $validated['id_agencia'];
    $usuarios->estado = $validated['estado'];

    if (!empty($validated['password'])) {
        $usuarios->password = Hash::make($validated['password']);
    }

    $usuarios->save();

    return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
}




    public function destroy(User $usuarios)
    {
        $auth = auth()->user();

        if (!$auth->es_superadmin) {
            abort(403, 'No tienes permiso para eliminar usuarios.');
        }

        try {
            $usuarios->delete();
            return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('usuarios.index')->with('error', 'No se pudo eliminar el usuario.');
        }
    }

    public function activar(User $usuarios)
    {
        if (!auth()->user()->es_superadmin) {
            return redirect()->route('usuarios.index')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $usuarios->estado = 1;
        $usuarios->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario activado correctamente.');
    }
}
