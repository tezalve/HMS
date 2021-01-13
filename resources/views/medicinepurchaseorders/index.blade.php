@extends('layouts.master')
@section('content')
	<div class="">
		<legend>Medicines</legend>
		<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <a href="{{ route('medicinepurchaseorders.create') }}"><input type="button" id="submit" name="submit" value="+Add New Purchase Order" class="col-lg-7 col-md-7 col-xs-7 btn btn-save btn-sm button button-save pull-left" style="background: rgb(5, 142, 27); color: aliceblue;">	</a>
            </div>
        </div>
		<table class="table table-bordered data-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>PO Number</th>
					<th>PO Date</th>
					<th>Delivery Date</th>
					<th>Note</th>
					<th>User</th>
					<th>Valid</th>
					<th>Medicine Company</th>
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
				ajax: "{{ route('medicinepurchaseorders.index') }}",
				columns: [
					{data: 'id', name: 'id'},
					{data: 'po_number', name: 'po_number'},
					{data: 'po_date', name: 'po_date'},
					{data: 'delivery_date', name: 'delivery_date'},
					{data: 'note', name: 'note'},
					{data: 'user_name', name: 'user_name'},
					{data: 'valid', name: 'valid'},
					{data: 'company_name', name: 'company_name'}
				]
			});
		});
	</script>
@stop




