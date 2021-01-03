@extends('layouts.master')
@section('content')
	<h3><a href="{{ route('medicineunits.create') }}">Add Unit Name</a></h3>

	<br>

    <div class="col-lg-12 datatablescope ">
		<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Medicine Unit Name</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($medicineunit as $medicineunit)
				<tr>
                    <td>{{$medicineunit->id}}</td>
                    <td>{{$medicineunit->unit_name}}</td>
                    <td>
                        <form action="{{ route('medicineunits.destroy', $medicineunit->id) }}", method="post">
                            <a class="btn btn-primary" href="{{ route('medicineunits.edit', $medicineunit->id) }}">Edit</a>
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

