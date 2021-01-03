@extends('layouts.master')
@section('content')

	<h3><a href="{{ route('customertypes.create') }}">Add Customer Type</a></h3>

	<br>

    <div class="col-lg-12 datatablescope ">
		<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Customer Type Name</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($customertype as $customertype)
				<tr>
                    <td>{{$customertype->id}}</td>
                    <td>{{$customertype->customer_type_name}}</td>
                    <td>
                        <form action="{{ route('customertypes.destroy', $customertype->id) }}", method="post">
                            <a class="btn btn-primary" href="{{ route('customertypes.edit', $customertype->id) }}">Edit</a>
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

