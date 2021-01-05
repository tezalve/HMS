@extends('layouts.master')
@section('content')
	<div class="">
		<h1>User</h1>

		<h1><a href="{{ route('users.create') }}">Add User</a></h1>

		<table class="table table-bordered data-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Created At</th>
					<th>Updated At</th> 
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
				ajax: "{{ route('users.index') }}",
				columns: [
					{data: 'id', name: 'id'},
					{data: 'name', name: 'name'},
					{data: 'email', name: 'email'},
					{data: 'created_at', name: 'created_at'},
					{data: 'updated_at', name: 'updated_at'},
					{data: 'action', name: 'action', orderable: false, searchable: false}
				]
			});
		});
	</script>
@stop






