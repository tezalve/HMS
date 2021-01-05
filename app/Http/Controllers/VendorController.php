<?php

namespace App\Http\Controllers;

use App\Models\{ Vendor, Vendortype, User };
use Illuminate\Http\Request;
use DataTables;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Vendor::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="" class="edit btn btn-primary btn-sm">View</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        } 
        return view('vendors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendor_type_id = Vendortype::all();
        $users_id = User::all();
        $user = auth()->user();
        return view('vendors.create',compact('vendor_type_id'))->with('users', $user->id);
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
            'vendor_name' => 'required',
            'contact_number' => 'required',
            'email' => 'required',
            'address' => 'required',
            'contact_person' => 'required',
            'vendor_type_id' => 'required',
            'users_id' => 'required'
        ]);

        $vendor = new vendor;
        $vendor->vendor_name = $request->vendor_name;
        $vendor->contact_number = $request->contact_number;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->contact_person = $request->contact_person;
        $vendor->vendor_type_id = $request->vendor_type_id;
        $vendor->users_id = $request->users_id;

        // dd($medicine_generic_name);

        $vendor->save();

        return redirect()->route('vendors.index')
        ->with('success', 'vendor added successfully'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        $vendor_type_id = vendortype::all();
        return view('vendors.edit',compact('vendor','vendor_type_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        $validated = $request->validate([
            'vendor_name' => 'required',
            'contact_number' => 'required',
            'email' => 'required',
            'address' => 'required',
            'contact_person' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required',
            'vendor_type_id' => 'required',
            'users_id' => 'required'
        ]);

        $vendor = vendor::find($vendor->id);
        $vendor->vendor_name = $request->vendor_name;
        $vendor->contact_number = $request->contact_number;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->contact_person = $request->contact_person;
        $vendor->created_at = $request->created_at;
        $vendor->updated_at = $request->updated_at;
        $vendor->vendor_type_id = $request->vendor_type_id;
        $vendor->users_id = $request->users_id;

        // dd($vendor);

        $vendor->save();

        return redirect()->route('vendors.index')
        ->with('success', 'vendor updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendors.index')
        ->with('success', 'vendor deleted successfully'); 
    }
}
