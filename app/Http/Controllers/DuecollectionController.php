<?php

namespace App\Http\Controllers;

use App\Models\{Duecollection, Doctorsledger, Invoiceledger};
use Illuminate\Http\Request;
use DB;

class DuecollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = DB::select("SELECT a.invoice_master_id,b.name As patirnt_name,c.invoice_no,DATE_FORMAT(c.date,'%d-%m-%Y') AS date,
			(SUM(a.sales_amount+a.refund_amount)-SUM(a.less_amount+a.recieved_amount+a.return_amount)) As DueAmount
			FROM invoice_ledger a
			JOIN patientregistration b ON a.patientregistration_id=b.id
			JOIN invoice_master c ON a.invoice_master_id=c.id
			GROUP BY a.invoice_master_id, b.name, c.invoice_no
			HAVING (SUM(a.sales_amount+a.refund_amount)-SUM(a.less_amount+a.recieved_amount+a.return_amount))>0");

    	return view('salesinvoices.listofdueinvoice')->with('my_sql', $sql);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd("$request");
        $validator = $request->validate([
				'collection_amount'  	=> 'required',
				'invoice_id' 			=> 'required|exists:invoice_master,id',
				'doctore_id' 			=> 'required|exists:doctors,id',
				'patientid' 			=> 'required|exists:patientregistration,id'
        ]);
			
        $referencebyid 		= $request->doctore_id;
        $patientid 			= $request->patientid;
        $invoice_master_id  = $request->invoice_id;
        $transactiondate 	= $request->transactiondate; 
        $collection_amount 	= $request->collection_amount; 
        $lessamount			= $request->lessamount;
        $lesspc				= $request->lesspc;
        $lessfrom			= $request->lessfrom;
        $transaction_date	= date('Y-m-d', strtotime(str_replace('/','-', $transactiondate)));		
        $doctor_less_amount = 0;

        // 1 for Both
        // 2 for Doctor
        if ($lessamount>0){
            if ($lessfrom == 1){
                $doctor_less_amount = ($lessamount/2);
            }
            if ($lessfrom == 2){
                $doctor_less_amount = ($lessamount);
            }
        }
        if (empty($lessamount)){
            $lessamount=0;
        }
        $getInvoiceLedger = new Invoiceledger;
        $getInvoiceLedger->sales_amount 			= 0;
        $getInvoiceLedger->less_amount 				= $lessamount;
        $getInvoiceLedger->recieved_amount 			= $collection_amount;
        $getInvoiceLedger->return_amount 			= 0;
        $getInvoiceLedger->refund_amount 			= 0;
        $getInvoiceLedger->remarks 					= "N/A";
        $getInvoiceLedger->patientregistration_id 	= $patientid;
        $getInvoiceLedger->invoice_master_id 		= $invoice_master_id;
        $getInvoiceLedger->trdate 					= $transaction_date;
        $getInvoiceLedger->doctors_id 				= $referencebyid;
        $getInvoiceLedger->less_from 				= $lessfrom;
        $getInvoiceLedger->doctor_commision			= 0;
        $getInvoiceLedger->less_pc					= $request->lesspc;
        $getInvoiceLedger->less_type				= $request->lesstype;
        $getInvoiceLedger->valid					= 1;
        $getInvoiceLedger->transation_from			= "Outdoor Due Collection";			
        

        $invoice_ledger_id = DB::table('invoice_ledger')->max('id');

        $getDoctorsledger = new Doctorsledger;
        $getDoctorsledger->doctors_id 			= $referencebyid;
        $getDoctorsledger->invoice_master_id 	= $invoice_master_id;
        $getDoctorsledger->tr_date 				= $transaction_date;
        $getDoctorsledger->entry_type 			= 2; //1 for invoice,2 for due collection,3 for payment
        $getDoctorsledger->doctor_commision 	= 0;
        $getDoctorsledger->less_amount 			= $doctor_less_amount;
        $getDoctorsledger->invoice_less 		= $lessamount;
        $getDoctorsledger->valid 				= 1;
        $getDoctorsledger->doctor_payment 		= 0;
        $getDoctorsledger->return_commision		= 0;
        

        $duereceive 					 	= new Duecollection;
        $duereceive->collection_amount 		= $collection_amount;
        $duereceive->valid 					= 1;
        $duereceive->trdate 				= $transaction_date;
        $duereceive->invoice_ledger_id 		= $invoice_master_id;
        $duereceive->invoice_master_id 		= $invoice_ledger_id;
        
        // dd("$getInvoiceLedger", "$getDoctorsledger", "$duereceive");

        $getInvoiceLedger->save();
        $getDoctorsledger->save();
        $duereceive->save();
        
        return redirect()->route("duecollections.index");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Duecollection  $duecollection
     * @return \Illuminate\Http\Response
     */
    public function show(Duecollection $duecollection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Duecollection  $duecollection
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sql = DB::select("SELECT a.id,a.invoice_no,a.date,b.name as patient_name,a.patientregistration_id,
        (SUM(c.sales_amount+c.refund_amount)-SUM(c.less_amount+c.recieved_amount+c.return_amount)) As DueAmount,
        (SELECT (SUM(d.doctor_commision)-SUM(d.less_amount)-SUM(d.return_commision))
         FROM doctors_ledger d WHERE d.invoice_master_id = $id) as doctor_commision,c.doctors_id
         FROM invoice_master a
         JOIN patientregistration b ON a.patientregistration_id=b.id AND a.valid=1 AND a.id= $id
         JOIN invoice_ledger c ON a.id=c.invoice_master_id
		 GROUP BY a.id,a.invoice_no,a.date,b.name,a.patientregistration_id,c.doctors_id
		 HAVING (SUM(c.sales_amount+c.refund_amount)-SUM(c.less_amount+c.recieved_amount+c.return_amount))>0");

        // dd($sql);
        // $sql = DB::raw("SELECT a.id,a.invoice_no,a.date,b.name as patient_name,a.patientregistration_id,
		// 				  (SUM(c.sales_amount+c.refund_amount)-SUM(c.less_amount+c.recieved_amount+c.return_amount)) As DueAmount,
		// 				  (SELECT (SUM(d.doctor_commision)-SUM(d.less_amount)-SUM(d.return_commision))
		// // 				   FROM doctors_ledger d WHERE d.invoice_master_id = $id) as doctor_commision,
        //                   c.doctors_id
		// 		FROM invoice_master a
		// 		JOIN patientregistration b ON a.patientregistration_id=b.id AND a.valid=1 AND a.id= $id
		// 		JOIN invoice_ledger c ON a.id=c.invoice_master_id
		// 		GROUP BY a.id,a.invoice_no,a.date,b.name,a.patientregistration_id,c.doctors_id");

        if(empty($sql)) {	
        // return Redirect::back();
        return redirect('duecollections');
        }
            
		return view('salesinvoices.duecollection')->with('sqlduecollection', $sql);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Duecollection  $duecollection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Duecollection $duecollection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Duecollection  $duecollection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Duecollection $duecollection)
    {
        //
    }
}
