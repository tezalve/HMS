<?php

namespace App\Http\Controllers;

use App\Models\MedicinePurchaseOrder;
use Illuminate\Http\Request;
use DataTables;

class MedicinePurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = MedicinePurchaseOrder::select('*');

            return Datatables::of($data)
                ->make(true);
        } 
        
        return view('medicinepurchases.index');
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
        $users_id = User::all();
        $user = auth()->user();
        return view('medicinepurchases.create',compact('medicine_generic_names_id', 'medicine_groups_id', 
        'medicine_company_infos_id', 'medicine_units_id'))->with('users', $user->id);
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

        $medicinepurchaseorder = new medicinepurchaseorder;
        $medicinepurchaseorder->medicine_name = $request->medicine_name;
        $medicinepurchaseorder->mrp = $request->mrp;
        $medicinepurchaseorder->tp = $request->tp;
        $medicinepurchaseorder->default_discount = $request->default_discount;
        $medicinepurchaseorder->default_vat = $request->default_vat;
        $medicinepurchaseorder->medicine_generic_names_id = $request->medicine_generic_names_id;
        $medicinepurchaseorder->medicine_groups_id = $request->medicine_groups_id;
        $medicinepurchaseorder->medicine_company_infos_id = $request->medicine_company_infos_id;
        $medicinepurchaseorder->medicine_units_id = $request->medicine_units_id;
        $medicinepurchaseorder->users_id = $request->users_id;

        // dd($medicine_generic_name);

        $medicinepurchaseorder->save();

        return redirect()->route('medicinepurchases.index')
        ->with('success', 'Company added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicinePurchaseOrder  $medicinePurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(MedicinePurchaseOrder $medicinePurchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicinePurchaseOrder  $medicinePurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicinePurchaseOrder $medicinePurchaseOrder)
    {
        try {
            $decrypted = Crypt::decryptString($medicinepurchaseorder);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $medicinepurchaseorder = medicinepurchaseorder::where('id',$decrypted)->first();

        $medicine_generic_names_id = Medicinegeneric::all();
        $medicine_groups_id = Medicinegroup::all();
        $medicine_company_infos_id = Medicinecompanyinfo::all();
        $medicine_units_id = Medicineunit::all();
        return view('medicinepurchases.edit',compact('medicinepurchaseorder', 'medicine_generic_names_id', 'medicine_groups_id', 'medicine_company_infos_id', 'medicine_units_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicinePurchaseOrder  $medicinePurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicinePurchaseOrder $medicinePurchaseOrder)
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
            'medicine_units_id' => 'required',
            'users_id' => 'required'
        ]);

        $medicinepurchaseorder = medicinepurchaseorder::find($medicinepurchaseorder->id);
        $medicinepurchaseorder->medicine_name = $request->medicine_name;
        $medicinepurchaseorder->mrp = $request->mrp;
        $medicinepurchaseorder->tp = $request->tp;
        $medicinepurchaseorder->default_discount = $request->default_discount;
        $medicinepurchaseorder->default_vat = $request->default_vat;
        $medicinepurchaseorder->medicine_generic_names_id = $request->medicine_generic_names_id;
        $medicinepurchaseorder->medicine_groups_id = $request->medicine_groups_id;
        $medicinepurchaseorder->medicine_company_infos_id = $request->medicine_company_infos_id;
        $medicinepurchaseorder->medicine_units_id = $request->medicine_units_id;
        $medicinepurchaseorder->users_id = $request->users_id;

        // dd($medicinepurchaseorder);

        $medicinepurchaseorder->save();

        return redirect()->route('medicinepurchases.index')
        ->with('success', 'Company updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicinePurchaseOrder  $medicinePurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicinePurchaseOrder $medicinePurchaseOrder)
    {
        try {
            $decrypted = Crypt::decryptString($medicinepurchaseorder);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $medicinepurchaseorder = medicinepurchaseorder::where('id',$decrypted)->first();

        $medicinepurchaseorder->delete();
        return redirect()->route('medicinepurchases.index')
        ->with('success', 'Company deleted successfully'); 
    }
}
