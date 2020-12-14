@extends('layouts.mister')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> 
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->

    <form action="{{ route('doctors.store') }}" method="POST" >
        @csrf

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Doctor Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Doctor Name</label>
				<input name="name" type="text" id="name" placeholder="Doctor Name" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Doctor Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Doctor Degree</label>
				<input name="doctor_degree" type="text" id="doctordegree" placeholder="Doctor Degree.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
			</div>
		</div>	

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Address" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Address</label>
				<input name="address" type="text" id="address" placeholder="Address" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
			</div>
		</div>	


		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Gender" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Gender</label>
				<select id="gender" name="gender" placeholder="" class="col-lg-7 entry_panel_dropdown">
					<option value="m">Male</option>
					<option value="f">Female</option>
				</select>
			</div>
		</div>	


		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Phone No" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Phone No</label>
				<input name="phone" type="text" id="phone" placeholder="Phone No" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
			</div>
		</div>			

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Email" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Email</label>
				<input name="email" type="text" id="email" placeholder="email@domain.com" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
			</div>
		</div>			


		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Doctor Status" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Doctor Status</label>
				<select id="doctor_status" name="doctor_status" placeholder="" class="col-lg-7 entry_panel_dropdown">
					<option value="0">Indoor</option>
					<option value="1">Outdoor</option>
				</select>
			</div>
		</div>	

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Reference Status" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Reference Status</label>
				<select id="referencestatus" name="reference_status" placeholder="" class="col-lg-7 entry_panel_dropdown">
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select>
			</div>
		</div>	
		

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Married Status" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Married Status</label>
				<select id="married" name="married" placeholder="" class="col-lg-7 entry_panel_dropdown">
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select>
			</div>
		</div>	


		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Blood Group" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Blood Group</label>
				<select id="bloodgroup" name="bloodgroup" placeholder="" class="col-lg-7 entry_panel_dropdown">
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
	            <label for="DOB" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">DOB</label>
				<input name="dob" type="text" id="dob" placeholder="dd-mm-yyyy" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
			</div>
		</div>	


		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Consultation Fee" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Consultation Fee</label>
				<input name="consultation_fee" type="text" id="consultation_fee" placeholder="1000" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
			</div>
		</div>	

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Department" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Department</label>
				<select id="department" name="department_id" placeholder="" class="col-lg-7 entry_panel_dropdown" required>
				<option value="">Select Value</option>	
				@foreach ($department as $department)
					<option value= "{{ $department->id }}" > {{$department->departmentname}} </option>
	        	@endforeach
				</select>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body">
				<input type="submit" id="submit" name="submit" value="Submit" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
			</div>
		</div>
    </form>
@stop