@extends('layouts.master')
@section('content')
	<div class="">
		<h1>Medicine Groups</h1>

		<h1><a href="{{ route('medicinegroups.create') }}">Add Medicine Group</a></h1>

		<table class="table table-bordered data-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Medicine Group Name</th>
					<th width="100px">Action</th>
					<th width="100px"></th>
				</tr>
			</thead>
		</table>
	</div>
        
	<script type="text/javascript">
		$(function () {
			var table = $('.data-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('medicinegroups.index') }}",
				columns: [
					{data: 'id', name: 'id'},
					{data: 'group_name', name: 'group_name'},
					{data: 'edit', name: 'edit', orderable: false, searchable: false},
					{data: 'delete', name: 'delete', orderable: false, searchable: false},
				]
			});
		});
	</script>
@stop







