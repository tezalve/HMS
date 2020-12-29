@extends('layouts.master')
@section ('includes')

	<link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.css">
	<!-- <link rel="stylesheet" type="text/css" href="../resources/syntax/shCore.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="/css/demo.css"> -->
	<link href="/css/jquery-ui.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/screen.css">
	<script type="text/javascript" language="javascript" src="/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="/js/jquery.validation.tooltip.js"></script>
	<script type="text/javascript" language="javascript" src="/js/jquery.validate.min.js"></script>
	
	<!-- Validation end -->

	<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
	var table = $('#example').dataTable({
        "ordering":   false,
        "info":       false,
	
	});

	$('#name').keyup(function(){
      table.fnFilter( $(this).val() );
	})
	});
	</script>
	
@stop
@section('content')

	<legend>List Of Due Invoice</legend>
	<form action="{{ route('duecollections.store') }}" method="POST" id="createpatient">
	@csrf
		<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Invoice No</th>
				<th>Invoice Date</th>
				<th>Patient Name</th>
				<th>Due Amount</th>
				<th>Collection</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($my_sql as $my_sql)
				<tr>
					<td>{{$my_sql->invoice_no}}</td>
					<td>{{$my_sql->date}}</td>
					<td>{{$my_sql->patirnt_name}}</td>
					<td>{{$my_sql->DueAmount}}</td>
					<td><a href="/duecollection/{{$my_sql->invoice_master_id}}/edit/">Collection</a></td>
				</tr>
			@endforeach
		</tbody>
		</table>
	</form>
@stop

@section('scripts')
	<script src="/js/jquery-ui.js"></script>
	<script>
	$( "#tabs" ).tabs();
	// Hover states on the static widgets
	$( "#dialog-link, #icons li" ).hover(
		function() {
			$( this ).addClass( "ui-state-hover" );
		},
		function() {
			$( this ).removeClass( "ui-state-hover" );
		}
	);
	$(function () {
		// validate signup form on keyup and submit
			$("#createpatient").validate({
				rules: {
					investigationname: "required",
					investigationname: {
						required: true,
					},
					price: {
						required: true
					},
					refferal_fee: {
						required: true
					},
				},
				tooltip_options: {
					investigationname: {trigger:'focus'},
				},
				messages: {
					investigationname: "Please enter Investigation name",
					price: {
						required: "Please enter a price",
					},
					refferal_fee: {
						required: "Please enter refferal fee",
					},
				}
				
			});
	});
	</script>
	<script type="text/javascript"></script>	
@stop


