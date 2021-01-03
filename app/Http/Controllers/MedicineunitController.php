<?php

namespace App\Http\Controllers;

use App\Models\Medicineunit;
use Illuminate\Http\Request;

class MedicineunitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicineunit = Medicineunit::all();
        return view('medicineunits.index', compact('medicineunit', $medicineunit));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicineunits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit_name' => 'required'
        ]);

        $medicineunit = new Medicineunit;

        $medicineunit->unit_name = $request->unit_name;

        // dd($medicine_generic_name);

        $medicineunit->save();

        return redirect()->route('medicineunits.index')
        ->with('success', 'Unit Name added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicineunit  $medicineunit
     * @return \Illuminate\Http\Response
     */
    public function show(Medicineunit $medicineunit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicineunit  $medicineunit
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicineunit $medicineunit)
    {
        return view('medicineunits.edit', compact('medicineunit',$medicineunit));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicineunit  $medicineunit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicineunit $medicineunit)
    {
        $validated = $request->validate([
            'unit_name' => 'required'
        ]);

        $medicineunit = Medicineunit::find($medicineunit->id);

        $medicineunit->unit_name = $request->unit_name;

        // dd($medicine_generic_name);

        $medicineunit->save();

        return redirect()->route('medicineunits.index')
        ->with('success', 'Unit Name updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicineunit  $medicineunit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicineunit $medicineunit)
    {
        $medicineunit->delete();
        return redirect()->route('medicineunits.index')
        ->with('success', 'Unit Name Deleted successfully'); 
    }
}
