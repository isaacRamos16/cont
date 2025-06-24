<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserAccess 
{
    /**
     * Maneja el acceso según el tipo de usuario (rol/cargo).
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Si el usuario es Cajero
        if ($user && $user->cargo && $user->cargo->descripcion === 'Cajero') {
            
            // Bloquea acceso a index, create, destroy
            if (
                $request->routeIs('usuarios.index') ||
                $request->routeIs('usuarios.create') ||
                $request->routeIs('usuarios.destroy') ||
                $request->is('usuarios') || // por si accede directo a /usuarios
                $request->is('usuarios/create')
            ) {
                return redirect()->route('usuarios.edit', $user->id)
                                 ->with('error', 'No tienes permiso para acceder a esta sección.');
            }
        }

        return $next($request);
    }
}
