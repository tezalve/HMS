@extends('layouts.master')
@section ('includes')



@stop
@section('content')

<legend style="background: coral;">Barcode Print</legend>

	<div class="col-lg-6 col-md-6 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
			<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Invoice No</label>
			<input type="text" id="invoice_no" name="invoice_no" placeholder="invoice no.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input">
		</div>
	</div>  

	<div class="col-lg-6 col-md-6 col-sm-12">
		<div class="col-lg-12 entry_panel_body">
			<input type="button" id="addRow" name="addRow" value="ADD" class="col-lg-3 col-md-3 col-sm-3 col-xs-1 btn btn-sm button btn-primary button-save pull-left">
		</div>
	</div>



@stop

@section('scripts')

@stop