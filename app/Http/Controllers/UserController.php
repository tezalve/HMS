<?php

namespace App\Http\Controllers;

use App\Models\{ User, Role, AssignedRoles, ModelHasRole, ModelHasPermission};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::join('roles as r','r.id','=','users.roles_id')
            ->select('users.id','users.name', 'users.email', 'users.created_at', 'r.name as role_name' )
            ->get();

            return Datatables::of($data)
                    ->addColumn('edit', function($row){
     
                        $btn1 = '<a href="'.route('users.edit', Crypt::EncryptString($row->id)).'" class="edit btn btn-primary btn-sm">Edit</a>';
                        return $btn1;
                    })
                    ->addColumn('delete', function($row){
     
                        $btn2 = '<form action="'.route('users.destroy', Crypt::EncryptString($row->id)).'" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="submit" class="edit btn btn-primary btn-sm">Delete
                        </form>';
                        return $btn2;
                    })
                    
                    ->rawColumns(['edit', 'delete'])
                    ->make(true);
        } 
        
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
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
            'name' => 'required',
            'email' => 'required',
            'phone_no' => 'required',
            'address' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);

        // $user = new User;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->phone_no = $request->phone_no;
        // $user->address = $request->address;
        // $user->roles_id = $request->role;

        $userdata = User::create([
            'name'              => $request->name,
            'phone_no'          => $request->phone_no,
            'address'           => $request->address,
            'email'             => $request->email,
            'roles_id'          => $request->role,
            'password'          => bcrypt($request->password)
        ]);

        $insert = new AssignedRoles;
        $insert->role_id = $request->role;
        $insert->users_id = $userdata->id;
        $insert->save();

        $insert_role = new ModelHasRole;
        $insert_role->role_id    = $request->role;
        $insert_role->model_type = 'App\Models\User';
        $insert_role->model_id   = $userdata->id;
        $insert_role->save();


        $role_permissions=  DB::SELECT ("SELECT * FROM role_has_permissions WHERE role_id=$request->role");

        dd($role_permissions);

        foreach ($role_permissions as $permission) {
        $insert_role = new ModelHasPermission;
        $insert_role->permission_id  = $permission->permission_id;
        $insert_role->model_type     = 'App\Models\User';
        $insert_role->model_id       = $userdata->id;
        $insert_role->save();
        }

        \Artisan::call('optimize:clear');
        return redirect()->route('users.index')->with('success', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        try {
            $decrypted = Crypt::decryptString($user);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $user = User::where('id',$decrypted)->first();
        $roles = Role::all();
        // return redirect()->route('users.index')
        // ->with('success', 'User Edit Not Implemented'); 
        return view('users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_no' => 'required',
            'address' => 'required'
        ]);

        $user = User::find($user->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->address = $request->address;
        $user->roles_id = $request->role;

        // dd($user);

        $user->save();

        return redirect()->route('users.index')
        ->with('success', 'User Updated Successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        try {
            $decrypted = Crypt::decryptString($user);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $user = user::where('id',$decrypted)->first();

        $usernow = auth()->user();
        if ($usernow->id != $user->id){
            $user->delete();
            return redirect()->route('users.index')
            ->with('success', "User deleted Successfully");
        } else {
            return redirect()->route('users.index')
            ->with('success', "Can't Delete Logged In User");
        }
    }

    public function shownoid()
    {
        $user = auth()->user();
        return view('users.show', compact('user'));
    }
}
