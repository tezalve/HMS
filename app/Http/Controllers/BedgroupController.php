<?php

namespace App\Http\Controllers;

use App\Models\Bedgroup;
use Illuminate\Http\Request;
use DB;

class BedgroupController extends Controller
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
        $validated = $request->validate([
            'new_category_name' => 'required'
        ]);

        $bedsgroup = new Bedgroup;
		$bedsgroup->description = $request->new_category_name;
		$bedsgroup->save();
		return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bedgroup  $bedgroup
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $bedgrouplistdata = DB::table('bed_group')->get();
		echo json_encode($bedgrouplistdata);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bedgroup  $bedgroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Bedgroup $bedgroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bedgroup  $bedgroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bedgroup $bedgroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bedgroup  $bedgroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bedgroup $bedgroup)
    {
        //
    }
}
