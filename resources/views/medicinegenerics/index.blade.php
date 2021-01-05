@extends('layouts.master')
@section('content')
	<div class="">
		<h1>Medicine Generic Names</h1>

		<h1><a href="{{ route('medicinegenerics.create') }}">Add Medicine Generic</a></h1>

		<table class="table table-bordered data-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Medicine Generic Name</th>
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
				ajax: "{{ route('medicinegenerics.index') }}",
				columns: [
					{data: 'id', name: 'id'},
					{data: 'generic_name', name: 'generic_name'},
					{data: 'action', name: 'action', orderable: false, searchable: false}
				]
			});
		});
	</script>
@stop







