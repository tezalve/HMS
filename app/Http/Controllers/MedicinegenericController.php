<?php

namespace App\Http\Controllers;

use App\Models\Medicinegeneric;
use Illuminate\Http\Request;

class MedicinegenericController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicinegeneric = Medicinegeneric::all();
        return view('medicinegenerics.index', compact('medicinegeneric', $medicinegeneric));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicinegenerics.create');
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
            'generic_name' => 'required'
        ]);

        $medicinegeneric = new Medicinegeneric;

        $medicinegeneric->generic_name = $request->generic_name;

        // dd($medicine_generic_name);

        $medicinegeneric->save();

        return redirect()->route('medicinegenerics.index')
        ->with('success', 'Generic name added successfully');  

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicinegeneric  $medicinegeneric
     * @return \Illuminate\Http\Response
     */
    public function show(Medicinegeneric $medicinegeneric)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicinegeneric  $medicinegeneric
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicinegeneric $medicinegeneric)
    {
        return view('medicinegenerics.edit', compact('medicinegeneric',$medicinegeneric));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicinegeneric  $medicinegeneric
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicinegeneric $medicinegeneric)
    {
        $validated = $request->validate([
            'generic_name' => 'required'
        ]);

        $medicinegeneric = Medicinegeneric::find($medicinegeneric->id);

        $medicinegeneric->generic_name = $request->generic_name;

        // dd($medicine_generic_name);

        $medicinegeneric->save();

        return redirect()->route('medicinegenerics.index')
        ->with('success', 'Generic name updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicinegeneric  $medicinegeneric
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicinegeneric $medicinegeneric)
    {
        $medicinegeneric->delete();
        return redirect()->route('medicinegenerics.index')
        ->with('success', 'Generic name deleted successfully'); 
    }
}
