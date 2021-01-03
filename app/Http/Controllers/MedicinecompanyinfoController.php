<?php

namespace App\Http\Controllers;

use App\Models\{ Medicinecompanyinfo, User };
use Illuminate\Http\Request;

class MedicinecompanyinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicinecompanyinfo = Medicinecompanyinfo::all();
        return view('medicinecompanyinfos.index', compact('medicinecompanyinfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users_id = User::all();
        return view('medicinecompanyinfos.create', compact('users_id'));
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

        $medicinecompanyinfo = new Medicinecompanyinfo;
        $medicinecompanyinfo->company_name = $request->company_name;
        $medicinecompanyinfo->address = $request->address;
        $medicinecompanyinfo->contact_number = $request->contact_number;
        $medicinecompanyinfo->contact_person = $request->contact_person;
        $medicinecompanyinfo->default_discount = $request->default_discount;
        $medicinecompanyinfo->default_vat = $request->default_vat;
        $medicinecompanyinfo->users_id = $request->users_id;

        // dd($medicine_generic_name);

        $medicinecompanyinfo->save();

        return redirect()->route('medicinecompanyinfos.index')
        ->with('success', 'Company added successfully');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicinecompanyinfo  $medicinecompanyinfo
     * @return \Illuminate\Http\Response
     */
    public function show(Medicinecompanyinfo $medicinecompanyinfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicinecompanyinfo  $medicinecompanyinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicinecompanyinfo $medicinecompanyinfo)
    {
        return view('medicinecompanyinfos.edit', compact('medicinecompanyinfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicinecompanyinfo  $medicinecompanyinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicinecompanyinfo $medicinecompanyinfo)
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

        $medicinecompanyinfo = Medicinecompanyinfo::find($medicinecompanyinfo->id);
        $medicinecompanyinfo->company_name = $request->company_name;
        $medicinecompanyinfo->address = $request->address;
        $medicinecompanyinfo->contact_number = $request->contact_number;
        $medicinecompanyinfo->contact_person = $request->contact_person;
        $medicinecompanyinfo->default_discount = $request->default_discount;
        $medicinecompanyinfo->default_vat = $request->default_vat;
        $medicinecompanyinfo->users_id = $request->users_id;

        // dd($medicinecompanyinfo);

        $medicinecompanyinfo->save();

        return redirect()->route('medicinecompanyinfos.index')
        ->with('success', 'Company updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicinecompanyinfo  $medicinecompanyinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicinecompanyinfo $medicinecompanyinfo)
    {
        $medicinecompanyinfo->delete();
        return redirect()->route('medicinecompanyinfos.index')
        ->with('success', 'Company deleted successfully'); 
    }
}