<!-- investigationlist -->
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
  color:#FFFFFF;
}
input {
	/*border: none;*/
}
</style>		

	<!-- Validation end -->

	<script type="text/javascript" language="javascript" class="init">
		$(document).ready(function() {
		var table = $('#example').dataTable({
				scrollCollapse: false,
				searching:      true,
		        "ordering":   	false,
		        "info":       	false,
		        "searching":  	true,
		        // "paging":     false,
		        // "scrollY":    "300px"			
		});
			
			$('#name').keyup(function(){
				table.fnFilter( $(this).val() );
			})
		});
	</script>
@stop
@section('content')
	<!-- <legend>Investigation Registration</legend> -->
	<legend style="background: coral;">Investigation Registration</legend>


	
	<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 2px;">
		<div class="col-lg-12 entry_panel_body">
			<a href="{{ route('investigations.create') }}"><input type="button" id="submit" name="submit" value="+ Create New Investigation" class="col-lg-2 col-md-2 col-xs-2 btn btn-save btn-sm button button-save " style="color: white;"></a>
		</div>
	</div>


	<legend></legend>

	<div class="col-lg-12 datatablescope ">
		<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Investigation name</th>
				<th>Price</th>
				<th>Refferal Fee</th>
				<th>Refferal_type</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($investigation as $investigation)
				<tr>
				<td>{{$investigation->name}}</td>
				<td>{{$investigation->price}}</td>
				<td>{{$investigation->refferal_fee}}</td>
				<td>@if ($investigation->refferal_type = 1) % @else Tk @endif</td>
				<td>
					<form action="{{ route('investigations.destroy', $investigation->id) }}", method="post">
						<a class="btn btn-primary" href="{{ route('investigations.edit', $investigation->id) }}">Edit</a>
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