<?php

namespace App\Http\Controllers;

use App\Models\Customertype;
use Illuminate\Http\Request;
use DataTables;

class CustomertypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customertype::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                            $btn = '<a href="" class="edit btn btn-primary btn-sm">View</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        } 
        
        return view('customertypes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->ajax()){
            $customer_type_id = DB::table('customer_type')->get();
            echo json_encode($customer_type_id);
        }
        return view('customertypes.create');
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
            'customer_type_name' => 'required'
        ]);

        $customertype = new Customertype;

        $customertype->customer_type_name = $request->customer_type_name;

        // dd($page[3]);

        $customertype->save();

        $page = (explode('/', url()->previous()));

        if ($page[3]=='customertypes'){
        return redirect()->route('customertypes.index')
        ->with('success', 'Customer type name added successfully');
        }  

        return redirect()->back()->with('success', 'Customer type name added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customertype  $customertype
     * @return \Illuminate\Http\Response
     */
    public function show(Customertype $customertype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customertype  $customertype
     * @return \Illuminate\Http\Response
     */
    public function edit(Customertype $customertype)
    {
        return view('customertypes.edit', compact('customertype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customertype  $customertype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customertype $customertype)
    {
        $validated = $request->validate([
            'customer_type_name' => 'required'
        ]);

        $customertype = Customertype::find($customertype->id);

        $customertype->customer_type_name = $request->customer_type_name;

        // dd($medicine_generic_name);

        $customertype->save();

        return redirect()->route('customertypes.index')
        ->with('success', 'Customer type name Updated successfully');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customertype  $customertype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customertype $customertype)
    {
        $customertype->delete();

        return redirect()->route('customertypes.index')
        ->with('success', 'Customer type name Deleted successfully');  
    }
}
