@extends('layouts.master')
@section('content')
	<div class="">
		<h1>Customer Type</h1>

		<h1><a href="{{ route('customertypes.create') }}">Add Customer Type</a></h1>

		<table class="table table-bordered data-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Customer Type Name</th>
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
				ajax: "{{ route('customertypes.index') }}",
				columns: [
					{data: 'id', name: 'id'},
					{data: 'customer_type_name', name: 'customer_type_name'},
					{data: 'action', name: 'action', orderable: false, searchable: false}
				]
			});
		});
	</script>
@stop







