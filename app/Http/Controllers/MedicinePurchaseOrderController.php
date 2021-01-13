<?php

namespace App\Http\Controllers;

use App\Models\{ MedicinePurchaseOrder, Medicinecompanyinfo };
use Illuminate\Http\Request;
use DataTables;
use DB;

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
            $data = MedicinePurchaseOrder::join('medicine_company_infos as c', 'c.id','=', 'medicine_purchase_orders.medicine_company_infos_id')->join('users as u', 'u.id','=', 'medicine_purchase_orders.users_id')
            ->select('medicine_purchase_orders.id', 'medicine_purchase_orders.po_number', 'medicine_purchase_orders.po_date', 'medicine_purchase_orders.delivery_date', 'medicine_purchase_orders.note', 'u.name as user_name', 'medicine_purchase_orders.valid', 'c.company_name as company_name')
            ->get();

            // $data = DB::select("
                
            // ")

            return Datatables::of($data)
                ->make(true);
        } 
        
        return view('medicinepurchaseorders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medicine_company_infos_id = Medicinecompanyinfo::all();
        $user = auth()->user();
        return view('medicinepurchaseorders.create', compact('medicine_company_infos_id','user'));
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
            'po_number' => 'required',
            'po_date' => 'required',
            'delivery_date' => 'required',
            'note' => 'required',
            'users_id' => 'required',
            'valid' => 'required',
            'medicine_company_infos_id' => 'required',
        ]);

        $medicinepurchaseorder = new medicinepurchaseorder;
        $medicinepurchaseorder->po_number = $request->po_number;
        $medicinepurchaseorder->po_date = $request->po_date;
        $medicinepurchaseorder->delivery_date = $request->delivery_date;
        $medicinepurchaseorder->note = $request->note;
        $medicinepurchaseorder->users_id = $request->users_id;
        $medicinepurchaseorder->valid = $request->valid;
        $medicinepurchaseorder->medicine_company_infos_id = $request->medicine_company_infos_id;
        

        // dd($medicine_generic_name);

        $medicinepurchaseorder->save();

        return redirect()->route('medicinepurchaseorders.index')
        ->with('success', 'medicinepurchases added successfully');
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
        return view('medicinepurchaseorders.edit',compact('medicinepurchaseorder', 'medicine_generic_names_id', 'medicine_groups_id', 'medicine_company_infos_id', 'medicine_units_id'));
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

        return redirect()->route('medicinepurchaseorders.index')
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
        return redirect()->route('medicinepurchaseorders.index')
        ->with('success', 'Company deleted successfully'); 
    }
}
