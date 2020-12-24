<?php

namespace App\Http\Controllers;

use App\Models\Investigation;
use App\Models\Department;
use Illuminate\Http\Request;
use DB;

class InvestigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        $investigation  = DB::select("SELECT * FROM investigation WHERE investigation_group=1 ORDER BY code ASC");
		return view('investigations.index', compact('departments','investigation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
		return view('investigations.create', compact('departments'));
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
				'investigationname'  => 'required',
				'price'  			 => 'required',
				'refferal_fee'		 => 'required',
				'department' 		 => 'required|exists:department,id',
				'subdepartment' 	 => 'required|exists:sub_department,id'
        ]);

		$investigation                          = new Investigation;
		$investigation->name 					= $request->investigationname;
		$investigation->price 					= $request->price;
		$investigation->refferal_fee 			= $request->refferal_fee;
		$investigation->refferal_type 			= $request->refferal_type;
		$investigation->department_id 			= $request->department;
		$investigation->extra_charge 			= 0;
		// $investigation->code 					= 0;
		$investigation->sub_department			= $request->subdepartment;
		$investigation->edit_status 			= 2;
		$investigation->doctor_status 			= 2;
		$investigation->unit_info_id 			= 1;
        $investigation->investigation_group		= 1;
        dd($investigation);
        $request->save();

		return view("investigations.index")->with('message', 'Successfully created investigation');
				
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function show(Investigation $investigation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function edit(Investigation $investigation)
    {
        $investigation = Investigation::find($investigation->id);
		if (empty($investigation)){
			Session::flash('message', 'Invalid Investigation !!');
			return view('investigations.edit');
		}
		$subdepartmentdata = DB::table('sub_department')->where('department_id','=',$investigation->department_id)->get();
		return view('investigations.edit')->with('investigation',$investigation)->with('departments', Department::all())->with('subdepartment',$subdepartmentdata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investigation $investigation)
    {
        $validated = $request->validate([
				'investigationname'  => 'required',
				'price'  			 => 'required',
				'refferal_fee'		 => 'required',
				'department' 		 => 'required|exists:department,id',
				'subdepartment' 	 => 'required|exists:sub_department,id'
        ]);
		
        $investigation = Investigation::find($investigation->id);

        $investigation->name 			= $request->investigationname;
        $investigation->price 			= $request->price;
        $investigation->refferal_fee 	= $request->refferal_fee;
        $investigation->refferal_type 	= $request->refferal_type;
        $investigation->department_id 	= $request->department;
        $investigation->sub_department 	= $request->subdepartment;
        $investigation->save();

        return view("investigations.index")->with('message', 'Successfully update investigation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investigation $investigation)
    {
        // dd("maaaasttttiiii");
		$investigation = Investigation::find($id);
        $investigation->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the Data!');
        return view('investigations.index');
    }
}
