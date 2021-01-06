@extends('layouts.master')
@section('content')
	<div class="">
        <h1>Patient Information</h1>
        
        
        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <a href="{{ route('patients.create') }}"><input type="button" id="submit" name="submit" value="+New Patient Registration" class="col-lg-7 col-md-7 col-xs-7 btn btn-save btn-sm button button-save pull-left" style="background: rgb(5, 142, 27); color: aliceblue;">	</a>
            </div>
        </div>

		<table class="table table-bordered data-table">
			<thead>
				<tr>
                    <th>Registration No.</th>
                    <th>Patient Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Blood Group</th>
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
				ajax: "{{ route('patients.index') }}",
				columns: [
					{data: 'registration_no', name: 'registration_no'},
					{data: 'name', name: 'name'},
					{data: 'phone', name: 'phone'},
					{data: 'address', name: 'address'},
					{data: 'blood_group', name: 'blood_group'},
					{data: 'edit', name: 'edit', orderable: false, searchable: false},
					{data: 'delete', name: 'delete', orderable: false, searchable: false}
				]
			});
		});
	</script>
@stop