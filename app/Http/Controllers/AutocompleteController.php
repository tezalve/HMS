<?php

namespace App\Http\Controllers;

use App\Models\Autocomplete;
use Illuminate\Http\Request;
use DB;

class AutocompleteController extends Controller
{
	

    public function getPatientauto(){
		$term = $request->term;
		$search = DB::select("SELECT id,name,phone,address,registration_no from patientregistration WHERE name LIKE '%$term%' OR phone LIKE '%$term%' ");

		$i=0;
		$p_lists = array();
		// $p_list  = array();
		foreach ($search as $result){
			$p_lists[$i] = array(
				'id' 				=>$result->id,
				'name'				=>$result->name,
				'phone'	  			=>$result->phone,
				'address'			=>$result->address,
				'registration_no'	=>$result->registration_no
				);
			$i++;    	
		}


		$matches = array();
		foreach($p_lists as $p_list){
			$p_list['value'] = $p_list['name'];
			$p_list['label'] = "{$p_list['name']}, {$p_list['registration_no']},{$p_list['phone']},{$p_list['address']} ";
			$matches[] = $p_list;
		}
		$matches = array_slice($matches, 0, 12);
		print json_encode($matches);
	}

	public function getDoctoreinfo(){
		$term = $request->term;
		$search = DB::select("SELECT id,name,phone,address from doctors WHERE name LIKE '%$term%' OR phone LIKE '%$term%' ");

		$i=0;
		$p_lists = array();
		// $p_list  = array();
		foreach ($search as $result){
			$p_lists[$i] = array(
				'id' 		=>$result->id,
				'name'		=>$result->name,
				'phone'	  	=>$result->phone,
				'address'	=>$result->address
				);
			$i++;    	
		}


		$matches = array();
		foreach($p_lists as $p_list){
			$p_list['value'] = $p_list['name'];
			$p_list['label'] = "{$p_list['name']}, {$p_list['phone']},{$p_list['address']} ";
			$matches[] = $p_list;
		}
		$matches = array_slice($matches, 0, 12);
		print json_encode($matches);
	}	
	
	public function investigtion(){
		$term = $request->term;
		$search = DB::select("SELECT id,name,price,refferal_fee,refferal_type from investigation WHERE investigation_group=1 AND name LIKE '%$term%' ");

		$i=0;
		$p_lists = array();
		// $p_list  = array();
		foreach ($search as $result){
			$p_lists[$i] = array(
				'id' 			=>$result->id,
				'name'			=>$result->name,
				'price'	  		=>$result->price,
				'refferal_fee'	=>$result->refferal_fee,
				'refferal_type'	=>$result->refferal_type
				);
			$i++;    	
		}


		$matches = array();
		foreach($p_lists as $p_list){
			$p_list['value'] = $p_list['name'];
			$p_list['label'] = "{$p_list['name']}, {$p_list['price']} ";
			$matches[] = $p_list;
		}

		$matches = array_slice($matches, 0, 12);
		print json_encode($matches);
	}		

	public function investigationdata(){  

		$parameter_val = $_POST['p'];

		$search = DB::select("SELECT * FROM investigation WHERE investigation_group=1 AND id =$parameter_val ");

		echo json_encode($search);

	}	

	public function postIsempty(){
		$tablename 	= $_POST['tablename'];
		$columnname = $_POST['columnname'];
		$condition 	= $_POST['condition'];
		// dd("SELECT * FROM $tablename WHERE $columnname =$condition ");		
		$search = DB::select("SELECT * FROM $tablename WHERE $columnname = $condition");		

		if (empty($search)){
			$isempty = false;
		}else{
			$isempty = true;
		}
		$mydata[0] = $isempty;
		$mydata[1] = $search;

		echo json_encode($mydata);

	}

	public function doctord(Request $request){
        $q = $request->term;
        $search = DB::select("SELECT id, concat(name, ' | ', phone) AS text FROM doctors WHERE name LIKE '%$q%' OR phone LIKE '%$q%' ");

        // $employee_collection = collect($search);    
        $search = array_slice($search, 0, 20);
        echo json_encode($search);
    }

	public function patient(Request $request){
		$term = $request->term;
		$search = DB::select("SELECT id,concat(name, ' | ', phone, ' | ', registration_no) AS text from patientregistration WHERE name LIKE '%$term%' OR phone LIKE '%$term%' ");
		$matches = array_slice($search, 0, 50);
		echo json_encode($matches);
	}


	public function investigtionnew(Request $request){
       
		$term 	= $request->term;
		$search = DB::select("SELECT id,name AS text from investigation WHERE investigation_group=1 AND name LIKE '%$term%' ");
		$matches = array_slice($search, 0, 50);
		echo json_encode($matches);
	}
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Autocomplete  $autocomplete
     * @return \Illuminate\Http\Response
     */
    public function show(Autocomplete $autocomplete)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Autocomplete  $autocomplete
     * @return \Illuminate\Http\Response
     */
    public function edit(Autocomplete $autocomplete)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Autocomplete  $autocomplete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autocomplete $autocomplete)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Autocomplete  $autocomplete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autocomplete $autocomplete)
    {
        //
    }
}
