<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Bedgroup;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;

class BedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Bed::select('*');
           
            return Datatables::of($data)
                    ->addColumn('edit', function($row){
     
                        $btn1 = '<a href="'.route('beds.edit', Crypt::EncryptString($row->id)).'" class="edit btn btn-primary btn-sm">Edit</a>';
                        return $btn1;
                    })
                    ->addColumn('delete', function($row){
     
                        $btn2 = '<form action="'.route('beds.destroy', Crypt::EncryptString($row->id)).'" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="submit" class="edit btn btn-primary btn-sm">Delete
                        </form>';
                        return $btn2;
                    })
                    ->rawColumns(['edit', 'delete'])
                    ->make(true);
        }

        $bed = Bed::all();
		$bedgroup = Bedgroup::all();
		return View('beds.index', compact('bed','bedgroup'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bedgroup = Bedgroup::all();
        $floor = Floor::all();
        return View('beds.create', compact('bedgroup', 'floor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('test');

        $validated = $request->validate([
            'bedno'  	        => 'required',
            'description' 		=> 'required',
            'bedcategory' 		=> 'required',
            'floorno'			=> 'required',
            'unitprice'			=> 'required'
        ]);

        $insertbed = new Bed;
		$insertbed->bed_no 					= $request->bedno;
		$insertbed->description 			= $request->description;		
		$insertbed->bed_group_id 			= $request->bedcategory;		
		$insertbed->floor_information_id 	= $request->floorno;		
		$insertbed->charge 					= $request->unitprice;
		$insertbed->bed_active_status 		= 1;
		$insertbed->valid 					= 1;
        
		$insertbed->save();
		return redirect()->route('beds.index')
            ->with('success', 'Bed created successfully');
	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function show(Bed $bed)
    {
        return view('beds.show', compact('bed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function edit($bed)
    {
        // dd($bed);
        try {
            $decrypted = Crypt::decryptString($bed);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $bed = Bed::where('id',$decrypted)->first();
        // dd("$bed");
        $bedgroup = Bedgroup::all();
        $floor = Floor::all();
        return View('beds.edit', compact('bed', 'floor', 'bedgroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bed $bed)
    {

        $validated = $request->validate([
            'bedno'  	        => 'required',
            'description' 		=> 'required',
            'bedcategory' 		=> 'required',
            'floorno'			=> 'required',
            'unitprice'			=> 'required'
        ]);

        $bed                            = Bed::find($bed->id);
		$bed->bed_no 					= $request->bedno;
		$bed->description 			    = $request->description;		
		$bed->bed_group_id 			    = $request->bedcategory;		
		$bed->floor_information_id 	    = $request->floorno;		
		$bed->charge 					= $request->unitprice;
		$bed->bed_active_status 		= 1;
        $bed->valid 					= 1;
        
        $bed->save();
        
		return redirect()->route('beds.index')
            ->with('success', 'Bed updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function destroy($bed)
    {
        try {
            $decrypted = Crypt::decryptString($bed);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $bed = Bed::where('id', $decrypted)->first();
        // dd("$bed");

        $bed->delete();

        return redirect()->route('beds.index')
            ->with('success', 'Bed deleted successfully');
    }
}
