<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
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
use App\Models\ModelHasRole;
use App\Models\ModelHasPermission;

// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;


class AssignedRoleController extends Controller
{
    /** emo
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  



    public function user_role_display(){
        $roles = DB::table('roles')->select('id','name')->get();

        $query_users = "SELECT 
                            users.id AS users_id,
                            users.name AS username,
                            GROUP_CONCAT(roles.name) as name
                        FROM
                            users
                                LEFT JOIN
                            assigned_roles ON users.id = assigned_roles.users_id AND users.activated = 1
                                LEFT JOIN
                            roles ON assigned_roles.role_id = roles.id
                        GROUP BY users.id";
        $users = DB::select($query_users);

        // dd("NOMAN");

        return view('assigned_roles.user_role')->with('users',$users)->with('roles', $roles);        
    }

    public function submit_user_role($id){

        $user    = DB::table('users')->select('id','name','email')->where('id',$id)->first();
        $roles   = DB::SELECT("SELECT 
                                    roles.id AS roles_id, roles.name AS role_name, assigned_roles.role_id as assigned_roles_id
                               FROM
                                   roles, assigned_roles
                               JOIN 
                                   assigned_roles a ON assigned_roles.users_id = '$id' AND assigned_roles.role_id");

        // dd($roles);

            return view('assigned_roles.user_role_create')
                    ->with('user',$user)
                    // ->with('all_roles',$all_roles)
                    ->with('roles',$roles);
            
    }


    public function add_user_role(Request $request){

            $roles = $request->role;
            $user  = User::where('id', $request->users_id)->first();

        DB::beginTransaction();
        try {
                DB::table('assigned_roles')->where('users_id', '=', $request->users_id)->delete();
                DB::table('model_has_roles')->where('model_id', '=', $request->users_id)->delete();
                DB::table('model_has_permissions')->where('model_id', '=', $request->users_id)->delete();
               
                foreach ($roles as $role) {

                    $insert = new AssignedRoles;
                    $insert->roles_id = $role;
                    $insert->users_id = $request->users_id;
                    $insert->save();

                    $insert_role = new ModelHasRole;
                    $insert_role->role_id    = $role;
                    $insert_role->model_type = 'App\User';
                    $insert_role->model_id   = $request->users_id;
                    $insert_role->save();

                    $roles_id_for_temp = $role;
                }
                
               $role_permissions=  DB::SELECT ("SELECT * FROM role_has_permissions WHERE role_id=$roles_id_for_temp");

              
                foreach ($role_permissions as $permission) {

                    $insert_role = new ModelHasPermission;
                    $insert_role->permission_id  = $permission->permission_id;
                    $insert_role->model_type     = 'App\User';
                    $insert_role->model_id       = $request->users_id;
                    $insert_role->save();

                }


                \Artisan::call('optimize:clear');




        DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return Redirect()->back()->withErrors($e->getMessage())->withInput();
            } 


        return response::json(array(
           'success'   => true,
           // 'id'        => Crypt::encrypt($insert_data->id),
           'messages'  => 'Successfully Updated!'
        ));


    }

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
