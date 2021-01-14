    @csrf
        <div class="col-lg-6 col-md-6 col-xs-12 hidden">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">PO Number</label>
                <input name="po_number" type="text" id="po_number" value="" placeholder="po_number" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12 hidden">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" style="height: 40px;" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">PO Date</label>
                <input name="po_date" type="date" id="po_date" value="<?= date('Y-m-d'); ?>" placeholder="po_date" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" style="height: 40px;" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Delivery Date</label>
                <input name="delivery_date" type="date" id="delivery_date" value="{{ old('delivery_date',$medicinepurchaseorder->delivery_date??null) }}" placeholder="delivery_date" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Note</label>
                <input name="note" type="text" id="note" value="{{ old('note',$medicinepurchaseorder->note??null) }}" placeholder="note" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12 hidden">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Users Id</label>
                <input name="users_id" type="text" id="users_id" value="{{ $user->id }}" placeholder="users_id" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12 hidden">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Valid</label>
                <input name="valid" type="number" id="valid" value="1" placeholder="Valid" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Medicine Company</label>			
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
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Requisition Quantity</label>
                <input name="requisition_quantity" type="text" id="requisition_quantity" value="{{ old('requisition_quantity',$medicinepurchaseorderdetail->requisition_quantity??null) }}" placeholder="requisition_quantity" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Rate</label>
                <input name="rate" type="text" id="valid" value="{{ old('rate',$medicinepurchaseorderdetail->rate??null) }}" placeholder="rate" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Bonus Quantity</label>
                <input name="bonus_quantity" type="text" id="bonus_quantity" value="{{ old('bonus_quantity',$medicinepurchaseorderdetail->bonus_quantity??null) }}" placeholder="bonus_quantity" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
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

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Medicine</label>			
                <select id="medicine_informations_id" name="medicine_informations_id" placeholder="" class="col-lg-7 entry_panel_dropdown">
                <option value="">Select Value</option>	
                    @foreach ($medicine_informations_id as $medicine_informations_id)
                            @if (old('medicine_informations_id')==$medicine_informations_id->id)
                                <option value="{{$medicine_informations_id->id}}" selected>{{ $medicine_informations_id->medicine_name }}</option>
                            @else
                                <option value="{{$medicine_informations_id->id}}" >{{ $medicine_informations_id->medicine_name }}</option>
                            @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="col-lg-12 entry_panel_body">
                <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
            </div>
        </div>
    </form>

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
    <script>
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