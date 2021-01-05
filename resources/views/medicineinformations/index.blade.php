@extends('layouts.master')
@section('content')
	<div class="">
		<h1>Medicines</h1>
		<h1><a href="{{ route('medicineinformations.create') }}">Add Medicine</a></h1>
		<table class="table table-bordered data-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Medicine Name</th>
					<th>Price</th>
					<th>TP</th>
					<th>Default Discount</th>
					<th>Default Vat</th>
					<th>Users ID</th>
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
				ajax: "{{ route('medicineinformations.index') }}",
				columns: [
					{data: 'id', name: 'id'},
					{data: 'medicine_name', name: 'medicine_name'},
					{data: 'mrp', name: 'mrp'},
					{data: 'tp', name: 'tp'},
					{data: 'default_discount', name: 'default_discount'},
					{data: 'default_vat', name: 'default_vat'},
					{data: 'users_id', name: 'users_id'},
					{data: 'action', name: 'action', orderable: false, searchable: false}
				]
			});
		});
	</script>
@stop




