<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;

class PermissionController extends Controller
{
    /** emo
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Permission::select('*');

            return Datatables::of($data)
                    ->addColumn('edit', function($row){
     
                        $btn1 = '<a href="'.route('permissions.edit', Crypt::EncryptString($row->id)).'" class="edit btn btn-primary btn-sm">Edit</a>';
                        return $btn1;
                    })
                    ->addColumn('delete', function($row){
     
                        $btn2 = '<form action="'.route('permissions.destroy', Crypt::EncryptString($row->id)).'" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="submit" class="edit btn btn-primary btn-sm">Delete
                        </form>';
                        return $btn2;
                    })
                    ->rawColumns(['edit', 'delete'])
                    ->make(true);
        } 
        
        return view('permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
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
            'name' => 'required'
        ]);

        $permission = new permission;

        $permission->name = $request->name;
        $permission->guard_name = $request->display_name;
        $permission->is_active = 1;

        // dd($medicine_generic_name);

        $permission->save();

        $page = (explode('/', url()->previous()));
        
        if ($page[3]=='permissions'){
            return redirect()->route('permissions.index')
            ->with('success', 'permission added successfully');
        }

        return redirect()->back()->with('success', 'Permission added successfully'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($permission)
    {
        try {
            $decrypted = Crypt::decryptString($permission);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $permission = permission::where('id',$decrypted)->first();

        return view('permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $permission = permission::find($permission->id);

        $permission->name = $request->name;

        $permission->guard_name = $request->display_name;
        $permission->is_active = 1;

        // dd($medicine_generic_name);

        $permission->save();

        return redirect()->route('permissions.index')
        ->with('success', 'Permission updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($permission)
    {
        try {
            $decrypted = Crypt::decryptString($permission);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $permission = Permission::where('id',$decrypted)->first();

        $permission->delete();
        return redirect()->route('permissions.index')
        ->with('success', 'Permission deleted successfully'); 
    }
}
