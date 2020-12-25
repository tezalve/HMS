<?php

namespace App\Http\Controllers;

use App\Models\Barcodeprint;
use Illuminate\Http\Request;

class BarcodeprintController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('labs.barcodeprints.barcodeprint');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barcodeprint  $barcodeprint
     * @return \Illuminate\Http\Response
     */
    public function show(Barcodeprint $barcodeprint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barcodeprint  $barcodeprint
     * @return \Illuminate\Http\Response
     */
    public function edit(Barcodeprint $barcodeprint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barcodeprint  $barcodeprint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barcodeprint $barcodeprint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barcodeprint  $barcodeprint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barcodeprint $barcodeprint)
    {
        //
    }
}
