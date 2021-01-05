@extends('layouts.master')
@section('content')
	<div class="">
		<h1>Medicine Units</h1>

		<h1><a href="{{ route('medicineunits.create') }}">Add Medicine Unit</a></h1>

		<table class="table table-bordered data-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Medicine Unit Name</th>
					<th width="100px">Action</th>
				</tr>
			</thead>
		</table>
	</div>
        
	<script type="text/javascript">
		$(function () {
			var table = $('.data-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('medicineunits.index') }}",
				columns: [
					{data: 'id', name: 'id'},
					{data: 'unit_name', name: 'unit_name'},
					{data: 'edit', name: 'edit', orderable: false, searchable: false},
					{data: 'delete', name: 'delete', orderable: false, searchable: false},
				]
			});
		});
	</script>
@stop







