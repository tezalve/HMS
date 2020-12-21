@extends('layouts.master')
@section('content')

	@if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li></li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('patients.update',$patient->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="invoice num" class="col-lg-2 col-md-2 col-xs-2 entry_panel_label">Patient's Name</label>
                <input type="text" id="fast_name"      name="fast_name"      placeholder="Fast name.."      class="col-lg-2 col-md-2 col-xs-2 entry_panel_input" value="">
                <input type="text" id="middle_name"    name="middle_name"    placeholder="Middle name.."    class="col-lg-4 col-md-4 col-xs-4 entry_panel_input" value="">
                <input type="text" id="last_name"      name="last_name"      placeholder="Last name.."      class="col-lg-4 col-md-4 col-xs-4 entry_panel_input" value="">
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
          <div class="col-lg-12 entry_panel_body ">
            <label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Address</label>
            <input type="text" id="address" name="address" placeholder="Address.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="">
            {{ $errors->first('address') }}
          </div>
        </div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Phone No</label>
				<input type="text" id="phone" name="phone" placeholder="Phone No.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="">
        {{ $errors->first('phone') }}
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Gender</label>
			      <select id="gender" name="gender" placeholder="" class="col-lg-8 col-md-8 col-xs-8 entry_panel_dropdown" >
					<option value="m">Male</option>
					<option value="f">Female</option>
		          </select>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Age</label>
				<input type="text" id="years" 	  name="years" 	   placeholder="YY.." class="col-lg-4 col-md-4 col-xs-4 entry_panel_input" value="">
                <input type="text" id="months"    name="months"    placeholder="MM.." class="col-lg-2 col-md-2 col-xs-2 entry_panel_input" value="">
                <input type="text" id="days"      name="days"      placeholder="DD.." class="col-lg-2 col-md-2 col-xs-2 entry_panel_input" value="">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">DOB</label>
				<input type="text" id="dob" name="dob" placeholder="dd-mm-yyyy" class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Religion</label>
			      <select id="religion" name="religion" placeholder="" class="col-lg-8 col-md-8 col-xs-8 entry_panel_dropdown" >
					<option value="islam">Islam</option>
					<option value="hindu">Hindu</option>
					<option value="christian">Christian</option>
					<option value="buddhist">Buddhist</option>
					<option value="other">Other</option>
		          </select>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Mother's Name</label>
				<input type="text" id="mothersname" name="mothersname" placeholder="Mother's Name.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="">
			</div>
		</div>


		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Father's Name</label>
				<input type="text" id="fathersname" name="fathersname" placeholder="Father's Name.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Blood Group</label>
			      <select id="bloodgroup" name="bloodgroup" placeholder="" class="col-lg-8 col-md-8 col-xs-8 entry_panel_dropdown" >
					<option value="A+">A+</option>
					<option value="B+">B+</option>
					<option value="C+">AB+</option>
					<option value="B+">O+</option>
					<option value="B+">A-</option>
					<option value="B+">B-</option>
					<option value="B+">O-</option>
					<option value="B+">AB-</option>
		          </select>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Spouse's Name</label>
				<input type="text" id="spousesname" name="spousesname" placeholder="Spouse's Name.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">National id</label>
				<input type="text" id="nid" name="nid" placeholder="National id.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Nationality</label>
			    <select id="nationality" name="nationality" placeholder="" class="col-lg-8 col-md-8 col-xs-8 entry_panel_dropdown" >
					<option value="bangladeshi">Bangladeshi</option>
					<option value="bangladeshi">Others</option>
				</select>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Occupations</label>
			    <select id="occupations" name="occupations" placeholder="" class="col-lg-7 col-md-7 col-xs-7 entry_panel_dropdown" >
					<option value="">Select Value</option>
					@foreach ($occupation as $keys)
					    <option value="{{$keys->id}}">{{$keys->description}}</option>
	    			@endforeach					
				</select>
				<td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#occupationsmodel">... </button></td>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Passport no.</label>
				<input type="text" id="passno" name="passno" placeholder="Passport no.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body">
				<input type="submit" id="submit" name="submit" value="Submit" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
			</div>
		</div>
	</form>

@stop