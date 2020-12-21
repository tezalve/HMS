<?php

namespace App\Http\Controllers;

use App\Models\Diagnosticreportview;
use Illuminate\Http\Request;

class DiagnosticreportviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $doctors = $request->doctor;
		dd($doctors);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diagnosticreportview  $diagnosticreportview
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnosticreportview $diagnosticreportview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diagnosticreportview  $diagnosticreportview
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnosticreportview $diagnosticreportview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diagnosticreportview  $diagnosticreportview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnosticreportview $diagnosticreportview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diagnosticreportview  $diagnosticreportview
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnosticreportview $diagnosticreportview)
    {
        //
    }
}
