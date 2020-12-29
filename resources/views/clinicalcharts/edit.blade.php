<!-- editclinicalchart -->
@extends('layouts.master')
@section ('includes')
<script>

</script>
@stop
@section('content')
<legend style="background: coral;">Edit Clinical Chart Entry</legend>

<form action="{{ route('clinicalcharts.update', $clinicalchartdata->id) }}" method="POST", id="">
@csrf
@method('PUT')

	<div class="col-lg-6 col-md-6 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
            <label for="Investigation Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Investigation Name</label>
			<input name="investigationname" type="text" id="investigationname" value="{{ old('name',$clinicalchartdata->name??null) }}" placeholder="Investigation Name.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" >				
		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
            <label for="department" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Department</label>
	        <select id="department" name="department" placeholder="" class="col-lg-7 entry_panel_dropdown">
	        	<option value="">Select Value</option>
				@foreach ($department as $values)
					@if ($values->id==$clinicalchartdata->department_id) {
						<option value={{$values->id}} selected>{{$values->description}}</option>
					}
					@else				
					<option value={{$values->id}}>{{$values->description}}</option>
					@endif
    			@endforeach	        	
			</select>
	        <!-- <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#addfloor">... </button></td>					 -->
		</div>
	</div>	

	<div class="col-lg-6 col-md-6 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
            <label for="subdepartment" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Sub Department</label>
	        <select id="subdepartment" name="subdepartment" placeholder="" class="col-lg-7 entry_panel_dropdown">
	        	<option value="">Select Value</option>
				@foreach ($subdepartment as $key)
					@if ($key->id == $clinicalchartdata->sub_department) {
						<option value={{$key->id}} selected>{{$key->description}}</option>
					}
					@else
					<option value={{$key->id}}>{{$key->description}}</option>
					@endif
    			@endforeach	        	
			</select>
		</div>
	</div>	

	<div class="col-lg-6 col-md-6 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
            <label for="chargeparunit" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Charge Par Unit</label>
			<input name="chargeparunit" type="text" id="chargeparunit" value="{{ old('price',$clinicalchartdata->price??null) }}" placeholder="Charge Par Unit.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
            <label for="unit" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Unit</label>
	        <select id="unit" name="unit" placeholder="" class="col-lg-7 entry_panel_dropdown">
	        	<option value="">Select Value</option>
				@foreach ($unitinfo as $keys)
					@if ($keys->id == $clinicalchartdata->unit_info_id) {
						<option value={{$keys->id}} selected>{{$keys->description}}</option>
					}
					@else
					<option value={{$keys->id}}>{{$keys->description}}</option>
					@endif				
    			@endforeach	        		        	
			</select>
	        <!-- <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#addfloor">... </button></td>					 -->
		</div>
	</div>	


	<div class="col-lg-6 col-md-6 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
            <label for="editstatus" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Edit Status</label>
	        <select id="editstatus" name="editstatus" placeholder="" class="col-lg-7 entry_panel_dropdown">
				@if ($clinicalchartdata->edit_status == '1') {
					<option value="1" selected>True</option>
					<option value="2">False</option>
				} @else {
					<option value="1">True</option>
					<option value="2" selected>False</option>
				}
				@endif	        	
			</select>
		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
            <label for="doctorestatus" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Doctore Status</label>
	        <select id="doctorestatus" name="doctorestatus" placeholder="" class="col-lg-7 entry_panel_dropdown">
				@if ($clinicalchartdata->doctor_status == '1') {
					<option value="1" selected>True</option>
					<option value="2">False</option>
				} @else {
					<option value="1">True</option>
					<option value="2" selected>False</option>
				}
				@endif	 	        	
			</select>
		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-6">
		<div class="col-lg-12 entry_panel_body">
			<input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
		</div>
	</div>
</form>

@stop


@section('scripts')
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
		$("#createnewclinicalchart").validate({
	  		rules: {
				investigationname: "required",
				investigationname: {
					required: true,
				},
				chargeparunit: {
					required: true,
            		number: true
				},
				department: {
					required: true
				},
				subdepartment: {
					required: true
				},
				unit: {
					required: true
				},
			},
			tooltip_options: {
           		investigationname: {trigger:'focus'},
        	},
			messages: {
				investigationname: "Please enter Investigation name",
				department: {
					required: "Please select Department",
				},
				subdepartment: {
					required: "Please select Sub Department",
				},
				unit: {
					required: "Please select Unit",
				},				
			}
			
		});
});
</script>

@stop