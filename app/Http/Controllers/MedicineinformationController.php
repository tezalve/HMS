<?php

namespace App\Http\Controllers;

use App\Models\Medicineinformation;
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
        return view('medicineinformations.index', compact('medicineinformation', $medicineinformation));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicineinformations.create');
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
            'company_name' => 'required',
            'address' => 'required',
            'contact_number' => 'required',
            'contact_person' => 'required',
            'default_discount' => 'required',
            'default_vat' => 'required',
            'users_id' => 'required',
        ]);

        $medicineinformation = new medicineinformation;
        $medicineinformation->company_name = $request->company_name;
        $medicineinformation->address = $request->address;
        $medicineinformation->contact_number = $request->contact_number;
        $medicineinformation->contact_person = $request->contact_person;
        $medicineinformation->default_discount = $request->default_discount;
        $medicineinformation->default_vat = $request->default_vat;
        $medicineinformation->users_id = $request->users_id;

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
        return view('medicineinformations.edit', compact('medicineinformation',$medicineinformation));
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
            'company_name' => 'required',
            'address' => 'required',
            'contact_number' => 'required',
            'contact_person' => 'required',
            'default_discount' => 'required',
            'default_vat' => 'required',
            'users_id' => 'required',
        ]);

        $medicineinformation = medicineinformation::find($medicineinformation->id);
        $medicineinformation->company_name = $request->company_name;
        $medicineinformation->address = $request->address;
        $medicineinformation->contact_number = $request->contact_number;
        $medicineinformation->contact_person = $request->contact_person;
        $medicineinformation->default_discount = $request->default_discount;
        $medicineinformation->default_vat = $request->default_vat;
        $medicineinformation->users_id = $request->users_id;

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
