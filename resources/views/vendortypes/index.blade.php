@extends('layouts.master')
@section('content')
	<div class="">
		<h1>Vendor Types</h1>

		<h1><a href="{{ route('vendortypes.create') }}">Add Vendor Type</a></h1>

		<table class="table table-bordered data-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Vendor Type Name</th>
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
				ajax: "{{ route('vendortypes.index') }}",
				columns: [
					{data: 'id', name: 'id'},
					{data: 'vendor_type_name', name: 'vendor_type_name'},
					{data: 'action', name: 'action', orderable: false, searchable: false}
				]
			});
		});
	</script>
@stop







