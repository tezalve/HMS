<?php

namespace App\Http\Controllers;

use App\Models\Clinicalchart;
use App\Models\Department;
use App\Models\Unitinfo;
use Illuminate\Http\Request;
use DB;

class ClinicalchartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinicalchartdata  = DB::select("SELECT a.id,a.name as description,a.price as charge,b.description as unit,c.description as department,d.description as sub_department
										  FROM investigation a
										  JOIN unit_info b ON a.unit_info_id = b.id AND a.investigation_group = 2
										  JOIN department c ON a.department_id=c.id
										  JOIN sub_department d ON a.sub_department=d.id");
		
		return view('clinicalcharts.index')->with('clinicalchartdata',$clinicalchartdata);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('clinicalcharts.create')->with('department',Department::all())->with('unitinfo',Unitinfo::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'investigationname'  	=> 'required|min:5',
            'chargeparunit' 		=> 'required|numeric',
            'department' 			=> 'required|exists:department,id',
            'subdepartment'			=> 'required|exists:sub_department,id'
        ]);
			
			// dd($_POST);
			// $insertClinicalchart  = new Clinicalchart;
			// $insertClinicalchart->description 			= $request->investigationname');
			// $insertClinicalchart->charge 				= $request->chargeparunit');
			// $insertClinicalchart->edit_status 			= $request->editstatus');
			// $insertClinicalchart->doctor_status 		= $request->doctorestatus');
			// $insertClinicalchart->unit_info_id 			= $request->unit');
			// $insertClinicalchart->department_id 		= $request->department');
			// $insertClinicalchart->sub_department_id 	= $request->subdepartment');
			// $insertClinicalchart->save();
			$investigation = new Investigation;
			$investigation->name 					= $request->investigationname;
			$investigation->price 					= $request->chargeparunit;
			$investigation->refferal_fee 			= 0;
			$investigation->refferal_type 			= 0;
			$investigation->department_id 			= $request->department;
			$investigation->extra_charge 			= 0;
			// $investigation->code 					= 0;
			$investigation->sub_department			= $request->subdepartment;
			$investigation->edit_status 			= $request->editstatus;
			$investigation->doctor_status 			= $request->doctorestatus;
			$investigation->unit_info_id 			= $request->unit;
            $investigation->investigation_group		= 2;	
            dd($investigation);
            $investigation->save();
            
		return redirect()->route('clinicalcharts.index')
            ->with('success', 'clinicalchart created successfully'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clinicalchart  $clinicalchart
     * @return \Illuminate\Http\Response
     */
    public function show(Clinicalchart $clinicalchart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clinicalchart  $clinicalchart
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinicalchart $clinicalchart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clinicalchart  $clinicalchart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinicalchart $clinicalchart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clinicalchart  $clinicalchart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinicalchart $clinicalchart)
    {
        //
    }
}
