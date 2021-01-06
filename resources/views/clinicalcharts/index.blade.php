@extends('layouts.master')
@section ('includes')

<style type="text/css">
.entry_panel_body{
  padding:0px !important;
  padding-top:3px !important;
  padding-bottom:3px !important;
}
.entry_panel_label{
  background-color: #DBDCDD;
  padding: 2px;
  padding-left:10px;
  padding-right:3px;
  color:#000000;
  font-weight:  100;
  border: none;
  margin-bottom:3px;
}

.entry_panel_input{
  border: #DBDCDD 1px solid;
  padding-top:1px;
  padding-bottom:1px;
}
.entry_panel_dropdown{
  border: #DBDCDD 1px solid;
  /*border: none;*/
  padding-top:2px;
  padding-bottom:2px;
  background-color:#ffffff;
}
.entry_panel_dropdown{
  border: #DBDCDD 1px solid;
  padding-top:2px;
  padding-bottom:2px;
  background-color:#ffffff;
}
.datatablescope{
  margin-top: 2%;
}

table thead{
  background-color: #525A6E;
  color: black !important;
}
input {
	/*border: none;*/
}
</style>		


	<script type="text/javascript" language="javascript" class="init">
		$(document).ready(function() {
		var table = $('#example').dataTable({
			scrollCollapse: false,
			searching:      true,
			"ordering":   	false,
		});
			
			$('#name').keyup(function(){
				table.fnFilter( $(this).val() );
			})
		});
	</script>

@stop
@section('content')
	<legend style="background: coral;">Clinical Chart List</legend>

	<div class="col-lg-6 col-md-6 col-sm-6" style="margin-bottom: 2px;">
		<div class="col-lg-12 entry_panel_body">
			<a href="{{ route('clinicalcharts.create') }}">
			<input type="button" id="button" name="button" value="+ Create Clinical Chart" class="col-lg-4 col-md-4 col-xs-4 btn btn-save btn-sm button button-save pull-left" style="color: white;">
			</a>		
		</div>
	</div>


	<legend></legend>

	<div class="col-lg-12 datatablescope ">
		<table id="example" class="display" cellspacing="0" width="100%">
		<thead style="background-color: cadetblue; color: white;">
			<tr>
				<th>Description</th>
				<th>Department</th>
				<th>Sub Department</th>
				<th>Unit</th>
				<th>Charge</th>
				<th>Edit</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($clinicalchartdata as $key)
				<tr>
					<td>{{$key->description}}</td>
					<td>{{$key->department}}</td>
					<td>{{$key->sub_department}}</td>
					<td>{{$key->unit}}</td>
					<td>{{$key->charge}}</td>
					<td>
						<form action="{{ route('clinicalcharts.destroy', $key->id) }}", method="POST">					
							<a class="btn btn-primary" href="{{ route('clinicalcharts.edit', $key->id) }}">Edit</a>
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-primary" title="delete">Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
		</table>
	</div>
@stop

