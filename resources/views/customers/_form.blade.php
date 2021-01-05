@csrf
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Customer Name</label>
            <input name="customer_name" type="text" id="customer_name" value="{{ old('customer_name',$customer->customer_name??null) }}" placeholder="Customer Name" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Contact Number</label>
            <input name="contact_number" type="text" id="contact_number" value="{{ old('contact_number',$customer->contact_number??null) }}" placeholder="Contact Number" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Email</label>
            <input name="email" type="text" id="email" value="{{ old('email',$customer->email??null) }}" placeholder="email" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Address</label>
            <input name="address" type="text" id="address" value="{{ old('address',$customer->address??null) }}" placeholder="address" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Contact Person</label>
            <input name="contact_person" type="text" id="contact_person" value="{{ old('contact_person',$customer->contact_person??null) }}" placeholder="contact_person" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Customer Type</label>			
            <select id="customer_type_id" name="customer_type_id" placeholder="" class="col-lg-6 entry_panel_dropdown">
            <option value="">Select Value</option>	
                @foreach ($customer_type_id as $customer_type_id)
                        @if (old('customer_type_id')==$customer_type_id->id)
                            <option value={{$customer_type_id->id}} {{selected}}>{{ $customer_type_id->customer_type_name }}</option>
                        @else
                            <option value={{$customer_type_id->id}} >{{ $customer_type_id->customer_type_name }}</option>
                        @endif
                @endforeach
            </select>
            <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#customer_type_idModal">... </button></td>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12 hidden">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">User's ID</label>
            <input name="users_id" type="number" id="users_id" value="{{ $users }}" placeholder="Default Vat" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="col-lg-12 entry_panel_body">
            <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
        </div>
    </div>
</form>

    <!-- customer_type_id -->

    <div class="modal fade" id="customer_type_idModal" tabindex="-1" role="dialog" aria-labelledby="catAddLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 500px;">
            <div class="modal-content">
                <form action="{{ route('customertypes.store') }}" method="POST" id="customer_type_idForm">
                @csrf
                    <div class="modal-header" style="background: coral; padding: 10px;">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="catAddLabel">Add Customer Type</h4>
                    </div>
                    <div class="modal-body">
                        <table style="width: 450px;">
                            <tr>
                                <td>
                                    <input name="customer_type_name" type="text" id="customer_type_name" placeholder="customer_type_name" class="col-lg-12 col-md-12 col-xs-12" style="height: 30px;">
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

        // customer_type_id

		$( "#customer_type_idForm" ).submit(function( event ) {
		// Stop form from submitting normally
			event.preventDefault();
			// Get some values from elements on the page:
			var $form   = $( this ),
			departments = $form.find( "input[name='customer_type_name']" ).val(),
			url         = $form.attr( "action" ); 
			var posting = $.post( url, {new_occupationsdescription: departments} );

			// Put the results in a div
			posting.done(function( data ) {
				$('#customer_type_idForm').trigger("reset");
				$('#customer_type_idModal').modal('hide');

				//Reload the options of dropdown list using ajax.

				$.ajax({
					// type: "POST",
					url: "{{URL::to('/')}}/customertypes/create",
					dataType: "json",
					success: function(data){
						$('#customer_type_id').empty();
						var opts = data;
						// Use jQuery's each to iterate over the opts value
						$('#customer_type_id').append('<option value="">Select</option>');
						$.each(opts, function(i, d) {
						// You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
						$('#customer_type_id').append('<option value="' + d.id + '">' + d.customer_type_name + '</option>');
						});
					}
				})
			});
		});
    </script>
@stop