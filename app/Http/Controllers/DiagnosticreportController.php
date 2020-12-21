<?php

namespace App\Http\Controllers;

use App\Models\Diagnosticreport;
use Illuminate\Http\Request;

class DiagnosticreportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('diagnosticreports.diagnostic_report_menu');
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
        $reportname 	= $request->submit;
		// dd($reportname);
		$reporttype 	= 1;
		$datefrom 		= 1;
		$dateto 		= 1;
		$doctor 		= 1;
		$patient_name 	= 1;

		switch ($reportname) {
		    case "Daly Sales":
				$reporttype 	= 0;
				$datefrom 		= 1;
				$dateto 		= 1;
				$doctor 		= 0;
				$patient_name 	= 0;
		        break;
		    case "Invoice Register":
				$reporttype 	= 0;
				$datefrom 		= 1;
				$dateto 		= 1;
				$doctor 		= 0;
				$patient_name 	= 0;
		        break;
		    case "User Wise Sales":
				$reporttype 	= 0;
				$datefrom 		= 1;
				$dateto 		= 1;
				$doctor 		= 0;
				$patient_name 	= 0;
		        break;
		    case "Doctor Commission":
				$reporttype 	= 1;
				$datefrom 		= 1;
				$dateto 		= 1;
				$doctor 		= 1;
				$patient_name 	= 0;
		        break;
		    case "Group Wise Sales":
				$reporttype 	= 0;
				$datefrom 		= 1;
				$dateto 		= 1;
				$doctor 		= 1;
				$patient_name 	= 0;
		        break;
		    case "Doctor Performance":
				$reporttype 	= 0;
				$datefrom 		= 1;
				$dateto 		= 1;
				$doctor 		= 1;
				$patient_name 	= 0;
		        break;		        
		    default:
		    return redirect('diareport');		
		}		

		return view('diagnosticreport.diagnostic_report')
					 ->with('reporttype',$reporttype)
					 ->with('datefrom',$datefrom)
					 ->with('dateto',$dateto)
					 ->with('doctor',$doctor)
					 ->with('patient_name',$patient_name)
					 ->with('reportname',$reportname);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diagnosticreport  $diagnosticreport
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnosticreport $diagnosticreport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diagnosticreport  $diagnosticreport
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnosticreport $diagnosticreport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diagnosticreport  $diagnosticreport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnosticreport $diagnosticreport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diagnosticreport  $diagnosticreport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnosticreport $diagnosticreport)
    {
        //
    }
}
