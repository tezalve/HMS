<!-- generate_lab_report -->
@extends('layouts.master')
@section ('includes')
<style>
table thead{
  background-color: #DBDCDD;
  color:#000000;
}
table.dataTable tbody td {
    padding: 2px 1px;
}

.btn-sm, .btn-group-sm>.btn {
    padding: 1px 1px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 0px;
    width: 49%;
}
input {
    border: 1px solid #EAE8E8;
}
</style>



<script>
$(document).ready(function() {

      invoicetable = $('#invoicetable').DataTable( {  
        "ordering":   false,
        "info":       false,
        "searching":  false,
        "paging":     false,
        "scrollY":    "400px",
    });
});
</script>

@stop
@section('content')

	<legend style="margin-bottom: 10px;">Generate Lab Report</legend>

	<div class="col-lg-6 col-md-6 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
			<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Invoice No</label>
			<input type="text" id="invoice_no" name="invoice_no" placeholder="invoice no.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" readonly value="{{$reportdata[0]->invoice_no}}">
		</div>
	</div>  

	<div class="col-lg-6 col-md-6 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
			<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Patient Name</label>
			<input type="text" id="invoice_no" name="invoice_no" placeholder="Patient Name.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" readonly value="{{$reportdata[0]->patient_name}}">
		</div>
	</div>


	<div class="col-lg-6 col-md-6 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
			<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Referred Doctor</label>
			<input type="text" id="invoice_no" name="invoice_no" placeholder="Referred Doctor.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" readonly value="{{$reportdata[0]->doctor_name}}">
		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
			<label for="invoice num" class="col-lg-3 col-md-3 col-xs-3 entry_panel_label">Age</label>
			<input type="text" id="invoice_no" name="invoice_no" placeholder="Age.." class="col-lg-3 col-md-3 col-xs-3 entry_panel_input" readonly value="">
			<label for="invoice num" class="col-lg-3 col-md-3 col-xs-3 entry_panel_label">Gender</label>
			<input type="text" id="invoice_no" name="invoice_no" placeholder="Gender.." class="col-lg-3 col-md-3 col-xs-3 entry_panel_input" readonly value="{{$reportdata[0]->gender }}">			
		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
			<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Investigation Name</label>
			<input type="text" id="invoice_no" name="invoice_no" placeholder="Referred Doctor.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" readonly value="{{$reportdata[0]->investigation_name}}">
		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
			<input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-6 col-md-6 col-xs-6 btn btn-save btn-sm button button-save pull-left" style="background: rgb(5, 142, 27); color: aliceblue;" >
			<!-- <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-6 col-md-6 col-xs-6 btn btn-save btn-sm button button-save pull-right" style="background: rgb(5, 142, 27); color: aliceblue;" > -->
		</div>
	</div> 

	<div class="col-lg-12 datatablescope ">
      <table id="invoicetable" class="stripe row-border order-column" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th style="width:5%;">Sl No.</th>
                  <th style="width:30%;">Test Name</th> <!-- Alias name -->
                  <th style="width:20%;">Result</th>
                  <th style="width:20%;">Unit</th>
                  <th style="width:25%;">Normal Range</th>
              </tr>
          </thead>                 
          <tbody>
          	@foreach ($reportdata as $keys)
				<tr>
					<td>{{$keys->sl_no}}</td>
					<!-- <td>{{$keys->alias_name}}</td> -->
					<td><input type="text" id="Result"     name="Result"     style="width: 100%;" value="{{$keys->alias_name}}" /></td>
					<!-- <td></td> -->
					<td><input type="text" id="Result"     name="Result"     style="width: 100%;" value="" /></td>
					<!-- <td>{{$keys->unit}}</td> -->
					<td><input type="text" id="Result"     name="Result"     style="width: 100%;" value="{{$keys->unit}}" /></td>
					<!-- <td>{{$keys->normal_value}}</td> -->
					<td><input type="text" id="Result"     name="Result"     style="width: 100%;" value="{{$keys->normal_value}}" /></td>
				</tr>          		
          	@endforeach
          </tbody>
      </table>	
    </div>  
@stop
