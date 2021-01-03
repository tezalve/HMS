@extends('layouts.master')
@section('content')

	<h3><a href="{{ route('medicinegenerics.create') }}">Add Generic Name</a></h3>

	<br>

    <div class="col-lg-12 datatablescope ">
		<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Medicine Generic Name</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($medicinegeneric as $medicinegeneric)
				<tr>
                    <td>{{$medicinegeneric->id}}</td>
                    <td>{{$medicinegeneric->generic_name}}</td>
                    <td>
                        <form action="{{ route('medicinegenerics.destroy', $medicinegeneric->id) }}", method="post">
                            <a class="btn btn-primary" href="{{ route('medicinegenerics.edit', $medicinegeneric->id) }}">Edit</a>
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

