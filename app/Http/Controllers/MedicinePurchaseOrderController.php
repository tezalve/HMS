<?php

namespace App\Http\Controllers;

use App\Models\{ MedicinePurchase, MedicinePurchaseOrder, Medicinecompanyinfo, Medicineunit, Medicineinformation, MedicinePurchaseOrderDetail };
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
            $data = MedicinePurchaseOrder::join('users as u', 'u.id','=', 'medicine_purchase_orders.users_id')
            ->join('medicine_purchase_order_details as m', 'm.medicine_purchase_orders_id', '=', 'medicine_purchase_orders.id')
            ->select('medicine_purchase_orders.id as id', 'medicine_purchase_orders.po_number', 'medicine_purchase_orders.po_date', 'medicine_purchase_orders.delivery_date', 'medicine_purchase_orders.note', 'u.name as user_name', 'medicine_purchase_orders.valid', 'm.requisition_quantity as requisition', 'm.rate as rate')
            ->where('medicine_purchase_orders.valid', '=', '1')
            ->get();

            return Datatables::of($data)
                ->addColumn('edit', function($row){
                    
                    $btn1 = '<a style="color: red" href="'.route('medicinepurchaseorders.edit', Crypt::EncryptString($row->id)).'" class="edit">Complete Order</a>';
                        return $btn1;
                })
                ->rawColumns(['edit'])
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
        $medicine_informations_id = Medicineinformation::all();
        $medicine_units_id = MedicineUnit::all();
        // dd($medicine_informations_id);
        $user = auth()->user();
        return view('medicinepurchaseorders.create', compact('medicine_company_infos_id', 'user', 'medicine_informations_id', 'medicine_units_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'delivery_date' => 'required',
            'users_id' => 'required',
            'sendmedicineid' => 'required',
        ]);
        
        $data = new DataController();
        $po_number = $data->geneart_gistration("medicine_purchase_orders", "po_number");

        $medicinepurchaseorder = new medicinepurchaseorder;
        $medicinepurchaseorder->po_number = $po_number;
        $medicinepurchaseorder->po_date = $request->po_date;
        $medicinepurchaseorder->delivery_date = $request->delivery_date;
        $medicinepurchaseorder->note = $request->note;
        $medicinepurchaseorder->users_id = $request->users_id;
        $medicinepurchaseorder->valid = 1;

        // $medicinepurchaseorder->save();

        

        for ( $i=0; $i<count($request->sendmedicineid); $i++){
            $medicine = MedicineInformation::where('medicine_informations.id', '=', 4)->first();
            $medicinepurchaseorderdetails = new MedicinePurchaseOrderDetail;
            $medicinepurchaseorderdetails->requisition_quantity = $request->requisition_quantity[$i];
            $medicinepurchaseorderdetails->rate = $medicine->mrp;
            $medicinepurchaseorderdetails->bonus_quantity = $request->bonus_quantity[$i];
            $medicinepurchaseorderdetails->medicine_units_id = $medicine->medicine_units_id;
            $medicinepurchaseorderdetails->valid = 1;
            $medicinepurchaseorderdetails->medicine_purchase_orders_id = $medicine->medicine_purchase_orders_id;
            $medicinepurchaseorderdetails->medicine_informations_id = $medicine->medicine_informations_id;
            $medicinepurchaseorderdetails->medicine_company_infos_id = $medicine->medicine_company_infos_id;
            dd($medicinepurchaseorderdetails);
            $medicinepurchaseorderdetails->save();
        }

        

        return redirect()->route('medicinepurchaseorders.index')
        ->with('success', 'Order Placed Successfully');
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
    public function edit($medicinePurchaseOrder)
    {
        try {
            $decrypted = Crypt::decryptString($medicinePurchaseOrder);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $medicinePurchaseOrder = MedicinePurchaseOrder::where('id', '=', $decrypted)->first();
        // dd($medicinePurchaseOrder->id);
        $medicine_company_infos_id      = Medicinecompanyinfo::where('id', '=', $medicinePurchaseOrder->medicine_company_infos_id)->first();
        $medicine_purchase_order_detail = MedicinePurchaseOrderDetail::where('medicine_purchase_orders_id', '=', $medicinePurchaseOrder->id)->first();
        $medicine_informations_id       = Medicineinformation::where('id', '=', $medicine_purchase_order_detail->medicine_informations_id)->first();
        
        // $medicine_purchase_orders_id    = MedicinePurchaseOrder::select('medicine_purchase_orders.id', 'medicine_purchase_orders.po_number')
        //                                     ->where('medicine_purchase_orders.valid', '=', '1')
        //                                     ->get();
        $medicine_units_id              = Medicineunit::where('id', '=', $medicine_purchase_order_detail->medicine_units_id)->first();
        $bonus_units_id        = Medicineunit::all();
        $total_price = $medicine_purchase_order_detail->requisition_quantity*$medicine_purchase_order_detail->rate;
        // dd($medicinePurchaseOrder);
        return view('medicinepurchases.create', compact('medicine_purchase_order_detail', 'medicinePurchaseOrder', 'medicine_company_infos_id', 'medicine_informations_id', 'medicine_units_id', 'bonus_units_id', 'total_price'));
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
            'po_date' => 'required',
            'delivery_date' => 'required',
            'note' => 'required',
            'users_id' => 'required',
            'valid' => 'required',
            'medicine_company_infos_id' => 'required',
        ]);

        $medicinepurchaseorder = medicinepurchaseorder::find($medicinepurchaseorder->id);
        $medicinepurchaseorder->po_date = $request->po_date;
        $medicinepurchaseorder->delivery_date = $request->delivery_date;
        $medicinepurchaseorder->note = $request->note;
        $medicinepurchaseorder->users_id = $request->users_id;
        $medicinepurchaseorder->valid = $request->valid;
        $medicinepurchaseorder->medicine_company_infos_id = $request->medicine_company_infos_id;

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
    public function destroy($medicinePurchaseOrder)
    {
        //
    }
}
