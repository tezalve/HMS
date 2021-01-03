@extends('layouts.master')
@section('content')

	<h3><a href="{{ route('customers.create') }}">Add Customers</a></h3>

	<br>

    <div class="col-lg-12 datatablescope ">
		<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Customer Name</th>
				<th>Contact Number</th>
				<th>Email</th>
				<th>Address</th>
				<!-- <th>Default Discount</th>
				<th>Default Vat</th> -->
				<th>Users ID</th> 
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($customer as $customer)
				<tr>
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->customer_name}}</td>
					<td>{{$customer->contact_number}}</td>
					<td>{{$customer->email}}</td>
					<td>{{$customer->address}}</td>
					<!-- <td>{{$customer->default_discount}}</td>
					<td>{{$customer->default_vat}}</td> -->
					<td>{{$customer->users_id}}</td> 
                    <td>
                        <form action="{{ route('customers.destroy', $customer->id) }}", method="post">
                            <a class="btn btn-primary" href="{{ route('customers.edit', $customer->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary" title="delete">Delete</button>
                        </form>
                    </td>
				</tr>
			@endforeach
		</tbody>
		</table>
	</div>	
@stop

