    @csrf
        <!-- purchase orders -->
        <div class="col-lg-6 col-md-6 col-xs-12 hidden">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" style="height: 40px;" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">PO Date</label>
                <input name="po_date" type="date" id="po_date" value="<?= date('Y-m-d'); ?>" placeholder="po_date" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
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
                <label for="Medicine Name" style="height: 40px;" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Delivery Date</label>
                <input name="delivery_date" type="date" id="delivery_date" value="{{ old('delivery_date',$medicinepurchaseorder->delivery_date??null) }}" placeholder="delivery_date" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" style="height: 40px;" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Note</label>
                <input name="note" type="text" id="note" style="height: 40px;" value="{{ old('note',$medicinepurchaseorder->note??null) }}" placeholder="note" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
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
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Medicine</label>			
                <select id="medicine_informations_id" name="medicine_informations_id" placeholder="" class="col-lg-7 entry_panel_dropdown"></select>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Requisition Quantity</label>
                <input name="quantity" type="text" id="quantity" value="{{ 1 }}" placeholder="requisition_quantity" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Bonus Quantity</label>
                <input name="bon_quantity" type="text" id="bon_quantity" value="0" placeholder="bonus_quantity" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <h4 style="color: coral">Medicine View</h4>
        <table id="datatable2" class="table table-bordered">
            <thead>
                <tr>
                </tr>
                <tr>
                    <th>Medicine Name</th>
                    <th>Price</th>
                    <th>Default Discount</th>
                    <th>Default Vat</th>
                    <th>Unit</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>

        <h4 style="color: coral">Medicine Order Table</h4>
        <table id="datatable" class="table table-bordered">
            <thead>
                <tr>
                </tr>
                <tr>
                    <th>Medicine Name</th>
                    <th>Price</th>
                    <th>Default Discount</th>
                    <th>Default Vat</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Bonus Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <label for="Medicine Name" class="col-lg-1 col-md-1 col-xs-1 entry_panel_label">Total</label>
                <input name="" type="text" id="total" value="" placeholder="" class="col-lg-1 col-md-1 col-xs-1 entry_panel_input" readonly>
                <label for="Medicine Name" class="col-lg-3 col-md-3 col-xs-3 entry_panel_label">Including Vat & Discount</label>
                <input name="" type="text" id="discountedvat_price" value="" placeholder="" class="col-lg-1 col-md-1 col-xs-1 entry_panel_input" readonly>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <label for="Medicine Name" class="col-lg-2 col-md-2 col-xs-2 entry_panel_label">Discount</label>
                <input name="" type="text" id="dis" value="" placeholder="" class="col-lg-1 col-md-1 col-xs-1 entry_panel_input" readonly>
                <label for="Medicine Name" class="col-lg-2 col-md-2 col-xs-2 entry_panel_label">Vat</label>
                <input name="" type="text" id="vat" value="" placeholder="" class="col-lg-1 col-md-1 col-xs-1 entry_panel_input" readonly>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-12 entry_panel_body">
                <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-1 col-md-1 col-xs-1 btn btn-save btn-sm button button-save pull-right">
            </div>
        </div>
    </form>

@section('scripts')
    <script>
        // show medicine dropdown based on company
        $(document).ready(function(){
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
                        view();
                    }
                })		
            });
            // use these globally
            med = {!! json_encode($medicine_informations_id) !!};
            unit = {!! json_encode($medicine_units_id) !!};
            var i,j;
            var total = 0;
            var dis = 0;
            var vat = 0;
            var discountedvat_price = 0;

            // initialize view table
            var table2 = $('#datatable2').DataTable({
                searching: false,
                ordering: false,
                paging: false,
                bInfo: false
            });

            // function to add to view table from dropdown
            function view(){
                medicineid = document.getElementById('medicine_informations_id').value;
                for (k=0; k<Object.keys(med).length; k++) {
                    if (med[k].id == medicineid){
                        break;
                    }
                }
                console.log(med[k]);
                table2.clear()
                table2.row.add( [
                    med[k].medicine_name,
                    med[k].mrp,
                    med[k].default_discount,
                    med[k].default_vat,
                    unit[k].unit_name,
                    '<button type="button" id="addrow">Add To Table</button>'
                ] ).draw()
            };

            // selecting a medicine adds to view tables
            // $('#medicine_company_infos_id').click(view);
            $('#medicine_informations_id').click(view);

            // initialize order table
            var table = $('#datatable').DataTable({
                searching: false,
                ordering: false,
                paging: false,
                bInfo: false
            });

            // add to order table on click from view table
            $('#datatable2 tbody').on( 'click', '#addrow', function () {
                medicineid = document.getElementById('medicine_informations_id').value;
                requisition_quantity = document.getElementById('quantity').value;
                bonus_quantity = document.getElementById('bon_quantity').value;

                for (i=0; i<Object.keys(med).length; i++) {
                    if (med[i].id == medicineid){
                        break;
                    }
                }

                for (j=0; j<Object.keys(unit).length; j++) {
                    if (unit[j].id == med[i].medicine_units_id){
                        break;
                    }
                }

                total += med[i].mrp*requisition_quantity;
                dis += requisition_quantity*med[i].mrp * med[i].default_discount/100;
                vat += requisition_quantity*med[i].mrp * med[i].default_vat/100;
                discountedvat_price = total - dis + vat;
                fdis = dis.toFixed(1);
                fvat = vat.toFixed(1);
                $("#dis").attr("value", fdis);
                $("#vat").attr("value", fvat);
                $("#total").attr("value", total);
                $("#discountedvat_price").attr("value", discountedvat_price);
                
                table.row.add( [
                    med[i].medicine_name,
                    med[i].mrp,
                    med[i].default_discount,
                    med[i].default_vat,
                    requisition_quantity,
                    unit[j].unit_name,
                    bonus_quantity,
                    '<button quantity="'+requisition_quantity+'" value="'+i+'" type="button" id="row_delete">Delete</button> <input name="sendmedicineid[]" type="text" id="rate" value="'+medicineid+'" class="hidden"> <input name="requisition_quantity[]" type="text" id="requisition_quantity" value="'+requisition_quantity+'" class="hidden"> <input name="bonus_quantity[]" type="text" id="bonus_quantity" value="'+bonus_quantity+'" class="hidden">'
                ] ).draw()
            });

            // delete a row from order table
            $('#datatable tbody').on( 'click', '#row_delete', function () {
                var val = $(this).val();
                var quantity = $(this).attr("quantity");
                console.log(med[val]);
                total -= med[val].mrp*quantity;
                dis = dis - quantity*med[val].mrp * med[val].default_discount/100;
                vat = vat - quantity*med[val].mrp * med[val].default_vat/100;
                discountedvat_price = total - dis + vat;
                fdis = dis.toFixed(1);
                fvat = vat.toFixed(1);
                $("#dis").attr("value", fdis);
                $("#vat").attr("value", fvat);
                $("#total").attr("value", total);
                $("#discountedvat_price").attr("value", discountedvat_price);
                table.row (
                    $(this).parents('tr')).remove().draw();
            });
        });
    </script>

    <script>
    </script>
@stop