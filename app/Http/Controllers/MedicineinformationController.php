<?php

namespace App\Http\Controllers;

use App\Models\{ Medicineinformation, Medicinegeneric, Medicinegroup, Medicinecompanyinfo, Medicineunit };
use Illuminate\Http\Request;

class MedicineinformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicineinformation = Medicineinformation::all();
        return view('medicineinformations.index', compact('medicineinformation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medicine_generic_names_id = Medicinegeneric::all();
        $medicine_groups_id = Medicinegroup::all();
        $medicine_company_infos_id = Medicinecompanyinfo::all();
        $medicine_units_id = Medicineunit::all();
        return view('medicineinformations.create',compact('medicine_generic_names_id', 'medicine_groups_id', 'medicine_company_infos_id', 'medicine_units_id'));
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
            'medicine_name' => 'required',
            'mrp' => 'required',
            'tp' => 'required',
            'default_discount' => 'required',
            'default_vat' => 'required',
            'medicine_generic_names_id' => 'required',
            'medicine_groups_id' => 'required',
            'medicine_company_infos_id' => 'required',
            'medicine_units_id' => 'required'
        ]);

        $medicineinformation = new medicineinformation;
        $medicineinformation->medicine_name = $request->medicine_name;
        $medicineinformation->mrp = $request->mrp;
        $medicineinformation->tp = $request->tp;
        $medicineinformation->default_discount = $request->default_discount;
        $medicineinformation->default_vat = $request->default_vat;
        $medicineinformation->medicine_generic_names_id = $request->medicine_generic_names_id;
        $medicineinformation->medicine_groups_id = $request->medicine_groups_id;
        $medicineinformation->medicine_company_infos_id = $request->medicine_company_infos_id;
        $medicineinformation->medicine_units_id = $request->medicine_units_id;

        // dd($medicine_generic_name);

        $medicineinformation->save();

        return redirect()->route('medicineinformations.index')
        ->with('success', 'Company added successfully');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicineinformation  $medicineinformation
     * @return \Illuminate\Http\Response
     */
    public function show(Medicineinformation $medicineinformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicineinformation  $medicineinformation
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicineinformation $medicineinformation)
    {
        $medicine_generic_names_id = Medicinegeneric::all();
        $medicine_groups_id = Medicinegroup::all();
        $medicine_company_infos_id = Medicinecompanyinfo::all();
        $medicine_units_id = Medicineunit::all();
        return view('medicineinformations.create',compact('medicineinformation', 'medicine_generic_names_id', 'medicine_groups_id', 'medicine_company_infos_id', 'medicine_units_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicineinformation  $medicineinformation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicineinformation $medicineinformation)
    {
        $validated = $request->validate([
            'medicine_name' => 'required',
            'mrp' => 'required',
            'tp' => 'required',
            'default_discount' => 'required',
            'default_vat' => 'required',
            'medicine_generic_names_id' => 'required',
            'medicine_groups_id' => 'required',
            'medicine_company_infos_id' => 'required',
            'medicine_units_id' => 'required'
        ]);

        $medicineinformation = medicineinformation::find($medicineinformation->id);
        $medicineinformation->medicine_name = $request->medicine_name;
        $medicineinformation->mrp = $request->mrp;
        $medicineinformation->tp = $request->tp;
        $medicineinformation->default_discount = $request->default_discount;
        $medicineinformation->default_vat = $request->default_vat;
        $medicineinformation->medicine_generic_names_id = $request->medicine_generic_names_id;
        $medicineinformation->medicine_groups_id = $request->medicine_groups_id;
        $medicineinformation->medicine_company_infos_id = $request->medicine_company_infos_id;
        $medicineinformation->medicine_units_id = $request->medicine_units_id;

        // dd($medicineinformation);

        $medicineinformation->save();

        return redirect()->route('medicineinformations.index')
        ->with('success', 'Company updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicineinformation  $medicineinformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicineinformation $medicineinformation)
    {
        $medicineinformation->delete();
        return redirect()->route('medicineinformations.index')
        ->with('success', 'Company deleted successfully'); 
    }
}