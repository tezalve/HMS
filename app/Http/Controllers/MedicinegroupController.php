<?php

namespace App\Http\Controllers;

use App\Models\Medicinegroup;
use Illuminate\Http\Request;
use DataTables;
use DB;

class MedicinegroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Medicinegroup::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('edit', function($row){
     
                        $btn1 = '<a href="" class="edit btn btn-primary btn-sm">Edit</a>';
                        return $btn1;
                    })
                    ->addColumn('delete', function($row){
     
                        $btn2 = '<a href="" class="delete btn btn-primary btn-sm">delete</a>';
                        return $btn2;
                    })
                    ->rawColumns(['edit', 'delete'])
                    ->make(true);
        } 
        
        return view('medicinegroups.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->ajax()){
            $medicine_groups_id = DB::table('medicine_groups')->get();
            echo json_encode($medicine_groups_id);
        }
        return view('medicinegroups.create');
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
            'group_name' => 'required'
        ]);

        $medicinegroup = new Medicinegroup;

        $medicinegroup->group_name = $request->group_name;

        // dd($medicine_generic_name);

        $medicinegroup->save();

        $page = (explode('/', url()->previous()));
        
        if ($page[3]=='medicinegenerics'){
            return redirect()->route('medicinegroups.index')
            ->with('success', 'Group name added successfully');  
        }

        return redirect()->back()->with('success', 'Group name added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicinegroup  $medicinegroup
     * @return \Illuminate\Http\Response
     */
    public function show(Medicinegroup $medicinegroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicinegroup  $medicinegroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicinegroup $medicinegroup)
    {
        return view('medicinegroups.edit', compact('medicinegroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicinegroup  $medicinegroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicinegroup $medicinegroup)
    {
        $validated = $request->validate([
            'group_name' => 'required'
        ]);

        $medicinegroup = Medicinegroup::find($medicinegroup->id);

        $medicinegroup->group_name = $request->group_name;

        // dd($medicine_generic_name);

        $medicinegroup->save();

        return redirect()->route('medicinegroups.index')
        ->with('success', 'Group name Updated successfully');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicinegroup  $medicinegroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicinegroup $medicinegroup)
    {
        $medicinegroup->delete();

        return redirect()->route('medicinegroups.index')
        ->with('success', 'Group name Deleted successfully');  

    }
}
