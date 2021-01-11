@extends('layouts.master')
@section('content')
	<div class="">
        <legend>Bed Information</legend>
        
        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <a href="{{ route('beds.create') }}"><input type="button" id="submit" name="submit" value="+Add New Bed" class="col-lg-7 col-md-7 col-xs-7 btn btn-save btn-sm button button-save pull-left" style="background: rgb(5, 142, 27); color: aliceblue;">	</a>
            </div>
        </div>

		<table class="table table-bordered data-table">
			<thead>
				<tr>
                    <th>ID</th>
                    <th>Bed No</th>
                    <th>Description</th>
                    <th>Room Type</th>
                    <th>Charge</th>
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
				ajax: "{{ route('beds.index') }}",
				columns: [
					{data: 'id', name: 'id'},
					{data: 'bed_no', name: 'bed_no'},
					{data: 'description', name: 'description'},
                    {data: 'bed_group_id', name: 'bed_group_id'},
                    {data: 'charge', name: 'charge'},
					{data: 'edit', name: 'edit', orderable: false, searchable: false},
					{data: 'delete', name: 'delete', orderable: false, searchable: false},
				]
			});
		});
	</script>
@stop