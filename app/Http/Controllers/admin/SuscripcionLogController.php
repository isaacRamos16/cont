<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SuscripcionLog;
use Illuminate\Http\Request;

class SuscripcionLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suscripcionlog =SuscripcionLog::all();
        return view('suscripcion_log.index', compact('suscripcion_log'));
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suscripcionlog =SuscripcionLog::all();
        return view('suscripcion_log.create', compact('suscripcion_log'));
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
    public function show(SuscripcionLog $suscripcionLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuscripcionLog $suscripcionLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuscripcionLog $suscripcionLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuscripcionLog $suscripcionLog)
    {
        //
    }
}
