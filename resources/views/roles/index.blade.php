@extends('layouts.master')
@section('content')
	<div class="">
		<legend>Roles</legend>

		<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <a href="{{ route('roles.create') }}"><input type="button" id="submit" name="submit" value="+Add New Role" class="col-lg-7 col-md-7 col-xs-7 btn btn-save btn-sm button button-save pull-left" style="background: rgb(5, 142, 27); color: aliceblue;">	</a>
            </div>
        </div>
    	<!-- emo -->

		<table class="table table-bordered data-table">
			<thead>
				<tr>
					<th>Role Name</th>
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
				ordering: false,
				ajax: "{{ route('roles.index') }}",
				columns: [
					{data: 'name', name: 'name'},
					{data: 'edit', name: 'edit', orderable: false, searchable: false},
					{data: 'delete', name: 'delete', orderable: false, searchable: false},
				]
			});
		});
	</script>
@stop






