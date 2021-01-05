@extends('layouts.master')
@section('content')
	<div class="">
		<h1>Companies</h1>

		<h1><a href="{{ route('medicinecompanyinfos.create') }}">Add Company</a></h1>

		<table class="table table-bordered data-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Company Name</th>
					<th>Address</th>
					<th>Contact Number</th>
					<th>Contact Person</th>
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
				ajax: "{{ route('medicinecompanyinfos.index') }}",
				columns: [
					{data: 'id', name: 'id'},
					{data: 'company_name', name: 'company_name'},
					{data: 'address', name: 'address'},
					{data: 'contact_number', name: 'contact_number'},
					{data: 'contact_person', name: 'contact_person'},
					{data: 'users_id', name: 'users_id'},
					{data: 'action', name: 'action', orderable: false, searchable: false}
				]
			});
		});
	</script>
@stop



