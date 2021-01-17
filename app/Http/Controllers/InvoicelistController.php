<?php

namespace App\Http\Controllers;

use App\Models\Invoicelist;
use Illuminate\Http\Request;
use DB;

class InvoicelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoicelists.invoicelist');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$invdate 	 = date('Y-m-d', strtotime(str_replace('/','-', date('d/m/Y'))));

		$invoicedata = DB::select("SELECT 
								    a.id,
								    a.invoice_no,
								    a.date as invoicedate,
								    SUM(b.sales_amount) as sales_amount,
								    SUM(b.less_amount) as less_amount,
								    SUM(b.recieved_amount) as recieved_amount,
								    SUM(b.return_amount) as return_amount,
								    SUM(b.refund_amount) as refund_amount,
								    SUM(b.sales_amount+ b.refund_amount - b.less_amount - b.recieved_amount - b.return_amount ) AS due,
								    c.name as patientname
								FROM
								    invoice_master a
								        JOIN
								    invoice_ledger b ON a.id = b.invoice_master_id AND a.valid=1 AND b.valid=1 AND a.date = '$invdate'
								        JOIN
								    patientregistration c ON a.patientregistration_id = c.id
								GROUP BY a.id");

		return json_encode(array('data' => $invoicedata));	
	}

	public function invoicelistswithdate(){

		// dd($_POST);
		extract($_POST);
		// dd($invoicedate);
		
		$invdate 	 = date('Y-m-d', strtotime(str_replace('/','-', $invoicedate)));

		switch ($invoicetype) {
		    case "dueonly":
					$invoicedata = DB::select("SELECT 
											    a.id,
											    a.invoice_no,
											    a.date as invoicedate,
											    SUM(b.sales_amount) as sales_amount,
											    SUM(b.less_amount) as less_amount,
											    SUM(b.recieved_amount) as recieved_amount,
											    SUM(b.return_amount) as return_amount,
											    SUM(b.refund_amount) as refund_amount,
											    SUM(b.sales_amount + b.refund_amount - b.less_amount - b.recieved_amount - b.return_amount) as due,
											    c.name as patientname
											FROM
											    invoice_master a 
											        JOIN
											    invoice_ledger b ON a.id = b.invoice_master_id AND a.date='$invdate' AND a.valid=1
											        JOIN
											    patientregistration c ON a.patientregistration_id = c.id
											GROUP BY a.id
											HAVING SUM(b.sales_amount + b.refund_amount - b.less_amount - b.recieved_amount - b.return_amount)>0 ");
		        break;
		    case "paidonly":
					$invoicedata = DB::select("SELECT 
											    a.id,
											    a.invoice_no,
											    a.date as invoicedate,
											    SUM(b.sales_amount) as sales_amount,
											    SUM(b.less_amount) as less_amount,
											    SUM(b.recieved_amount) as recieved_amount,
											    SUM(b.return_amount) as return_amount,
											    SUM(b.refund_amount) as refund_amount,
											    SUM(b.sales_amount + b.refund_amount - b.less_amount - b.recieved_amount - b.return_amount) as due,
											    c.name as patientname
											FROM
											    invoice_master a 
											        JOIN
											    invoice_ledger b ON a.id = b.invoice_master_id AND a.date='$invdate' AND a.valid=1
											        JOIN
											    patientregistration c ON a.patientregistration_id = c.id
											GROUP BY a.id
											HAVING SUM(b.sales_amount + b.refund_amount - b.less_amount - b.recieved_amount - b.return_amount) <= 0 ");
		        break;
		    default:
					$invoicedata = DB::select("SELECT 
											    a.id,
											    a.invoice_no,
											    a.date as invoicedate,
											    SUM(b.sales_amount) as sales_amount,
											    SUM(b.less_amount) as less_amount,
											    SUM(b.recieved_amount) as recieved_amount,
											    SUM(b.return_amount) as return_amount,
											    SUM(b.refund_amount) as refund_amount,
											    SUM(b.sales_amount + b.refund_amount - b.less_amount - b.recieved_amount - b.return_amount) as due,
											    c.name as patientname
											FROM
											    invoice_master a 
											        JOIN
											    invoice_ledger b ON a.id = b.invoice_master_id AND a.date='$invdate' AND a.valid=1
											        JOIN
											    patientregistration c ON a.patientregistration_id = c.id
											GROUP BY a.id");
        }

		// 

		// $invoicedata = DB::select("SELECT 
		// 						    a.id,
		// 						    a.invoice_no,
		// 						    a.date as invoicedate,
		// 						    SUM(b.sales_amount) as sales_amount,
		// 						    SUM(b.less_amount) as less_amount,
		// 						    SUM(b.recieved_amount) as recieved_amount,
		// 						    SUM(b.return_amount) as return_amount,
		// 						    SUM(b.sales_amount + b.refund_amount - b.less_amount - b.recieved_amount - b.return_amount) as due,
		// 						    c.name as patientname
		// 						FROM
		// 						    invoice_master a 
		// 						        JOIN
		// 						    invoice_ledger b ON a.id = b.invoice_master_id AND a.date='$invdate' AND a.valid=1
		// 						        JOIN
		// 						    patientregistration c ON a.patientregistration_id = c.id
		// 						GROUP BY a.id");

		// dd($_POST);
		return json_encode($invoicedata);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoicelist  $invoicelist
     * @return \Illuminate\Http\Response
     */
    public function show(Invoicelist $invoicelist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoicelist  $invoicelist
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoicelist $invoicelist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoicelist  $invoicelist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoicelist $invoicelist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoicelist  $invoicelist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoicelist $invoicelist)
    {
        //
    }
}
