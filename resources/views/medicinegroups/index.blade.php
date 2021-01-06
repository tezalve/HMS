@extends('layouts.master')
@section('content')
	<div class="">
		<legend>Medicine Groups</legend>

		<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <a href="{{ route('medicinegroups.create') }}"><input type="button" id="submit" name="submit" value="+Add New Medicine Group" class="col-lg-7 col-md-7 col-xs-7 btn btn-save btn-sm button button-save pull-left" style="background: rgb(5, 142, 27); color: aliceblue;">	</a>
            </div>
        </div>

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







