<?php

namespace App\Http\Controllers;

use App\Models\Subdepartment;
use Illuminate\Http\Request;
use DB;

class SubdepartmentController extends Controller
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
        $subdepartmentdata = DB::table('sub_department')->get();
		echo json_encode($subdepartmentdata);	
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
				'new_sub_department'  	=> 'required',
				'departmentlist'  		=> 'required'
        ]);

        $insertSubdepartment = new Subdepartment;
        $insertSubdepartment->description 		= $request->new_sub_department;
        $insertSubdepartment->department_id 	= $request->departmentlist;
        // dd("$insertSubdepartment");
        $insertSubdepartment->save();
            
        return redirect()->back();
        
				
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subdepartment  $subdepartment
     * @return \Illuminate\Http\Response
     */
    public function show(Subdepartment $subdepartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subdepartment  $subdepartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Subdepartment $subdepartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subdepartment  $subdepartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subdepartment $subdepartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subdepartment  $subdepartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subdepartment $subdepartment)
    {
        //
    }
}
