@extends('layouts.master')
@section('content')

    <h3 style="color: Blue">This is where your medicinces go</h3>

    <br>

	<h3><a href="{{ route('medicines.create') }}">New Medicine</a></h3>

	<br>

    <div class="col-lg-12 datatablescope ">
		<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Medicine name</th>
				<th>Price</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($medicine as $medicine)
				<tr>
                    <td>{{$medicine->medicine_name}}</td>
                    <td>{{$medicine->price}}</td>
                    <td>
                        <form action="{{ route('medicines.destroy', $medicine->id) }}", method="post">
                            <a class="btn btn-primary" href="{{ route('medicines.edit', $medicine->id) }}">Edit</a>
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

