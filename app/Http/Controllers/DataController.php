<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class DataController extends Controller {

	function geneart_gistration($table_name, $column_name){
		$search = DB::select("SELECT MAX($column_name) As invno FROM $table_name");
		
		foreach ($search as $key)
			$maxinvoiceno = $key->invno;

		$yearid 	= date("y");
		$monthid 	= date("m");
		$datevalue 	= $yearid . $monthid; 
		$invoice_no = substr($maxinvoiceno, 0,4);  
		
		if ($maxinvoiceno==0){
			$a = "0001";
			$new_invoice_no = $yearid . $monthid . $a;
		} else {
			if ($invoice_no==$datevalue){
				$maxinvoiceno = trim(substr($maxinvoiceno, 4)) + 1;
				$maxinvoiceno = sprintf("%04s", $maxinvoiceno);
				$new_invoice_no = $datevalue . $maxinvoiceno;
			} else {
				$a = "0001";
				$new_invoice_no = $yearid . $monthid . $a;              
			}
		}
		return $new_invoice_no;
	}

	public function subdeplist(Request $request) {
		
		// dd($request);
		$data = $request->all();
		$departmentid  = $data['department_id'];

		$subdepartmentdata = DB::table('sub_department')->where('department_id','=',$departmentid)->get();
		echo json_encode($subdepartmentdata);		
	}

	public function medlist(Request $request) {
		
		// dd($request);
		$data = $request->all();
		$companyid  = $data['medicine_company_infos_id'];

		$meddata = DB::table('medicine_informations')->where('medicine_company_infos_id','=',$companyid)->get();
		echo json_encode($meddata);
	}
}	