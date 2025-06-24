<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Equipo;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Agencia;
use App\Models\ModeloEquipo;
use SimpleXMLElement;
use Illuminate\Support\Facades\Storage; // ✅ <-- AGREGA ESTA LÍNEA
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\CierreTurno;
use App\Models\DepositosXml;
use App\Models\EventosEquipo;
use App\Models\RetirosDeposito;
use Illuminate\Support\Facades\Log;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index() 
        {
            $auth = auth()->user();

            $equipos = Equipo::all();
            $clientes = Cliente::all();
            $modelo_equipo = ModeloEquipo::all();
            $agencias = Agencia::select('id_agencia', 'direccion', 'id_cliente')->get(); // 👈 importante

            return view('equipo.index', compact('equipos', 'clientes', 'modelo_equipo', 'agencias'));
        }


    
    /**
     * Show the form for creating a new resource.
     */
     public function create()
        {
           
            $clientes = Cliente::all(); 
            $modelo_equipo = ModeloEquipo::all(); 
            
            return view('equipo.create', compact('clientes','modelo_equipo'));
        }


    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
{
    $request->validate([
        'nombre_equipo' => 'required|string|max:255',
        'numero_serie' => 'required|string|max:100',
        'id_cliente' => 'required|exists:clientes,id',
        'id_modelo' => 'required|exists:modelo_equipo,id_modelo',
    ]);

    // Obtén el id del usuario en sesión
    $user_id = auth()->user()->id;

    // Crea el nuevo equipo
    Equipo::create([
        'nombre_equipo' => $request->nombre_equipo,
        'numero_serie' => $request->numero_serie,
        'id_cliente' => $request->id_cliente,
        'id_modelo' => $request->id_modelo,
        'id_usuario' => $user_id,  // Asegúrate de guardar el id del usuario
    ]);

    return redirect()->route('equipo.index')->with('success', 'Equipo registrado correctamente.');
}


    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipo $equipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Equipo $equipo)
{
    // Validación de los datos
$request->validate([
    'nombre_equipo' => 'required|string|max:255',
    'serie_equipo' => 'required|string|max:100',
    'id_cliente' => 'required|exists:clientes,id',
    'id_modelo' => 'required|exists:modelo_equipo,id_modelo',
    'id_agencia' => 'required|exists:agencias,id_agencia', // ✅ AÑADIDO
]);

    // Obtener el ID del usuario que está editando
    $user_id = auth()->user()->id;

    // Actualizar el equipo con los nuevos datos y también el id_usuario
    $equipo->update([
    'nombre_equipo' => $request->nombre_equipo,
    'numero_serie' => $request->serie_equipo,
    'id_cliente' => $request->id_cliente,
    'id_modelo' => $request->id_modelo,
    'id_agencia' => $request->id_agencia, // ✅ AÑADIDO
    'id_usuario' => $user_id,
]);


    return redirect()->route('equipo.index')->with('success', 'Equipo actualizado correctamente.');
}


    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Equipo $equipo)
{
    // Verifica si el usuario tiene permisos para eliminar el equipo
    if (auth()->user()->es_superadmin || auth()->user()->id_cliente === $equipo->id_cliente) {
        // Eliminar el equipo
        $equipo->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('equipo.index')->with('success', 'Equipo eliminado correctamente.');
    } else {
        // Si el usuario no tiene permisos
        return redirect()->route('equipo.index')->with('error', 'No tienes permisos para eliminar este equipo.');
    }
}





public function procesarXmlPorEquipo($id)
{
    $equipo = Equipo::with(['cliente', 'modeloEquipo', 'agencia'])->findOrFail($id);

    // NO ejecutamos consultas pesadas aquí
    return view('equipo.xml', compact('equipo'));
}



public function cargarDatosXml(Request $request, $id)
{
    $equipo = Equipo::findOrFail($id);

    $fechaInicio = $request->input('fecha_inicio');
    $fechaFin = $request->input('fecha_fin');

    // Aplicar filtros si están presentes
    $filtroFechas = function ($query) use ($fechaInicio, $fechaFin) {
        if ($fechaInicio) {
            $query->whereDate('created_at', '>=', $fechaInicio);
        }
        if ($fechaFin) {
            $query->whereDate('created_at', '<=', $fechaFin);
        }
    };

    // DEPÓSITOS
    $totales = DB::table('depositos_xml')
        ->select('moneda', DB::raw('SUM(total) as total'))
        ->where('id_equipo', $id)
        ->when($fechaInicio || $fechaFin, $filtroFechas)
        ->groupBy('moneda')
        ->pluck('total', 'moneda');

    // RETIROS
    $retiros = DB::table('retiros_deposito')
        ->select('moneda', DB::raw('SUM(total) as total'))
        ->where('id_equipo', $id)
        ->when($fechaInicio || $fechaFin, $filtroFechas)
        ->groupBy('moneda')
        ->pluck('total', 'moneda');

    // EVENTOS
    $eventos = DB::table('eventos_equipo')
        ->select('function', DB::raw('COUNT(*) as total'))
        ->where('id_equipo', $id)
        ->when($fechaInicio || $fechaFin, $filtroFechas)
        ->groupBy('function')
        ->pluck('total', 'function');

    // CIERRES DE TURNO
    $cierres = DB::table('cierres_turno')
        ->where('id_equipo', $id)
        ->when($fechaInicio || $fechaFin, $filtroFechas)
        ->count();

    // XMLs en FTP (NO afecta filtro)
    $totalXml = 0;
    if (Storage::disk('ftp_kisan')->exists($equipo->numero_serie)) {
        $archivos = Storage::disk('ftp_kisan')->files($equipo->numero_serie);
        $totalXml = collect($archivos)
            ->filter(fn($archivo) => strtolower(pathinfo($archivo, PATHINFO_EXTENSION)) === 'xml')
            ->count();
    }

    return view('equipo.partials.cargar-datos', compact('totales', 'retiros', 'eventos', 'cierres', 'totalXml', 'equipo'));
}




