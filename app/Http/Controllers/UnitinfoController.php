<?php

namespace App\Http\Controllers;

use App\Models\Unitinfo;
use Illuminate\Http\Request;

class UnitinfoController extends Controller
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
        $unitinfodata = DB::table('unit_info')->get();
		echo json_encode($unitinfodata);	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('tesy');
        $validated = $request->validate([
				'new_addunit'  	=> 'required'
				
        ]);

        $insertUnit = new Unitinfo;
        $insertUnit->description 		= Input::get('new_addunit');
            
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unitinfo  $unitinfo
     * @return \Illuminate\Http\Response
     */
    public function show(Unitinfo $unitinfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unitinfo  $unitinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(Unitinfo $unitinfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unitinfo  $unitinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unitinfo $unitinfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unitinfo  $unitinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unitinfo $unitinfo)
    {
        //
    }
}
