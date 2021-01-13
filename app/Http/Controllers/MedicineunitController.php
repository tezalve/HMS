<?php

namespace App\Http\Controllers;

use App\Models\Medicineunit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use DB;

class MedicineunitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Medicineunit::select('*');

            return Datatables::of($data)
                    ->addColumn('edit', function($row){
     
                        $btn1 = '<a href="'.route('medicineunits.edit', Crypt::EncryptString($row->id)).'" class="edit btn btn-primary btn-sm">Edit</a>';
                        return $btn1;
                    })
                    ->addColumn('delete', function($row){
     
                        $btn2 = '<form action="'.route('medicineunits.destroy', Crypt::EncryptString($row->id)).'" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="submit" class="edit btn btn-primary btn-sm">Delete
                        </form>';
                        return $btn2;
                    })
                    ->rawColumns(['edit', 'delete'])
                    ->make(true);
        } 
        
        return view('medicineunits.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->ajax()){
            $medicine_units_id = DB::table('medicine_units')->get();
            echo json_encode($medicine_units_id);
        }
        return view('medicineunits.create');
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
            'unit_name' => 'required'
        ]);

        $medicineunit = new Medicineunit;

        $medicineunit->unit_name = $request->unit_name;

        // dd($medicine_generic_name);

        $medicineunit->save();

        $page = (explode('/', url()->previous()));
        
        if ($page[3]=='medicineunits'){
            return redirect()->route('medicineunits.index')
            ->with('success', 'Unit Name added successfully');
        }

        return redirect()->back()->with('success', 'Unit added successfully'); 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicineunit  $medicineunit
     * @return \Illuminate\Http\Response
     */
    public function show(Medicineunit $medicineunit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicineunit  $medicineunit
     * @return \Illuminate\Http\Response
     */
    public function edit($medicineunit)
    {
        try {
            $decrypted = Crypt::decryptString($medicineunit);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $medicineunit = medicineunit::where('id',$decrypted)->first();
        
        return view('medicineunits.edit', compact('medicineunit',$medicineunit));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicineunit  $medicineunit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicineunit $medicineunit)
    {
        $validated = $request->validate([
            'unit_name' => 'required'
        ]);

        $medicineunit = Medicineunit::find($medicineunit->id);

        $medicineunit->unit_name = $request->unit_name;

        // dd($medicine_generic_name);

        $medicineunit->save();

        return redirect()->route('medicineunits.index')
        ->with('success', 'Unit Name updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicineunit  $medicineunit
     * @return \Illuminate\Http\Response
     */
    public function destroy($medicineunit)
    {
        try {
            $decrypted = Crypt::decryptString($medicineunit);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $medicineunit = medicineunit::where('id',$decrypted)->first();

        $medicineunit->delete();
        return redirect()->route('medicineunits.index')
        ->with('success', 'Unit Name Deleted successfully'); 
    }
}
