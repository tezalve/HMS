    @csrf
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
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Bonus Quantity</label>
                <input name="bonus_quantity" type="text" id="bonus_quantity" value="{{ old('bonus_quantity',$medicinepurchaseorderdetail->bonus_quantity??null) }}" placeholder="bonus_quantity" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Medicine</label>			
                <select id="medicine_informations_id" name="medicine_informations_id" placeholder="" class="col-lg-7 entry_panel_dropdown"></select>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="col-lg-12 entry_panel_body">
                <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
            </div>
        </div>
    </form>

@section('scripts')
    <script>
        jQuery(document).ready(function($){
            $('#medicine_company_infos_id').change(function(){

                var companyid = document.getElementById('medicine_company_infos_id').value;
                var senddata = '&medicine_company_infos_id='+companyid;
                    $.ajax({
                        headers: {
                                'X-CSRF-TOKEN':'{{csrf_token()}}'
                        },
                        type: "POST",
                        url :   "{{URL::to('/')}}/medlist",
                        data :  senddata,
                        dataType: "json",
                        success: function(data){
                            $('#medicine_informations_id').empty();
                            var opts = data;
                            // Use jQuery's each to iterate over the opts value
                            // $('#department').append('<option value="">Select</option>');
                            $.each(opts, function(i, d) {
                            // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                            $('#medicine_informations_id').append('<option value="' + d.id + '">' + d.medicine_name + '</option>');
                            });
                        }
                    })		
                });
            })
    </script>
@stop