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

    <button id="addrow">Add Row</button>
    <table id="datatable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Medicine Name</th>
                <th>Price</th>
                <th>TP</th>
                <th>Default Discount</th>
                <th>Default Vat</th>
                <th>Act</th>
            </tr>
        </thead>
    </table>

    <div class="col-lg-6 col-md-6 col-xs-6">
        <label for="Medicine Name" class="col-lg-1 col-md-1 col-xs-1 entry_panel_label">Total</label>
        <input name="" type="text" id="total" value="" placeholder="" class="col-lg-2 col-md-2 col-xs-2 entry_panel_input" readonly>
        <label for="Medicine Name" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Including Vat & Discount</label>
        <input name="" type="text" id="discountedvat_price" value="" placeholder="" class="col-lg-2 col-md-2 col-xs-2 entry_panel_input" readonly>
    </div>
    <div class="col-lg-6 col-md-6 col-xs-6">
        <label for="Medicine Name" class="col-lg-2 col-md-2 col-xs-2 entry_panel_label">Discount</label>
        <input name="" type="text" id="dis" value="" placeholder="" class="col-lg-2 col-md-2 col-xs-2 entry_panel_input" readonly>
        <label for="Medicine Name" class="col-lg-1 col-md-1 col-xs-1 entry_panel_label">Vat</label>
        <input name="" type="text" id="vat" value="" placeholder="" class="col-lg-2 col-md-2 col-xs-2 entry_panel_input" readonly>
    </div>

@section('scripts')
    <script>
        // show medicine dropdown based on company
        $(document).ready(function($){
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
        });
    </script>

    <script>
        // show datatable of selected medicines
        $(document).ready(function($){
            let med;
            var total = 0;
            var dis = 0;
            var vat = 0;
            var discountedvat_price = 0;
            var table = $('#datatable').DataTable(

                $('#addrow').on( 'click', function () {
                    medicineid = document.getElementById('medicine_informations_id').value;
                    med = {!! json_encode($medicine_informations_id) !!};
                    total += med[medicineid-1].mrp;
                    dis += med[medicineid-1].mrp * med[medicineid-1].default_discount/100;
                    vat += med[medicineid-1].mrp * med[medicineid-1].default_vat/100;
                    discountedvat_price = total - dis + vat;
                    $("#dis").attr("value", dis);
                    $("#vat").attr("value", vat);
                    $("#total").attr("value", total);
                    $("#discountedvat_price").attr("value", discountedvat_price);
                    // console.log(total);
                    
                    table.row.add( [
                        med[medicineid-1].id,
                        med[medicineid-1].medicine_name,
                        med[medicineid-1].mrp,
                        med[medicineid-1].tp,
                        med[medicineid-1].default_discount,
                        med[medicineid-1].default_vat,
                        '<button type="button" id="row_delete">Delete</button>'
                    ] ).draw()
                })
            );

            $('#datatable tbody').on( 'click', '#row_delete', function () {
                table.row (
                    $(this).parents('tr')).remove().draw();
                    total -= med[medicineid-1].mrp;
                    dis -= med[medicineid-1].mrp * med[medicineid-1].default_discount/100;
                    vat -= med[medicineid-1].mrp * med[medicineid-1].default_vat/100;
                    discountedvat_price = total - dis + vat;
                    console.log(med[medicineid-1]);
                    $("#dis").attr("value", dis);
                    $("#vat").attr("value", vat);
                    $("#total").attr("value", total);
                    $("#discountedvat_price").attr("value", discountedvat_price);
            });
        });
    </script>

    <script>
    </script>
@stop