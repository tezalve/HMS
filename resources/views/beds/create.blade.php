@extends('layouts.master')

@section('content')

	<legend style="background: coral; text-align: center;">Bed Information</legend>
	<form action="{{ route('beds.store') }}" method='POST'>
		@csrf
		
		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Investigation Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Bed Number</label>
				<input name="bedno" type="text" id="bedno" placeholder="Bed Number" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Investigation Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Description</label>
				<input name="description" type="text" id="description" placeholder="Bed Description" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="floorno" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Floor Number</label>
		        <select id="floorno" name="floorno" placeholder="" class="col-lg-6 entry_panel_dropdown">
		        	<option value="">Select Value</option>
					@foreach ($floor as $floor)
					<option value="{{$floor->id}}">{{$floor->description}}</option>
	    			@endforeach
				</select>
		        <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#addfloor">... </button></td>					
			</div>
		</div>	


		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="bedcategory" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Bed Category</label>
		        <select id="bedcategory" name="bedcategory" placeholder="" class="col-lg-6 entry_panel_dropdown">
		        	<option value="">Select Value</option>
					    @foreach ($bedgroup as $group)
					     <option value="{{$group->id}}">{{$group->description}}</option>
	    			  @endforeach
				</select>
		        <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#addcategory">... </button></td>					
			</div>
		</div>	


		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Investigation Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Charge Par Day</label>
				<input name="unitprice" type="text" id="unitprice" placeholder="Charge Par Day.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="col-lg-12 entry_panel_body">
				<input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
			</div>
		</div>
	</form>
@stop