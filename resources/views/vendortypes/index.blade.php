@extends('layouts.master')
@section('content')

	<h3><a href="{{ route('vendortypes.create') }}">Add Vendor Type</a></h3>

	<br>

    <div class="col-lg-12 datatablescope ">
		<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Vendor Type Name</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($vendortype as $vendortype)
				<tr>
                    <td>{{$vendortype->id}}</td>
                    <td>{{$vendortype->vendor_type_name}}</td>
                    <td>
                        <form action="{{ route('vendortypes.destroy', $vendortype->id) }}", method="post">
                            <a class="btn btn-primary" href="{{ route('vendortypes.edit', $vendortype->id) }}">Edit</a>
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

