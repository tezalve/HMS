<?php

namespace App\Http\Controllers;

use App\Models\{ Customer, Customertype, User };
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::all();
        return view('customers.index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer_type_id = Customertype::all();
        $users_id = User::all();
        $user = auth()->user();
        return view('customers.create',compact('customer_type_id'))->with('users', $user->id);
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
            'customer_name' => 'required',
            'contact_number' => 'required',
            'email' => 'required',
            'address' => 'required',
            'contact_person' => 'required',
            'customer_type_id' => 'required',
            'users_id' => 'required'
        ]);

        $customer = new Customer;
        $customer->customer_name = $request->customer_name;
        $customer->contact_number = $request->contact_number;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->contact_person = $request->contact_person;
        $customer->customer_type_id = $request->customer_type_id;
        $customer->users_id = $request->users_id;

        // dd($medicine_generic_name);

        $customer->save();

        return redirect()->route('customers.index')
        ->with('success', 'Customer added successfully'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $customer_type_id = Customertype::all();
        return view('customers.create',compact('customer','customer_type_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'customer_name' => 'required',
            'contact_number' => 'required',
            'email' => 'required',
            'address' => 'required',
            'contact_person' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required',
            'customer_type_id' => 'required',
            'users_id' => 'required'
        ]);

        $customer = Customer::find($customer->id);
        $customer->customer_name = $request->customer_name;
        $customer->contact_number = $request->contact_number;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->contact_person = $request->contact_person;
        $customer->created_at = $request->created_at;
        $customer->updated_at = $request->updated_at;
        $customer->customer_type_id = $request->customer_type_id;
        $customer->users_id = $request->users_id;

        // dd($customer);

        $customer->save();

        return redirect()->route('customers.index')
        ->with('success', 'Customer updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')
        ->with('success', 'Customer deleted successfully'); 
    }
}
