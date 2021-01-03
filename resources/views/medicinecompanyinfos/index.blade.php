@extends('layouts.master')
@section('content')

	<h3><a href="{{ route('medicinecompanyinfos.create') }}">Add Company</a></h3>

	<br>

    <div class="col-lg-12 datatablescope ">
		<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Company Name</th>
				<th>Address</th>
				<th>Contact Number</th>
				<th>Contact Person</th>
				<!-- <th>Default Discount</th>
				<th>Default Vat</th> -->
				<th>Users ID</th> 
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($medicinecompanyinfo as $medicinecompanyinfo)
				<tr>
                    <td>{{$medicinecompanyinfo->id}}</td>
                    <td>{{$medicinecompanyinfo->company_name}}</td>
					<td>{{$medicinecompanyinfo->address}}</td>
					<td>{{$medicinecompanyinfo->contact_number}}</td>
					<td>{{$medicinecompanyinfo->contact_person}}</td>
					<!-- <td>{{$medicinecompanyinfo->default_discount}}</td>
					<td>{{$medicinecompanyinfo->default_vat}}</td> -->
					<td>{{$medicinecompanyinfo->users_id}}</td> 
                    <td>
                        <form action="{{ route('medicinecompanyinfos.destroy', $medicinecompanyinfo->id) }}", method="post">
                            <a class="btn btn-primary" href="{{ route('medicinecompanyinfos.edit', $medicinecompanyinfo->id) }}">Edit</a>
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

