        @csrf
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
            <input type="text" id="address" name="address" placeholder="Address.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="{{ old('address',$patient->address??null) }}">
            {{ $errors->first('address') }}
          </div>
        </div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Phone No</label>
				<input type="text" id="phone" name="phone" placeholder="Phone No.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="{{ old('phone',$patient->phone??null) }}">
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

		<div class="col-lg-6 col-md-6 col-xs-12 hidden">
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
				<input type="text" id="dob" name="dob" placeholder="yyyy-mm-dd" class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="{{ old('dob',$patient->dob??null) }}">
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
				<input type="text" id="mothersname" name="mothersname" placeholder="Mother's Name.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="{{ old('mothersname',$patient->mothersname??null) }}">
			</div>
		</div>


		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Father's Name</label>
				<input type="text" id="fathersname" name="fathersname" placeholder="Father's Name.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="{{ old('mothersname',$patient->fathersname??null) }}">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Blood Group</label>
			      <select id="bloodgroup" name="bloodgroup" placeholder="" class="col-lg-8 col-md-8 col-xs-8 entry_panel_dropdown" >
					<option value="A+">A+</option>
					<option value="B+">B+</option>
					<option value="AB+">AB+</option>
					<option value="O+">O+</option>
					<option value="A-">A-</option>
					<option value="B-">B-</option>
					<option value="O-">O-</option>
					<option value="AB-">AB-</option>
		          </select>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Spouse's Name</label>
				<input type="text" id="spousesname" name="spousesname" placeholder="Spouse's Name.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="{{ old('spousesname',$patient->spousename??null) }}">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">National id</label>
				<input type="text" id="nid" name="nid" placeholder="National id.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="{{ old('nationalid',$patient->nationalid??null) }}">
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
				<input type="text" id="passno" name="passno" placeholder="Passport no.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="{{ old('passportid',$patient->passportid??null) }}">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body">
				<input type="submit" id="submit" name="submit" value="Submit" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
			</div>
		</div>
	</form>

	<div class="modal fade" id="occupationsmodel" tabindex="-1" role="dialog" aria-labelledby="catAddLabel" aria-hidden="true">
		<div class="modal-dialog" style="width: 500px;">
			<div class="modal-content">
				<form action="{{ route('occupations.store') }}" method="POST" id="OccupationsForm">
					<div class="modal-header" style="background: coral; padding: 10px;">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="catAddLabel">Add New Occupations</h4>
					</div>
					<div class="modal-body">
						<table style="width: 450px;">
							<tr>
								<td>
									<input name="occupationsdescription" type="text" id="occupationsdescription" placeholder="Occupations Description" class="col-lg-12 col-md-12 col-xs-12" style="height: 30px;">
								</td>
							</tr>      		
						</table>
					</div>
					<div class="col-lg-6 col-md-6 col-xs-12">
						<div class="col-lg-12 entry_panel_body">
							<input type="submit" id="submit" name="submit" value="Submit" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
						</div>
					</div>  
				</form>
			</div>
		</div>
	</div>

@section('scripts')

	<script type="text/javascript">
		$( "#OccupationsForm" ).submit(function( event ) {
		// Stop form from submitting normally
			event.preventDefault();
			// Get some values from elements on the page:
			var $form   = $( this ),
			departments = $form.find( "input[name='occupationsdescription']" ).val(),
			url         = $form.attr( "action" ); 
			var posting = $.post( url, {new_occupationsdescription: departments} );

			// Put the results in a div
			posting.done(function( data ) {
				$('#OccupationsForm').trigger("reset");
				$('#occupationsmodel').modal('hide');

				//Reload the options of dropdown list using ajax.

				$.ajax({
					// type: "POST",
					url: "{{URL::to('/')}}/occupations/create",
					dataType: "json",
					success: function(data){
						$('#occupations').empty();
						var opts = data;
						// Use jQuery's each to iterate over the opts value
						$('#occupations').append('<option value="">Select</option>');
						$.each(opts, function(i, d) {
						// You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
						$('#occupations').append('<option value="' + d.id + '">' + d.description + '</option>');
						});
					}
				})

			});
		});

	</script>
@stop