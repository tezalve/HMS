@extends('layouts.master')
@section('content')

	<h3><a href="{{ route('medicinegroups.create') }}">Add Group Name</a></h3>

	<br>

    <div class="col-lg-12 datatablescope ">
		<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Medicine Group Name</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($medicinegroup as $medicinegroup)
				<tr>
                    <td>{{$medicinegroup->id}}</td>
                    <td>{{$medicinegroup->group_name}}</td>
                    <td>
                        <form action="{{ route('medicinegroups.destroy', $medicinegroup->id) }}", method="post">
                            <a class="btn btn-primary" href="{{ route('medicinegroups.edit', $medicinegroup->id) }}">Edit</a>
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

