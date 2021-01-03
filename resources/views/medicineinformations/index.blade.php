@extends('layouts.master')
@section('content')

	<h3><a href="{{ route('medicineinformations.create') }}">Add Medicine</a></h3>

	<br>

    <div class="col-lg-12 datatablescope ">
		<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Medicine Name</th>
				<th>Price</th>
				<th>TP</th>
				<th>Default Discount</th>
				<th>Default Vat</th>
				<!-- <th>Default Discount</th>
				<th>Default Vat</th> -->
				<th>Users ID</th> 
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($medicineinformation as $medicineinformation)
				<tr>
                    <td>{{$medicineinformation->id}}</td>
                    <td>{{$medicineinformation->medicine_name}}</td>
					<td>{{$medicineinformation->mrp}}</td>
					<td>{{$medicineinformation->tp}}</td>
					<td>{{$medicineinformation->default_discount}}%</td>
					<td>{{$medicineinformation->default_vat}}%</td>
					<!-- <td>{{$medicineinformation->default_discount}}</td>
					<td>{{$medicineinformation->default_vat}}</td> -->
					<td>{{$medicineinformation->users_id}}</td> 
                    <td>
                        <form action="{{ route('medicineinformations.destroy', $medicineinformation->id) }}", method="post">
                            <a class="btn btn-primary" href="{{ route('medicineinformations.edit', $medicineinformation->id) }}">Edit</a>
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

