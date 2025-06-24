<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\admin\ClienteController;
use App\Http\Controllers\admin\CargoController;
use App\Http\Controllers\admin\DepartamentoController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\EquipoController;
use App\Http\Controllers\admin\ModeloEquipoController;
use App\Http\Controllers\admin\ProvinciaController;
use App\Http\Controllers\admin\SuscripcionController;
use App\Http\Controllers\admin\SuscripcionLogController;
use App\Http\Controllers\admin\AgenciaController;
use App\Http\Controllers\admin\DistritoController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::resource('clientes', ClienteController::class);
    Route::resource('cargo', CargoController::class);
    Route::resource('usuarios', UserController::class)->parameters([
        'usuarios' => 'usuarios'
    ]);

    Route::resource('equipo', EquipoController::class);

    // ✅ Rutas específicas para acciones XML → van primero
    Route::get('equipo/{id}/xml', [EquipoController::class, 'verXmlPorEquipo'])->name('equipo.xml');
    Route::get('equipo/{id}/procesar-xml', [EquipoController::class, 'procesarXmlPorEquipo'])->name('equipo.procesar_xml');
    Route::get('equipo/{id}/cargar-datos', [EquipoController::class, 'cargarDatosXml']);

Route::get('equipo/partial/depositos', [EquipoController::class, 'partialDepositos']);
Route::get('/equipo/partial/retiros', [EquipoController::class, 'partialRetiros']);
Route::get('/equipo/partial/eventos', [EquipoController::class, 'partialEventos']);
Route::get('/equipo/partial/cierres', [EquipoController::class, 'partialCierres']);


Route::get('equipo/partial/xmls/{serie}', [EquipoController::class, 'partialXmls']);
Route::get('equipo/xml/descargar/{serie}/{archivo}', [EquipoController::class, 'descargarXml'])->name('descargar.xml');


    // ⚠️ ESTA VA AL FINAL para evitar colisiones

    Route::resource('modelo_equipo', ModeloEquipoController::class);
    Route::resource('suscripcion', SuscripcionController::class);
    Route::resource('suscripcion_log', SuscripcionLogController::class);
    Route::resource('departamento', DepartamentoController::class);
    Route::resource('provincia', ProvinciaController::class);
    Route::resource('agencias', AgenciaController::class);
    Route::resource('distrito', DistritoController::class);

    



    
});


require __DIR__.'/auth.php'; 
