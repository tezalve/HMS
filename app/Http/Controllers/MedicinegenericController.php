<?php

namespace App\Http\Controllers;

use App\Models\Medicinegeneric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use DB;

class MedicinegenericController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Medicinegeneric::select('*');

            return Datatables::of($data)
                    ->addColumn('edit', function($row){
     
                        $btn1 = '<a href="'.route('medicinegenerics.edit', Crypt::EncryptString($row->id)).'" class="edit btn btn-primary btn-sm">Edit</a>';
                        return $btn1;
                    })
                    ->addColumn('delete', function($row){
     
                        $btn2 = '<form action="'.route('medicinegenerics.destroy', Crypt::EncryptString($row->id)).'" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="submit" class="edit btn btn-primary btn-sm">Delete
                        </form>';
                        return $btn2;
                    })
                    ->rawColumns(['edit', 'delete'])
                    ->make(true);
        } 
        
        return view('medicinegenerics.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        if(request()->ajax()){
            $medicine_generic_names_id = DB::table('medicine_generic_names')->get();
            echo json_encode($medicine_generic_names_id);
        }
        
        return view('medicinegenerics.create');
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
            'generic_name' => 'required'
        ]);

        $medicinegeneric = new Medicinegeneric;

        $medicinegeneric->generic_name = $request->generic_name;

        // dd($medicine_generic_name);

        $medicinegeneric->save();

        $page = (explode('/', url()->previous()));

        if ($page[3]=='medicinegenerics'){
            return redirect()->route('medicinegenerics.index')
            ->with('success', 'Generic name added successfully');
        }

        return redirect()->back()->with('success', 'Generic name added successfully'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicinegeneric  $medicinegeneric
     * @return \Illuminate\Http\Response
     */
    public function show(Medicinegeneric $medicinegeneric)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicinegeneric  $medicinegeneric
     * @return \Illuminate\Http\Response
     */
    public function edit($medicinegeneric)
    {
        try {
            $decrypted = Crypt::decryptString($medicinegeneric);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $medicinegeneric = Medicinegeneric::where('id',$decrypted)->first();

        return view('medicinegenerics.edit', compact('medicinegeneric'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicinegeneric  $medicinegeneric
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicinegeneric $medicinegeneric)
    {
        $validated = $request->validate([
            'generic_name' => 'required'
        ]);

        $medicinegeneric = Medicinegeneric::find($medicinegeneric->id);

        $medicinegeneric->generic_name = $request->generic_name;

        // dd($medicine_generic_name);

        $medicinegeneric->save();

        return redirect()->route('medicinegenerics.index')
        ->with('success', 'Generic name updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicinegeneric  $medicinegeneric
     * @return \Illuminate\Http\Response
     */
    public function destroy($medicinegeneric)
    {
        try {
            $decrypted = Crypt::decryptString($medicinegeneric);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $medicinegeneric = Medicinegeneric::where('id',$decrypted)->first();
        
        $medicinegeneric->delete();
        return redirect()->route('medicinegenerics.index')
        ->with('success', 'Generic name deleted successfully'); 
    }
}
