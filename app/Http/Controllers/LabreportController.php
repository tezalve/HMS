<?php

namespace App\Http\Controllers;

use App\Models\Labreport;
use Illuminate\Http\Request;
use DB;

class LabreportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('labs.generatelabreport_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = DB::select("SELECT a.id,a.date,a.discountpc,a.discountstatus,a.discountamount,a.advanceamount,
								a.due,a.invoice_no,GROUP_CONCAT(concat(a.id, '-', b.investigation_id)) As invid_icode,b.quantity,b.price,c.name as investigation_name,
								d.name as doctor_name,e.name as patient_name,e.phone,month(e.dob) as age,e.address,
								e.registration_no,e.gender,e.relegion
							FROM invoice_master a
								JOIN details b ON a.id=b.invoice_master_id 
								JOIN investigation c ON b.investigation_id=c.id
								JOIN doctors d ON a.reference_doctor_id=d.id
								JOIN patientregistration e ON a.patientregistration_id=e.id
                                GROUP BY a.id,a.date,a.discountpc,a.discountstatus,a.discountamount,a.advanceamount,
								a.due,a.invoice_no,b.investigation_id,b.quantity,b.price,c.name,
								d.name,e.name,e.phone,month(e.dob),e.address,
								e.registration_no,e.gender,e.relegion");

		return json_encode(array('data' => $data));	
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
     * @param  \App\Models\Labreport  $labreport
     * @return \Illuminate\Http\Response
     */
    public function show(Labreport $labreport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Labreport  $labreport
     * @return \Illuminate\Http\Response
     */
    public function edit(Labreport $labreport)
    {
        // a.id, '-', b.investigation_id
		// a.id as invoice_master_id
		// b.investigation_id as investigation_id

		// $data = "foo:*:1023:1000::/home/foo:/bin/sh";
		list($invoice_master_id, $investigation_id) = explode("-", $id);
		// echo $invoice_master_id; // foo
		// echo $investigation_id; // *		
		// dd();
		// f.parameter,f.alias_name as description,f.unit,f.normal_value
		$reportdata = DB::select("select  a.id,a.invoice_no,a.date,e.name as patient_name,if (e.gender = 'm','Male','Female') as gender,d.name as doctor_name,e.phone,
									f.*,c.name as investigation_name
									,g.age
								    from invoice_master a
									JOIN details b ON a.id=b.invoice_master_id AND a.id=$invoice_master_id AND b.investigation_id=$investigation_id
									JOIN investigation c ON b.investigation_id=c.id
									JOIN doctors d ON a.reference_doctor_id=d.id
									JOIN patientregistration e ON a.patientregistration_id=e.id
									JOIN labreport f ON b.investigation_id=f.investigation_id
									JOIN view_patient_age g ON a.id=g.invoice_master_id");


		if (empty($reportdata)){
				
				return redirect('labreports');
		}

// Session::flash('alert-danger', 'danger');
// Session::flash('alert-warning', 'warning');
// Session::flash('alert-success', 'success');
// Session::flash('alert-info', 'info');	

		// return View::make('lab.labreport')->with('reportdata',$reportdata);
		return view('lab.generate_lab_report')->with('reportdata',$reportdata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Labreport  $labreport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Labreport $labreport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Labreport  $labreport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Labreport $labreport)
    {
        //
    }
}