public function partialDepositos(Request $request)
{
    try {
        $query = DepositosXml::with('equipo')->orderBy('id', 'desc');

        if ($request->filled(['fecha_inicio', 'fecha_fin'])) {
            $query->whereBetween('fecha_generada', [
                $request->fecha_inicio . ' 00:00:00',
                $request->fecha_fin . ' 23:59:59'
            ]);
        }

        $depositos = $query->take(100)->get();

        return view('equipo.partials.depositos', compact('depositos'));
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al cargar depósitos: ' . $e->getMessage()], 500);
    }
}


public function partialRetiros(Request $request)
{
    try {
        $query = RetirosDeposito::with('equipo')->whereHas('equipo');

        // ✅ Aplicar filtro por fecha si se envía en el request
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('created_at', [
                $request->fecha_inicio . ' 00:00:00',
                $request->fecha_fin . ' 23:59:59'
            ]);
        }

        $retiros = $query->orderByDesc('id')->limit(300)->get();

        return view('equipo.partials.retiros', compact('retiros'));
    } catch (\Exception $e) {
        \Log::error('❌ Error en partialRetiros: ' . $e->getMessage());
        return response()->json(['error' => 'Error al cargar retiros: ' . $e->getMessage()], 500);
    }
}


public function partialEventos(Request $request)
{
    try {
        $query = EventosEquipo::with('equipo')->whereHas('equipo');

        // ✅ Filtro opcional por rango de fechas
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('created_at', [
                $request->fecha_inicio . ' 00:00:00',
                $request->fecha_fin . ' 23:59:59'
            ]);
        }

        $eventos = $query->orderByDesc('id')->limit(300)->get();

        return view('equipo.partials.eventos', compact('eventos'));
    } catch (\Exception $e) {
        \Log::error('❌ Error en partialEventos: ' . $e->getMessage());
        return response()->json(['error' => 'Error al cargar eventos: ' . $e->getMessage()], 500);
    }
}

public function partialCierres(Request $request)
{
    try {
        $query = CierreTurno::with('equipo');

        // ✅ Filtrar por rango de fechas si están presentes
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('created_at', [
                $request->fecha_inicio . ' 00:00:00',
                $request->fecha_fin . ' 23:59:59'
            ]);
        }

        $cierres = $query->orderByDesc('id')->limit(300)->get();

        return view('equipo.partials.cierres', compact('cierres'));

    } catch (\Exception $e) {
        \Log::error('❌ Error en partialCierres: ' . $e->getMessage());
        return response()->json(['error' => 'Error al cargar cierres: ' . $e->getMessage()], 500);
    }
}



public function partialXmls($serie)
{
    \Log::debug("🚀 Entrando a partialXmls con serie: $serie");

    try {
        if (!Storage::disk('ftp_kisan')->exists($serie)) {
            \Log::debug("❌ Carpeta no encontrada: $serie");
            return view('equipo.partials.xmls', [
                'mensaje' => "❌ Carpeta no encontrada: $serie",
                'archivosXml' => [],
            ]);
        }

        $archivos = Storage::disk('ftp_kisan')->files($serie);
        \Log::debug("🧾 Archivos encontrados: ", $archivos);

        $archivosXml = collect($archivos)
            ->filter(fn($file) => strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'xml')
            ->map(fn($file) => [
                'nombre' => basename($file),
                'ruta' => $file,
                'serie' => $serie
            ])
            ->values()
            ->toArray();

        return view('equipo.partials.xmls', [
            'mensaje' => "✅ Archivos XML encontrados: " . count($archivosXml),
            'archivosXml' => $archivosXml
        ]);

    } catch (\Exception $e) {
        \Log::channel('xml_debug')->error("❌ Error al procesar XMLs para $serie: " . $e->getMessage());
        return response()->json(['error' => 'Error al cargar archivos XML: ' . $e->getMessage()], 500);
    }
}

public function descargarXml($serie, $archivo)
{
    try {
        $ruta = "$serie/$archivo";

        if (!Storage::disk('ftp_kisan')->exists($ruta)) {
            abort(404, 'Archivo no encontrado en el FTP');
        }

        $stream = Storage::disk('ftp_kisan')->readStream($ruta);
        return response()->streamDownload(function () use ($stream) {
            fpassthru($stream);
        }, $archivo);
    } catch (\Exception $e) {
        \Log::error("❌ Error al descargar XML [$serie/$archivo]: " . $e->getMessage());
        return abort(500, 'Error al descargar el archivo XML.');
    }
}



}
 