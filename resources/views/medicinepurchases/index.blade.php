@extends('layouts.master')
@section('content')
	<div class="">
		<legend>Completed Purchases</legend>
		<!-- <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <a href="{{ route('medicinepurchases.create') }}"><input type="button" id="submit" name="submit" value="+Purchase" class="col-lg-7 col-md-7 col-xs-7 btn btn-save btn-sm button button-save pull-left" style="background: rgb(5, 142, 27); color: aliceblue;">	</a>
            </div>
        </div> -->
		<table class="table table-bordered data-table">
			<thead>
				<tr>
					<th>PO Number</th>
					<th>Delivery Number</th>
					<th>Delivery Date</th>
					<th>Note</th>
					<th>Transaction Type</th>
					<th>Medicine Company</th>
					<th>Total</th>
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
				ajax: "{{ route('medicinepurchases.index') }}",
				columns: [
					{data: 'po_number', name: 'po_number'},
					{data: 'delivery_number', name: 'delivery_number'},
					{data: 'delivery_date', name: 'delivery_date'},
					{data: 'note', name: 'note'},
					{data: 'transaction_type', name: 'transaction_type'},
					{data: 'company_name', name: 'company_name'},
					{data: 'total', name: 'total'},
				]
			});
		});
	</script>
@stop




