<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Redirect;
use Auth;
use DB;
use DataTables;
use Crypt;
use Response;
use Validator;
use Config;
use Session;
use Entrust;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\PermissionRole;
use App\Models\AssignedRoles;

class RolePermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function role_permission_display(){

        // $permission = DB::select("SELECT 
        //             permissions.id,
        //             permissions.display_name,
        //             permission_role.permission_id AS permission_id,
        //             permission_role.role_id AS role_id
        //         FROM
        //             permissions
        //                 LEFT JOIN
        //             permission_role ON permission_role.permission_id = permissions.id
        //             WHERE permissions.isActive=1 ;");
        
        // $all_permission = Permission::all();
        // $all_roles = Role::all();

        return view('role_permission.role_permission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  

    public function submit_role_permission(Request $request){

        // dd('$request');
        $permissions = $request->permission;
        // dd($permissions);
        DB::table('role_has_permissions')->truncate();
        
        if($permissions!=null){

            foreach ($permissions as $permission ) {
            $temp           = explode(":", $permission);
            $role_id        = $temp[1];
            $permission_id  = $temp[0];
            
            $role_query     = Role::where('id', '=', $role_id)->first();

            $permission_query = Permission::where('id','=',$permission_id)->first();

            $insert = new PermissionRole;
            $insert->permission_id = $permission_id;
            $insert->role_id       = $role_id;
            $insert->save();
            }
        }
        
        DB::table('model_has_permissions')->truncate();
        // $test = 'App\\User';
        // dd($test);

        DB::insert("INSERT INTO model_has_permissions (permission_id,model_type,model_id) SELECT 
                        permission_id,'App\\\Models\\\User',model_id
                    FROM
                        model_has_roles a
                    JOIN
                    role_has_permissions b ON a.role_id = b.role_id");


        // exec("ls -la");
        \Artisan::call('optimize:clear');
        // DB::UPDATE ("UPDATE model_has_permissions SET model_type='App'\\'User'");


        // $query = DB::SELECT ("");
     
                  Session::flash('message','Successfully Insert!');
                  return redirect()->back();
                //   Session::flash('alert-type','success');
                //   return response::json(array(
                //      'success'   => true,
                //   ));
                  
    }

    // public function user_role_display(){
    //     $roles = DB::table('roles')->select('id','name')->get();
    //     $query_users = "
    //     SELECT 
    //     users.id AS user_id,
    //     users.name AS username,
    //     roles.id,
    //     roles.name 
    //     FROM users 
    //     LEFT JOIN 
    //     assigned_roles 
    //     ON users.id = assigned_roles.user_id
    //     LEFT JOIN roles
    //     ON 
    //     assigned_roles.role_id = roles.id
    //     ";
    //     $users = DB::select($query_users);
    //     return view('role_permission.user_role')->with('users',$users)->with('roles', $roles);        
    // }

    // public function submit_user_role($id){

    //     $user       = DB::table('users')->select('id','name','email')->where('id',$id)->first();
        
    //     $query_roles="SELECT 
    //                         roles.id AS role_id, roles.name AS role_name,assigned_roles.role_id as assigned_role_id
    //                     FROM
    //                         roles
    //                            LEFT JOIN
    //                         assigned_roles ON assigned_roles.user_id = '.$id.'
    //                             AND assigned_roles.role_id = roles.id";

    //     $roles=DB::select($query_roles);


    //     if(sizeof($roles)==0){
    //         return view('role_permission.user_role_create')
    //             ->with('user',$user);
    //     }else{
    //         return view('role_permission.user_role_create')
    //                 ->with('user',$user)
    //                 ->with('roles',$roles);
    //     }        
    // }

    // public function add_user_role(Request $request){

    //     $roles = $request->role;
    //     $user  = User::where('id', $request->user_id)->first();

    //     DB::table('assigned_roles')->where('user_id', '=', $request->user_id)->delete();
    //     DB::table('role_user')->where('user_id', '=', $request->user_id)->delete();



    //     foreach ($roles as $role) {


    //         $insert = new AssignedRoles;
    //         $insert->role_id = $role;
    //         $insert->user_id = $request->user_id;
    //         $insert->save();


    //         $roleuser= new RoleUser;
    //         $roleuser->user_id         =$request->user_id;
    //         $roleuser->role_id         =$role;                           
    //         $roleuser->save();

    //     }

    //     $request->session()->flash('alert-success', 'role has been successfully added!');
    //     return redirect()->back();        
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
