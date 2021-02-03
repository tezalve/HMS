<?php

namespace App\Http\Controllers;

use App\Models\{ MedicinePurchase, Medicinecompanyinfo, Medicineinformation, Medicineunit, MedicinePurchaseOrder,
                 MedicinePurchaseMaster, MedicinePurchaseOrderDetail };
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use DataTables, DB;

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
            $data = medicinepurchasemaster::join('medicine_purchase_details as a', 'a.medicine_purchse_master_id', '=', 'medicine_purchase_master.id')
                ->join('medicine_purchase_orders as b', 'b.id', '=', 'medicine_purchase_master.medicine_purchase_orders_id')
                ->join('medicine_company_infos as c', 'c.id', '=', 'medicine_purchase_master.medicine_company_infos_id')
                ->select('b.po_number', 'medicine_purchase_master.delivery_number', 'medicine_purchase_master.delivery_date', 'medicine_purchase_master.note', 'c.company_name as company_name', 'medicine_purchase_master.transaction_type as transaction_type', DB::raw('SUM(a.tp*a.quantity) as total'))
                ->where('a.valid', '=', '1')
                ->groupBy('b.po_number', 'medicine_purchase_master.delivery_number', 'medicine_purchase_master.delivery_date', 'medicine_purchase_master.note', 'company_name', 'transaction_type','medicine_purchase_master.id')
                ->get();

                // DB::raw('(SUM( (mpod.requisition_quantity*mpod.rate) - ( (mpod.requisition_quantity*mpod.rate)*mpod.discount/100 ) + ( (mpod.requisition_quantity*mpod.rate)*mpod.vat/100 ) ) ) as total'
        
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
        // $medicine_company_infos_id      = Medicinecompanyinfo::all();
        // $medicine_informations_id       = Medicineinformation::all();
        // $medicine_purchase_orders_id    = MedicinePurchaseOrder::select('medicine_purchase_orders.id', 'medicine_purchase_orders.po_number')
        //                                     ->where('medicine_purchase_orders.valid', '=', '1')
        //                                     ->get();
        // $medicine_units_id              = Medicineunit::all();
        // $medicine_units_id_bonus        = Medicineunit::all(); 
        // return view('medicinepurchases.create', compact('medicine_company_infos_id', 'medicine_informations_id', 'medicine_units_id', 'medicine_units_id_bonus', 'medicine_purchase_orders_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $zero = 0;
        $validated = $request->validate([
            'delivery_date' => 'required',
            'transaction_type' => 'required',
            'medicine_company_infos_id' => 'required',
            'transaction_masters_id' => 'required',
            'vat' => 'required',
            'discount' => 'required',
            'discount_type' => 'required',
            'pay' => 'required|same:payable',
            'total_price' => 'required',
            'dues' => [
                'required',
                Rule::in([$zero]),
            ],
        ]);

        $data = new DataController();
        $delivery_number = $data->geneart_gistration("medicine_purchase_master", "delivery_number");

        $medicinepurchasemaster = new MedicinePurchaseMaster;

        $medicinepurchasemaster->medicine_purchase_orders_id = $request->medicine_purchase_orders_id;
        $medicinepurchasemaster->delivery_number = $delivery_number;
        $medicinepurchasemaster->delivery_date = $request->delivery_date;
        $medicinepurchasemaster->note = $request->note;
        $medicinepurchasemaster->transaction_type = $request->transaction_type;
        $medicinepurchasemaster->medicine_company_infos_id = $request->medicine_company_infos_id;
        $medicinepurchasemaster->transaction_masters_id = $request->transaction_masters_id;

        // dd("$medicinepurchasemaster");
        $medicinepurchasemaster->save();
        $purchaseorderdetail = MedicinePurchaseOrderDetail::where('medicine_purchase_order_details.medicine_purchase_orders_id', '=', $request->medicine_purchase_orders_id)->get();
            // dd($purchaseorderdetail, count($purchaseorderdetail));
        

        for ( $i=0; $i<count($purchaseorderdetail); $i++){
            $medicine = MedicineInformation::where('medicine_informations.id', '=', $purchaseorderdetail[$i]->medicine_informations_id)->first();
            
            $medicinepurchase = new Medicinepurchase;
            $medicinepurchase->medicine_purchse_master_id = $medicinepurchasemaster->id;
            $medicinepurchase->medicine_informations_id = $purchaseorderdetail[$i]->medicine_informations_id;
            $medicinepurchase->medicine_units_id = $purchaseorderdetail[$i]->medicine_units_id;
            $medicinepurchase->mrp = $medicine->mrp;
            $medicinepurchase->tp = $purchaseorderdetail[$i]->rate;
            $medicinepurchase->vat = $request->vat;
            $medicinepurchase->discount = $request->discount;
            $medicinepurchase->discount_type = $request->discount_type;
            // dd($medicinepurchase->discount_type);
            $medicinepurchase->quantity = $purchaseorderdetail[$i]->requisition_quantity;
            $medicinepurchase->bonus_quantity = $purchaseorderdetail[$i]->bonus_quantity;
            $medicinepurchase->bonus_units_id = $purchaseorderdetail[$i]->medicine_units_id;
            $medicinepurchase->valid = 1;
            $medicinepurchase->save();
        }

        $medicinepurchaseorder = medicinepurchaseorder::find($request->medicine_purchase_orders_id);
        $medicinepurchaseorder->valid = 0;

        $medicinepurchaseorder->save();

        return redirect()->route('medicinepurchases.index')->with('success', 'Purchased Successfully');
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

        return view('medicinepurchases.edit', compact('medicinepurchase'));
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
