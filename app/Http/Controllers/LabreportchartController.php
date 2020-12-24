<?php

namespace App\Http\Controllers;

use App\Models\Labreportchart;
use App\Models\Labreport;
use Illuminate\Http\Request;
use DB;

class LabreportchartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('labreportcharts.reportchart');

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
				'investigtion_name' 	=> ['required', 'exists:investigation,id']
        ]);

		extract($_POST);
		$rowcount 			= count($parametername_grid);
		$investigation_id 	= $request->investigtion_name;
		$labreport_data 	= DB::select("SELECT * FROM labreport WHERE investigation_id = $investigation_id");
		
		if (!empty($labreport_data)){
			DB::table('labreport')->where('investigation_id', '=',$investigation_id)->delete();
		}

        for($r= 0; $r<$rowcount; $r++) {
            if($parametername_grid[$r] != "") {
                $insert_labreport 						= new Labreport;
                $insert_labreport->investigation_id 	= $request->investigtion_name;
                $insert_labreport->parameter 			= $parametername_grid[$r];
                $insert_labreport->alias_name 			= $aliasname_grid[$r];
                $insert_labreport->normal_value 		= $normalvalue_grid[$r];
                $insert_labreport->result_value 		= $result_value_grid[$r];
                $insert_labreport->unit 				= $unitname_grid[$r];
                $insert_labreport->report_group 		= $groupname_grid[$r];
                $insert_labreport->group_sl 			= $groupls_grid[$r];
                $insert_labreport->sl_no 				= $slno_grid[$r];
                $insert_labreport->report_file_name 	= $request->reportfilename;
                dd($insert_labreport);
                $insert_labreport->save();
            }	
        }
        return redirect()->back();
		// Labreport models
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Labreportchart  $labreportchart
     * @return \Illuminate\Http\Response
     */
    public function show(Labreportchart $labreportchart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Labreportchart  $labreportchart
     * @return \Illuminate\Http\Response
     */
    public function edit(Labreportchart $labreportchart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Labreportchart  $labreportchart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Labreportchart $labreportchart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Labreportchart  $labreportchart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Labreportchart $labreportchart)
    {
        //
    }
}
