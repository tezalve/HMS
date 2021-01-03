@extends('layouts.master')
@section('content')

	<h3><a href="{{ route('vendors.create') }}">Add Vendor</a></h3>

	<br>

    <div class="col-lg-12 datatablescope ">
		<table id="example" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Vendor Name</th>
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
				@foreach ($vendor as $vendor)
					<tr>
						<td>{{$vendor->id}}</td>
						<td>{{$vendor->vendor_name}}</td>
						<td>{{$vendor->contact_number}}</td>
						<td>{{$vendor->email}}</td>
						<td>{{$vendor->address}}</td>
						<!-- <td>{{$vendor->default_discount}}</td>
						<td>{{$vendor->default_vat}}</td> -->
						<td>{{$vendor->users_id}}</td> 
						<td>
							<form action="{{ route('vendors.destroy', $vendor->id) }}", method="post">
								<a class="btn btn-primary" href="{{ route('vendors.edit', $vendor->id) }}">Edit</a>
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

