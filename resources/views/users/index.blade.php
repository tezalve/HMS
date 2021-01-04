@extends('layouts.master')
@section('content')

	<h3><a href="{{ route('users.create') }}">Add User</a></h3>

	<br>

    <div class="col-lg-12 datatablescope ">
		<table id="example" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Created At</th>
					<!-- <th>Default Discount</th>
					<th>Default Vat</th> -->
					<th>Updated At</th> 
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($user as $user)
					<tr>
						<td>{{$user->id}}</td>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						<td>{{$user->created_at}}</td>
						<!-- <td>{{$user->default_discount}}</td>
						<td>{{$user->default_vat}}</td> -->
						<td>{{$user->updated_at}}</td> 
						<td>
							<form action="{{ route('users.destroy', $user->id) }}", method="post">
								<a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
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

