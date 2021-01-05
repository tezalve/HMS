<?php

namespace App\Http\Controllers;

use App\Models\Vendortype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;

class VendortypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Vendortype::select('*');

            return Datatables::of($data)
                    ->addColumn('edit', function($row){
     
                        $btn1 = '<a href="'.route('vendortypes.edit', Crypt::EncryptString($row->id)).'" class="edit btn btn-primary btn-sm">Edit</a>';
                        return $btn1;
                    })
                    ->addColumn('delete', function($row){
     
                        $btn2 = '<form action="'.route('vendortypes.destroy', Crypt::EncryptString($row->id)).'" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="submit" class="edit btn btn-primary btn-sm">Delete
                        </form>';
                        return $btn2;
                    })
                    ->rawColumns(['edit', 'delete'])
                    ->make(true);
        } 
        return view('vendortypes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->ajax()){
            $vendor_type_id = DB::table('vendor_type')->get();
            echo json_encode($vendor_type_id);
        }
        return view('vendortypes.create');
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
            'vendor_type_name' => 'required'
        ]);

        $vendortype = new Vendortype;

        $vendortype->vendor_type_name = $request->vendor_type_name;

        // dd($medicine_generic_name);

        $vendortype->save();

        $page = (explode('/', url()->previous()));

        if ($page[3]=='vendortypes'){
        return redirect()->route('vendortypes.index')
        ->with('success', 'Vendor type name added successfully');
        }

        return redirect()->back()->with('success', 'Vendor type name added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendortype  $vendortype
     * @return \Illuminate\Http\Response
     */
    public function show(Vendortype $vendortype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendortype  $vendortype
     * @return \Illuminate\Http\Response
     */
    public function edit($vendortype)
    {
        try {
            $decrypted = Crypt::decryptString($vendortype);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $vendortype = Vendortype::where('id',$decrypted)->first();
        
        return view('vendortypes.edit', compact('vendortype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendortype  $vendortype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendortype $vendortype)
    {
        $validated = $request->validate([
            'vendor_type_name' => 'required'
        ]);

        $vendortype = Vendortype::find($vendortype->id);

        $vendortype->vendor_type_name = $request->vendor_type_name;

        // dd($medicine_generic_name);

        $vendortype->save();

        return redirect()->route('vendortypes.index')
        ->with('success', 'Vendor type name Updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendortype  $vendortype
     * @return \Illuminate\Http\Response
     */
    public function destroy($vendortype)
    {
        try {
            $decrypted = Crypt::decryptString($vendortype);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $vendortype = Vendortype::where('id',$decrypted)->first();

        $vendortype->delete();

        return redirect()->route('vendortypes.index')
        ->with('success', 'Vendor type name Deleted successfully'); 
    }
}
