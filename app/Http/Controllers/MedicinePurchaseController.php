<?php

namespace App\Http\Controllers;

use App\Models\{ MedicinePurchase, Medicinecompanyinfo, Medicineinformation, Medicineunit, MedicinePurchaseOrder };
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;

class MedicinePurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = medicinepurchase::select('*');

            return Datatables::of($data)
                    ->addColumn('edit', function($row){
     
                        $btn1 = '<a href="'.route('medicinepurchases.edit', Crypt::EncryptString($row->id)).'" class="edit btn btn-primary btn-sm">Edit</a>';
                        return $btn1;
                    })
                    ->addColumn('delete', function($row){
     
                        $btn2 = '<form action="'.route('medicinepurchases.destroy', Crypt::EncryptString($row->id)).'" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="submit" class="edit btn btn-primary btn-sm">Delete
                        </form>';
                        return $btn2;
                    })
                    ->rawColumns(['edit', 'delete'])
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
        $medicine_company_infos_id      = Medicinecompanyinfo::all();
        $medicine_informations_id       = Medicineinformation::all();
        $medicine_purchase_orders_id    = MedicinePurchaseOrder::select('medicine_purchase_orders.id', 'medicine_purchase_orders.po_number')
                                            ->where('medicine_purchase_orders.valid', '=', '1')
                                            ->get();
        $medicine_units_id              = Medicineunit::all();
        $medicine_units_id_bonus        = Medicineunit::all();
        return view('medicinepurchases.create', compact('medicine_company_infos_id', 'medicine_informations_id', 'medicine_units_id', 'medicine_units_id_bonus', 'medicine_purchase_orders_id'));
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
            'delivery_date' => 'required',
            'note' => 'required',
            'transaction_type' => 'required',
            'medicine_company_infos_id' => 'required',
            'transaction_masters_id' => 'required',
            'medicine_informations_id' => 'required',
            'medicine_units_id' => 'required',
            'quantity' => 'required',
            'mrp' => 'required',
            'tp' => 'required',
            'vat' => 'required',
            'discount' => 'required',
            'discount_type' => 'required',
            'bonus_quantity' => 'required',
            'medicine_units_id_bonus' => 'required'
        ]);

        $medicinepurchase = new medicinepurchase;

        $medicinepurchase->group_name = $request->group_name;
        $medicinepurchase->group_name = $request->group_name;
        $medicinepurchase->group_name = $request->group_name;
        $medicinepurchase->group_name = $request->group_name;
        $medicinepurchase->group_name = $request->group_name;
        $medicinepurchase->group_name = $request->group_name;

        return redirect()->back()->with('success', 'Purchased Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicinePurchaseDetail  $medicinePurchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function show(MedicinePurchaseDetail $medicinePurchaseDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicinePurchaseDetail  $medicinePurchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicinePurchaseDetail $medicinePurchaseDetail)
    {
        try {
            $decrypted = Crypt::decryptString($medicinepurchase);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $medicinepurchase = medicinepurchase::where('id',$decrypted)->first();

        return view('medicinepurchases.edit', compact('medicinepurchases'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicinePurchaseDetail  $medicinePurchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicinePurchaseDetail $medicinePurchaseDetail)
    {
        $validated = $request->validate([
            'group_name' => 'required'
        ]);

        $medicinepurchase = medicinepurchase::find($medicinepurchases->id);

        $medicinepurchase->group_name = $request->group_name;

        // dd($medicine_generic_name);

        $medicinepurchase->save();

        return redirect()->route('medicinepurchases.index')
        ->with('success', 'Puechaaase Updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicinePurchaseDetail  $medicinePurchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicinePurchase $medicinepurchase)
    {
        try {
            $decrypted = Crypt::decryptString($medicinepurchase);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $medicinepurchase = medicinepurchase::where('id',$decrypted)->first();
        $medicinepurchase->delete();


        return redirect()->route('medicinepurchases.index')
        ->with('success', 'Purchase Deleted successfully');  
    }
}
