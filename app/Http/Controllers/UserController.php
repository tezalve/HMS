<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

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
            $data = User::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                            $btn = '<a href="" class="edit btn btn-primary btn-sm">View</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
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
        return redirect()->route('register')
        ->with('success', 'Rerouted to Register'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'user_name' => 'required',
        //     'contact_number' => 'required',
        //     'email' => 'required',
        //     'address' => 'required',
        //     'contact_person' => 'required',
        //     'user_type_id' => 'required',
        //     'users_id' => 'required'
        // ]);

        // $user = new user;
        // $user->user_name = $request->user_name;
        // $user->contact_number = $request->contact_number;
        // $user->email = $request->email;
        // $user->address = $request->address;
        // $user->contact_person = $request->contact_person;
        // $user->user_type_id = $request->user_type_id;
        // $user->users_id = $request->users_id;

        // // dd($medicine_generic_name);

        // $user->save();

        return redirect()->route('users.index')
        ->with('success', 'Please register instead'); 
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
    public function edit(User $user)
    {
        // return redirect()->route('users.index')
        // ->with('success', 'User Edit Not Implemented'); 
        return view('users.edit',compact('user'));
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
            'email' => 'required'
        ]);

        $user = user::find($user->id);
        $user->name = $request->name;
        $user->email = $request->email;

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
    public function destroy(User $user)
    {
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
