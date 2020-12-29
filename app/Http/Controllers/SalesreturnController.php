<?php

namespace App\Http\Controllers;

use App\Models\{Salesreturn, Invoice, Invoicereturn, InvoiceLedger, Doctorsledger};
use Illuminate\Http\Request;
use DB;

class SalesreturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store()
	{
		//
		// dd($_POST);


		$validated = $request->validate([
				'investigation_id'  	=> 'required',
				'invoiceid' 			=> 'required|exists:invoice_master,id',
				'consultantbyid' 		=> 'required|exists:doctors,id',
				'referencebyid' 		=> 'required|exists:doctors,id',
				'patientid' 			=> 'required|exists:patientregistration,id'
        ]);

		dd($_POST);
		$i = 0;						
		extract($_POST);

		$return_no 			= new DataController();
		$return_no_new  	= $return_no->geneart_gistration("invoice_return", "return_no");
		$expcount 			= count($investigation_id);
		$invoicedatetest	= $request->returndate;
		$invdate 			= date('Y-m-d', strtotime(str_replace('/','-', $invoicedatetest)));
		$invoice_id			= $request->invoiceid;
		$invoicedata 		= Invoice::find($invoice_id);
		// dd($invoicedata->discountfrom);


		$insert_invoicereturn 		= new Invoicereturn;
		$insert_invoicereturn->invoice_master_id 	= $invoice_id;
		$insert_invoicereturn->return_no 			= $return_no_new;
		$insert_invoicereturn->return_date 			= $invdate;
		$insert_invoicereturn->total_return 		= $request->netreturn;
		$insert_invoicereturn->refund_amount 		= $request->returnamount;
		$insert_invoicereturn->valid 				= 1;
		$insert_invoicereturn->save();

		$invoice_return_id = DB::table('invoice_return')->max('id');

		$getInvoiceLedger = new Invoiceledger;
		$getInvoiceLedger->sales_amount 			= 0;
		$getInvoiceLedger->less_amount 				= 0;
		$getInvoiceLedger->recieved_amount 			= 0;
		$getInvoiceLedger->return_amount 			= $request->netreturn;
		$getInvoiceLedger->refund_amount 			= $request->returnamount;
		$getInvoiceLedger->remarks 					= $request->remarks;
		$getInvoiceLedger->patientregistration_id 	= $request->patientid;
		$getInvoiceLedger->invoice_master_id 		= $invoice_id;
		$getInvoiceLedger->trdate 					= $invdate;
		$getInvoiceLedger->doctors_id 				= $referencebyid;
		$getInvoiceLedger->less_from 				= 0;
		$getInvoiceLedger->doctor_commision			= 0;
		$getInvoiceLedger->less_pc					= 0;
		$getInvoiceLedger->less_type				= 0;
		$getInvoiceLedger->valid					= 1;
		$getInvoiceLedger->transation_from			= "Outdoor Invoice Return";
		$getInvoiceLedger->invoice_return_id		= $invoice_return_id;

		$getInvoiceLedger->save();

		$refferalamount 	= 0;
		$lessamount 		= 0;
		for($r= 0; $r<$expcount; $r++) {                                                 
			if($investigation_id[$r] != "") {
				DB::table('details')
				    ->where('invoice_master_id', $invoice_id)
				    ->where('investigation_id',$investigation_id[$r])
				    ->update(array('item_status' => 0));

				$refferalamount = ($refferalamount+$refferal_amount[$r]);    
				$lessamount 	= ($lessamount+$less_amount[$r]);
			}	
		}


		// less polecy
		// 0 for Company
		// 1 for Both
		// 2 for Doctor	

		$return_doctor_commision = 0;
		

		if ($invoicedata->discountfrom == "1"){
			$return_doctor_commision = ($refferalamount - ($lessamount/2));
		}
		if ($invoicedata->discountfrom == "2"){
			$return_doctor_commision = ($refferalamount - $lessamount);
		}		

		if ($invoicedata->discountfrom == "0"){
			$return_doctor_commision = ($refferalamount);
		}

		// if ($lessfrom == 1){
		// 	$doctor_less_amount = ($lessamount/2);
		// }
		// if ($lessfrom == 2){
		// 	$doctor_less_amount = ($lessamount);
		// }		
		$getDoctorsledger = new Doctorsledger;
		$getDoctorsledger->doctors_id 			= $referencebyid;
		$getDoctorsledger->invoice_master_id 	= $invoice_id;
		$getDoctorsledger->tr_date 				= $invdate;
		$getDoctorsledger->entry_type 			= 4; //1 for invoice,2 for due collection,3 for payment, 4 for return 
		$getDoctorsledger->doctor_commision 	= 0;
		$getDoctorsledger->less_amount 			= 0;
		$getDoctorsledger->invoice_less 		= 0;
		$getDoctorsledger->valid 				= 1;
		$getDoctorsledger->doctor_payment 		= 0;
		$getDoctorsledger->return_commision		= $return_doctor_commision;
		$getDoctorsledger->invoice_return_id	= $invoice_return_id;
		$getDoctorsledger->save();
			
        $parameter = array(
            'invoiceid' 			=> $invoice_id, 
            'successfullymessage'   => 'successfully saved'
        );
        return redirect('invoicelists')->with('message', json_encode($parameter));  

	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salesreturn  $salesreturn
     * @return \Illuminate\Http\Response
     */
    public function show(Salesreturn $salesreturn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salesreturn  $salesreturn
     * @return \Illuminate\Http\Response
     */
    public function edit(Salesreturn $salesreturn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salesreturn  $salesreturn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salesreturn $salesreturn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salesreturn  $salesreturn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salesreturn $salesreturn)
    {
        //
    }
}
