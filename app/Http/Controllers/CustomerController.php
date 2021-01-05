<?php

namespace App\Http\Controllers;

use App\Models\{ Customer, Customertype, User };
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::select('*');

            return Datatables::of($data)
                    ->addColumn('edit', function($row){
     
                        $btn1 = '<a href="'.route('customers.edit', Crypt::EncryptString($row->id)).'" class="edit btn btn-primary btn-sm">Edit</a>';
                        return $btn1;
                    })
                    ->addColumn('delete', function($row){
     
                        $btn2 = '<form action="'.route('customers.destroy', Crypt::EncryptString($row->id)).'" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="submit" class="edit btn btn-primary btn-sm">Delete
                        </form>';
                        return $btn2;
                    })
                    ->rawColumns(['edit', 'delete'])
                    ->make(true);
        }
        
        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer_type_id = Customertype::all();
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
    public function edit($customer)
    {
        try {
            $decrypted = Crypt::decryptString($customer);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $customer = Customer::where('id',$decrypted)->first();
        // dd("$customer");
        $customer_type_id = Customertype::all();
        return view('customers.edit',compact('customer','customer_type_id'));
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
    public function destroy($customer)
    {
        try {
            $decrypted = Crypt::decryptString($customer);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $customer = Customer::where('id',$decrypted)->first();
        // dd("$customer");
        $customer->delete();
        return redirect()->route('customers.index')
        ->with('success', 'Customer deleted successfully'); 
    }
}
