@extends('layouts.master')
@section('content')
	<div class="">
		<h1>Vendors</h1>

		<h1><a href="{{ route('vendors.create') }}">Add Vendor</a></h1>

		<table class="table table-bordered data-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Vendor Name</th>
					<th>Contact Number</th>
					<th>Email</th>
					<th>Address</th>
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
				ajax: "{{ route('vendors.index') }}",
				columns: [
					{data: 'id', name: 'id'},
					{data: 'vendor_name', name: 'vendor_name'},
					{data: 'contact_number', name: 'contact_number'},
					{data: 'email', name: 'email'},
					{data: 'address', name: 'address'},
					{data: 'users_id', name: 'users_id'},
					{data: 'action', name: 'action', orderable: false, searchable: false}
				]
			});
		});
	</script>
@stop




