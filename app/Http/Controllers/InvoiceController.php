<?php

namespace App\Http\Controllers;

use App\Models\{Invoice, Invoicelist, Invoiceledger, Invoicereturn, Doctorsledger};
use Illuminate\Http\Request;
use DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session('message')){
			$model  = DB::select("SELECT * FROM investigation WHERE investigation_group=1 ORDER BY code ASC");
			return view('salesinvoices.invoice')->with('investigation',$model)->with('message', session('message'));	
	   }else{
			$model  = DB::select("SELECT * FROM investigation WHERE investigation_group=1 ORDER BY code ASC");
			return view('salesinvoices.invoice')->with('investigation',$model);
	   }	
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
        // dd($_POST);
		// exists:table,column
		// 'employee_name' 	=> 'required|exists:employees_master,employeename',
		$validated = $request->validate([
            'investigtion_id_grid'  => 'required',
            'consultantby' 			=> 'required|exists:doctors,id',
            'referenceby' 			=> 'required|exists:doctors,id',
            'patientid' 			=> 'required|exists:patientregistration,id'
        ]);

   
        // dd($_POST);
        $i = 0;						
        extract($_POST);

        $invoice_no 		= new DataController();
        $invoice_no_new  	= $invoice_no->geneart_gistration("invoice_master", "invoice_no");
        $expcount 			= count($investigtion_id_grid);
        $invoicedatetest	= $request->invoicedate;
        $consultantbyid 	= $request->consultantby;
        $referencebyid 		= $request->referenceby;
        $patientid 			= $request->patientid;
        $refferal_fee 		= $request->refferal_fee; //for check
        $refferal_type 		= $request->refferal_type; //for check
        $refferal_amount 	= $request->refferal_amount;
        $regno 				= $request->regno;
        $patentname 		= $request->patentname;
        $subtotal 			= $request->subtotal;
        $lessfrom 			= $request->lessfrom;
        $lesspc 			= $request->lesspc;
        $lesstype 			= $request->lesstype;
        $lessamount 		= $request->lessamount;
        $advance 			= $request->advance;
        $dueamount 			= $request->dues;
        $less_of_percentage = 0;

        if ($lessamount>0){
            $less_of_percentage = round(($lessamount / $subtotal) * 100,2);
        }
        // dd($less_of_percentage);
        // $less_of_percentage = 


        $invdate 			= date('Y-m-d', strtotime(str_replace('/','-', $invoicedatetest)));
        // dd($invdate);

        $getinvoice                         = new Invoice;
        $getinvoice->date 					= $invdate;
        $getinvoice->doctors_id 			= $request->consultantby;
        $getinvoice->moduleName_id 			= 1;//$request->name');  //get variable
        $getinvoice->totalamount 			= $request->subtotal;
        $getinvoice->discountamount 		= $request->lessamount;
        $getinvoice->discountstatus 		= $request->lesstype; 
        $getinvoice->discountpc 			= $request->lesspc;
        $getinvoice->advanceamount 			= $request->advance;
        $getinvoice->due 					= $dueamount;
        $getinvoice->istransferred 			= 1;
        $getinvoice->valid 					= 1;
        $getinvoice->remarks				= $request->remarks;
        $getinvoice->discountfrom 			= $request->lessfrom;
        $getinvoice->reference_doctor_id 	= $request->referenceby;
        $getinvoice->patientregistration_id = $request->patientid;
        $getinvoice->invoice_no 			= $invoice_no_new;
        $getinvoice->save();


        // return Redirect::to("invoice")->with('message', 'Something whent wrong');		
        $invoice_master_id = DB::table('invoice_master')->max('id');

        $getInvoiceLedger = new Invoiceledger;
        $getInvoiceLedger->sales_amount 			= $subtotal;
        $getInvoiceLedger->less_amount 				= $lessamount;
        $getInvoiceLedger->recieved_amount 			= $advance;
        $getInvoiceLedger->return_amount 			= 0;
        $getInvoiceLedger->refund_amount 			= 0;
        $getInvoiceLedger->remarks 					= $request->remarks;
        $getInvoiceLedger->patientregistration_id 	= $patientid;
        $getInvoiceLedger->invoice_master_id 		= $invoice_master_id;
        $getInvoiceLedger->trdate 					= $invdate;
        $getInvoiceLedger->doctors_id 				= $referencebyid;
        $getInvoiceLedger->less_from 				= $lessfrom;
        $getInvoiceLedger->doctor_commision			= $refferal_amount;
        $getInvoiceLedger->less_pc					= $request->lesspc;
        $getInvoiceLedger->less_type				= $request->lesstype;
        $getInvoiceLedger->valid					= 1;
        $getInvoiceLedger->transation_from			= "Outdoor Invoice";
        $getInvoiceLedger->save();

        // less polecy
        // 0 for Company
        // 1 for Both
        // 2 for Doctor	
        $doctor_less_amount = 0;	
        if ($lessfrom == 1){
            $doctor_less_amount = ($lessamount/2);
        }
        if ($lessfrom == 2){
            $doctor_less_amount = ($lessamount);
        }		



        $getDoctorsledger = new Doctorsledger;
        $getDoctorsledger->doctors_id 			= $referencebyid;
        $getDoctorsledger->invoice_master_id 	= $invoice_master_id;
        $getDoctorsledger->tr_date 				= $invdate;
        $getDoctorsledger->entry_type 			= 1; //1 for invoice,2 for due collection,3 for payment
        $getDoctorsledger->doctor_commision 	= $refferal_amount;
        $getDoctorsledger->less_amount 			= $doctor_less_amount;
        $getDoctorsledger->invoice_less 		= $lessamount;
        $getDoctorsledger->valid 				= 1;
        $getDoctorsledger->doctor_payment 		= 0;
        $getDoctorsledger->return_commision		= 0;
        $getDoctorsledger->save();


        for($r= 0; $r<$expcount; $r++) {                                                 
            if($investigtion_id_grid[$r] != "") {
                $getInvoiceDetails 						= new Invoicelist;
                $getInvoiceDetails->investigation_id 	= $investigtion_id_grid[$r];
                $getInvoiceDetails->invoice_master_id 	= $invoice_master_id;
                $getInvoiceDetails->quantity 			= 1;
                $getInvoiceDetails->price 				= $price_grid[$r];
                $getInvoiceDetails->delivery_status 	= 0;
                $getInvoiceDetails->doctors_id 			= $consultantbyid;
                $getInvoiceDetails->refferal_amount 	= $refferal_amount_grid[$r];
                $getInvoiceDetails->valid 				= 1;
                $getInvoiceDetails->item_status 		= 1;
                $getInvoiceDetails->less_amount 		= round(($price_grid[$r]*$less_of_percentage)/100,2);
                $getInvoiceDetails->less_from 			= $lessfrom;
                $getInvoiceDetails->save();
            }	
        }
        
        $parameter = array(
            'invoiceid' 			=> $invoice_master_id, 
            'successfullymessage'   => 'successfully saved'
        );

        return redirect('invoices')->with('message', json_encode($parameter));
    }  


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        // dd($id);

		$c = new Client(
			Config::get('configurations.jasper_url'),
			Config::get('configurations.jasper_user'),
			Config::get('configurations.jasper_password')
		);


		$controls = array(
				'com_name' 		 => Config::get('configurations.com_name'),
				'com_address' 	 => Config::get('configurations.com_address'),
				'invoiceid' 	 => $id
		);

		$report = $c->reportService()->runReport('/reports/hospitalreport/invoice', 'html',null,null,$controls);

		echo $report;
		//
		// dd($id);

		// // $Product = Product::find($id);
		// $invoicedata = DB::select("SELECT a.id,a.date,a.discountpc,a.discountstatus,a.discountamount,a.advanceamount,
		// 						a.due,a.invoice_no,b.quantity,b.price,c.name as investigation_name,
		// 						d.name as doctor_name,e.name as patient_name,e.phone,month(e.dob) as age,e.address,
		// 						e.registration_no,e.gender,e.relegion
		// 						FROM invoice_master a
		// 						JOIN details b ON a.id=b.invoice_master_id AND a.id=$id
		// 						JOIN investigation c ON b.investigation_id=c.id
		// 						JOIN doctors d ON a.reference_doctor_id=d.id
		// 						JOIN patientregistration e ON a.patientregistration_id=e.id");

		// $view = View::make('PHPExcel.invoice')->with('invoice_data',$invoicedata);	
		// return $view;	
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
		// dd($id);
		// salesreturnpage
		$sqldata = DB::select("SELECT a.id,a.invoice_no,a.date as invdate,b.name as patientname,c.name as consultant_name,a.patientregistration_id as patientid,
        d.name as referred_by_doctors,a.remarks,a.doctors_id,a.reference_doctor_id,
        e.investigation_id,e.price,e.quantity,e.refferal_amount,e.less_amount,f.name as investigation_name,
        SUM(IF(g.sales_amount=0,g.less_amount,0)) as secend_less,
        SUM(g.recieved_amount-g.refund_amount) as advance,
        SUM(g.sales_amount+g.refund_amount-g.less_amount-g.recieved_amount-g.return_amount) as due
        FROM invoice_master a
        JOIN patientregistration b ON a.patientregistration_id=b.id AND a.id={$id} AND a.valid=1
        JOIN doctors c ON a.doctors_id=c.id
        JOIN doctors d ON a.reference_doctor_id = d.id
        JOIN details e ON a.id=e.invoice_master_id AND e.item_status=1
        JOIN investigation f ON e.investigation_id=f.id
        JOIN invoice_ledger g ON a.id=g.invoice_master_id
        GROUP BY a.id,e.investigation_id");

        if (empty($sqldata)){
        return redirect()->back();
        }
        return view('salereturn.salesreturnpage')->with('invoicedata',$sqldata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
