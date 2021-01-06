@extends('layouts.master')
@section('content')
	<div class="">
        <h1>Doctor Information</h1>
        
        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <a href="{{ route('doctors.create') }}"><input type="button" id="submit" name="submit" value="+New Doctor Registration" class="col-lg-7 col-md-7 col-xs-7 btn btn-save btn-sm button button-save pull-left" style="background: rgb(5, 142, 27); color: aliceblue;">	</a>
            </div>
        </div>

		<table class="table table-bordered data-table">
			<thead>
				<tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>email</th>
                    <th>gender</th>
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
				ajax: "{{ route('doctors.index') }}",
				columns: [
					{data: 'id', name: 'id'},
					{data: 'name', name: 'name'},
					{data: 'address', name: 'address'},
                    {data: 'email', name: 'email'},
					{data: 'gender', name: 'gender'},
					{data: 'edit', name: 'edit', orderable: false, searchable: false},
					{data: 'delete', name: 'delete', orderable: false, searchable: false}
				]
			});
		});
	</script>
@stop