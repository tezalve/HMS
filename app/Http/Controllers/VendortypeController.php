<?php

namespace App\Http\Controllers;

use App\Models\Vendortype;
use Illuminate\Http\Request;

class VendortypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendortype = Vendortype::all();
        return view('vendortypes.index', compact('vendortype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendortypes.create');
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
            'vendor_type_name' => 'required'
        ]);

        $vendortype = new Vendortype;

        $vendortype->vendor_type_name = $request->vendor_type_name;

        // dd($medicine_generic_name);

        $vendortype->save();

        return redirect()->route('vendortypes.index')
        ->with('success', 'Vendor type name added successfully');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendortype  $vendortype
     * @return \Illuminate\Http\Response
     */
    public function show(Vendortype $vendortype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendortype  $vendortype
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendortype $vendortype)
    {
        return view('vendortypes.edit', compact('vendortype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendortype  $vendortype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendortype $vendortype)
    {
        $validated = $request->validate([
            'vendor_type_name' => 'required'
        ]);

        $vendortype = vendortype::find($vendortype->id);

        $vendortype->vendor_type_name = $request->vendor_type_name;

        // dd($medicine_generic_name);

        $vendortype->save();

        return redirect()->route('vendortypes.index')
        ->with('success', 'Vendor type name Updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendortype  $vendortype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendortype $vendortype)
    {
        $vendortype->delete();

        return redirect()->route('vendortypes.index')
        ->with('success', 'Vendor type name Deleted successfully'); 
    }
}
