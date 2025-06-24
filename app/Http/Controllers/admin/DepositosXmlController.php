<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DepositosXml;
use Illuminate\Http\Request;

class DepositosXmlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DepositosXml $depositosXml)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DepositosXml $depositosXml)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DepositosXml $depositosXml)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DepositosXml $depositosXml)
    {
        //
    }

    public function mostrarDepositosPorEquipo($id)
{
    $depositos = DepositosXml::where('id_equipo', $id)->orderBy('fecha_generada', 'desc')->get();
    return view('equipo.partials.depositos', compact('depositos'));
}



}
