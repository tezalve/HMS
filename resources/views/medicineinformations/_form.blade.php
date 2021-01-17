    @csrf
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Medicine Name</label>
                <input name="medicine_name" type="text" id="medicine_name" value="{{ old('medicine_name',$medicineinformation->medicine_name??null) }}" placeholder="Medicine Name" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Price</label>
                <input name="mrp" type="number" id="mrp" value="{{ old('mrp',$medicineinformation->mrp??null) }}" placeholder="mrp" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">TP</label>
                <input name="tp" type="text" id="tp" value="{{ old('tp',$medicineinformation->tp??null) }}" placeholder="tp" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Default Discount</label>
                <input name="default_discount" type="number" id="default_discuunt" value="{{ old('default_discount',$medicineinformation->default_discount??null) }}" placeholder="Default Discuunt" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Default Vat</label>
                <input name="default_vat" type="number" id="default_vat" value="{{ old('default_vat',$medicineinformation->default_vat??null) }}" placeholder="Default Vat" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Generic Name</label>
                <select id="medicine_generic_names_id" name="medicine_generic_names_id" placeholder="" class="col-lg-6 entry_panel_dropdown">
                <option value="">Select Value</option>	
                    @foreach ($medicine_generic_names_id as $medicine_generic_names_id)
                            @if (old('medicine_generic_names_id')==$medicine_generic_names_id->id)
                                <option value="{{$medicine_generic_names_id->id}}" selected>{{ $medicine_generic_names_id->generic_name }}</option>
                            @else
                                <option value="{{$medicine_generic_names_id->id}}" >{{ $medicine_generic_names_id->generic_name }}</option>
                            @endif
                    @endforeach
                </select>
                <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#medicine_generic_names_idModal">... </button></td>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Medicine Group</label>				
                <select id="medicine_groups_id" name="medicine_groups_id" placeholder="" class="col-lg-6 entry_panel_dropdown">
                <option value="">Select Value</option>	
                    @foreach ($medicine_groups_id as $medicine_groups_id)
                            @if (old('medicine_groups_id')==$medicine_groups_id->id)
                                <option value="{{$medicine_groups_id->id}}" selected>{{ $medicine_groups_id->group_name }}</option>
                            @else
                                <option value="{{$medicine_groups_id->id}}" >{{ $medicine_groups_id->group_name }}</option>
                            @endif
                    @endforeach
                </select>
                <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#medicine_groups_idModal">... </button></td>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Medicine Company Name</label>			
                <select id="medicine_company_infos_id" name="medicine_company_infos_id" placeholder="" class="col-lg-7 entry_panel_dropdown">
                <option value="">Select Value</option>	
                    @foreach ($medicine_company_infos_id as $medicine_company_infos_id)
                            @if (old('medicine_company_infos_id')==$medicine_company_infos_id->id)
                                <option value="{{$medicine_company_infos_id->id}}" selected>{{ $medicine_company_infos_id->company_name }}</option>
                            @else
                                <option value="{{$medicine_company_infos_id->id}}" >{{ $medicine_company_infos_id->company_name }}</option>
                            @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Medicine Unit</label>			
                <select id="medicine_units_id" name="medicine_units_id" placeholder="" class="col-lg-6 entry_panel_dropdown">
                <option value="">Select Value</option>	
                    @foreach ($medicine_units_id as $medicine_units_id)
                            @if (old('medicine_units_id')==$medicine_units_id->id)
                                <option value="{{$medicine_units_id->id}}" selected>{{ $medicine_units_id->unit_name }}</option>
                            @else
                                <option value="{{$medicine_units_id->id}}" >{{ $medicine_units_id->unit_name }}</option>
                            @endif
                    @endforeach
                </select>
                <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#medicine_units_idModal">... </button></td>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12 hidden">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">User's ID</label>
                <input name="users_id" type="number" id="users_id" value="{{ $users->id }}" placeholder="Default Vat" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="col-lg-12 entry_panel_body">
                <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
            </div>
        </div>
    </form>

    <!-- medicine_generic_names_id -->

    <div class="modal fade" id="medicine_generic_names_idModal" tabindex="-1" role="dialog" aria-labelledby="catAddLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 500px;">
            <div class="modal-content">
                <form action="{{ route('medicinegenerics.store') }}" method="POST" id="medicine_generic_names_idForm">
                @csrf
                    <div class="modal-header" style="background: coral; padding: 10px;">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="catAddLabel">Add New Generic Name</h4>
                    </div>
                    <div class="modal-body">
                        <table style="width: 450px;">
                            <tr>
                                <td>
                                    <input name="generic_name" type="text" id="generic_name" placeholder="generic_name" class="col-lg-12 col-md-12 col-xs-12" style="height: 30px;">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" name="category_save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- medicine_groups_id -->

    <div class="modal fade" id="medicine_groups_idModal" tabindex="-1" role="dialog" aria-labelledby="catAddLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 500px;">
            <div class="modal-content">
                <form action="{{ route('medicinegroups.store') }}" method="POST" id="medicine_groups_idForm">
                @csrf
                    <div class="modal-header" style="background: coral; padding: 10px;">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="catAddLabel">Add Medicine Group</h4>
                    </div>
                    <div class="modal-body">
                        <table style="width: 450px;">
                            <tr>
                                <td>
                                    <input name="group_name" type="text" id="group_name" placeholder="group_name" class="col-lg-12 col-md-12 col-xs-12" style="height: 30px;">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" name="category_save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- medicine_units_id -->

    <div class="modal fade" id="medicine_units_idModal" tabindex="-1" role="dialog" aria-labelledby="catAddLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 500px;">
            <div class="modal-content">
                <form action="{{ route('medicineunits.store') }}" method="POST" id="medicine_units_idForm">
                @csrf
                    <div class="modal-header" style="background: coral; padding: 10px;">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="catAddLabel">Add Medicine Unit</h4>
                    </div>
                    <div class="modal-body">
                        <table style="width: 450px;">
                            <tr>
                                <td>
                                    <input name="unit_name" type="text" id="unit_name" placeholder="unit_name" class="col-lg-12 col-md-12 col-xs-12" style="height: 30px;">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" name="category_save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@section('scripts')

	<script type="text/javascript">

        // medicine_generic_names_id

		$( "#medicine_generic_names_idform" ).submit(function( event ) {
		// Stop form from submitting normally
			event.preventDefault();
			// Get some values from elements on the page:
			var $form   = $( this ),
			departments = $form.find( "input[name='generic_name']" ).val(),
			url         = $form.attr( "action" ); 
			var posting = $.post( url, {new_occupationsdescription: departments} );

			// Put the results in a div
			posting.done(function( data ) {
				$('#medicine_generic_names_idForm').trigger("reset");
				$('#medicine_generic_names_idModal').modal('hide');

				//Reload the options of dropdown list using ajax.

				$.ajax({
					// type: "POST",
					url: "{{URL::to('/')}}/medicinegenerics/create",
					dataType: "json",
					success: function(data){
						$('#medicine_generic_names_id').empty();
						var opts = data;
						// Use jQuery's each to iterate over the opts value
						$('#medicine_generic_names_id').append('<option value="">Select</option>');
						$.each(opts, function(i, d) {
						// You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
						$('#medicine_generic_names_id').append('<option value="' + d.id + '">' + d.generic_name + '</option>');
						});
					}
				})
			});
		});

        // medicine_groups_id

        $( "#medicine_groups_idForm" ).submit(function( event ) {
		// Stop form from submitting normally
			event.preventDefault();
			// Get some values from elements on the page:
			var $form   = $( this ),
			departments = $form.find( "input[name='group_name']" ).val(),
			url         = $form.attr( "action" ); 
			var posting = $.post( url, {new_occupationsdescription: departments} );

			// Put the results in a div
			posting.done(function( data ) {
				$('#medicine_groups_idForm').trigger("reset");
				$('#medicine_groups_idModal').modal('hide');

				//Reload the options of dropdown list using ajax.

				$.ajax({
					// type: "POST",
					url: "{{URL::to('/')}}/medicinegroups/create",
					dataType: "json",
					success: function(data){
						$('#medicine_groups_id').empty();
						var opts = data;
						// Use jQuery's each to iterate over the opts value
						$('#medicine_groups_id').append('<option value="">Select</option>');
						$.each(opts, function(i, d) {
						// You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
						$('#medicine_groups_id').append('<option value="' + d.id + '">' + d.group_name + '</option>');
						});
					}
				})
			});
		});

        // medicine_units_id

        $( "#medicine_units_idForm" ).submit(function( event ) {
		// Stop form from submitting normally
			event.preventDefault();
			// Get some values from elements on the page:
			var $form   = $( this ),
			departments = $form.find( "input[name='unit_name']" ).val(),
			url         = $form.attr( "action" ); 
			var posting = $.post( url, {new_occupationsdescription: departments} );

			// Put the results in a div
			posting.done(function( data ) {
				$('#medicine_units_idForm').trigger("reset");
				$('#medicine_units_idModal').modal('hide');

				//Reload the options of dropdown list using ajax.

				$.ajax({
					// type: "POST",
					url: "{{URL::to('/')}}/medicineunits/create",
					dataType: "json",
					success: function(data){
						$('#medicine_units_id').empty();
						var opts = data;
						// Use jQuery's each to iterate over the opts value
						$('#medicine_units_id').append('<option value="">Select</option>');
						$.each(opts, function(i, d) {
						// You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
						$('#medicine_units_id').append('<option value="' + d.id + '">' + d.unit_name + '</option>');
						});
					}
				})
			});
		});

	</script>
@stop