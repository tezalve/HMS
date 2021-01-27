    @csrf
        <!-- purchase orders -->
        <div class="col-lg-7 col-md-7 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-3 col-md-3 col-xs-3 entry_panel_label">Order Date</label>
                <input name="po_date" type="text" id="po_date" value="<?= date("Y-m-d") ?>" placeholder="po_date" class="ol-lg-3 col-md-3 col-xs-3 entry_panel_input" readonly>
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
        
        <div class="col-lg-7 col-md-7 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-3 col-md-3 col-xs-3 entry_panel_label">Delivery Date</label>
                <input name="delivery_date" type="text" id="delivery_date" value="{{ old('delivery_date',$medicinepurchaseorder->delivery_date??null) }}" placeholder="delivery_date" class="ol-lg-3 col-md-3 col-xs-3 entry_panel_input">
            </div>
        </div>

        <div class="col-lg-7 col-md-7 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-3 col-md-3 col-xs-3 entry_panel_label">Note</label>
                <input name="note" type="text" id="note" value="{{ old('note',$medicinepurchaseorder->note??null) }}" placeholder="note" class="ol-lg-3 col-md-3 col-xs-3 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-7 col-md-7 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-3 col-md-3 col-xs-3 entry_panel_label">Medicine Company</label>			
                <select id="medicine_company_infos_id" name="medicine_company_infos_id" placeholder="" class="col-lg-3 entry_panel_dropdown">
                <option></option>
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

        <div class="col-lg-6 col-md-6 col-xs-12 hidden">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Medicine</label>			
                <select id="medicine_informations_id" name="medicine_informations_id" placeholder="" class="col-lg-7 entry_panel_dropdown"></select>
            </div>
        </div>

        <table style="padding: 5px" id="datatable" class="table table.dataTable.no-footer">
            <thead>
                <tr>
                    <th style="width:10%;">Medicine Name</th>
                    <th style="width:10%;">Unit</th>
                    <th style="width:10%;">Rate</th>
                    <th style="width:10%;">Discount(%)</th>
                    <th style="width:10%;">Vat(%)</th>
                    <th style="width:10%;">Quantity</th>
                    <th style="width:10%;">Bonus Quantity</th>
                    <th style="width:10%;">Total</th>
                    <th style="width:05%;">Action</th>
                </tr>
                <tr>
                    <th><select name="medicine_informations_id2"     id="medicine_informations_id2"  placeholder=""                      style="width:100%;"     class="entry_panel_dropdown"></select></th>
                    <th><input  name="unit"              type="text" id="unit"                       placeholder="unit"                  style="width:100%;"     class="entry_panel_input" readonly></th>
                    <th><input  name="rate"              type="text" id="rate"                       placeholder="price"                 style="width:100%;"     class="entry_panel_input"></th>
                    <th><input  name="default_discount"  type="text" id="default_discount"           placeholder="discount"              style="width:100%;"     class="entry_panel_input"></th>
                    <th><input  name="default_vat"       type="text" id="default_vat"                placeholder="vat"                   style="width:100%;"     class="entry_panel_input"></th>
                    <th><input  name="quantity"          type="text" id="quantity"                   placeholder="requisition_quantity"  style="width:100%;"     class="entry_panel_input"></th>
                    <th><input  name="bon_quantity"      type="text" id="bon_quantity"               placeholder="bonus_quantity"        style="width:100%;"     class="entry_panel_input"></th>
                    <th><input  name="totalrow"          type="text" id="totalrow"                   placeholder="total"                 style="width:100%;"     class="entry_panel_input" readonly></th>
                    
                    <th><button type="button" id="addrow" style="width:100%;">+ Add</button></th>
                </tr>
            </thead>
            <tfoot>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>
        </table>

        <div class="col-lg-12 col-md-12 col-xs-12 hidden">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <label for="Medicine Name" class="col-lg-1 col-md-1 col-xs-1 entry_panel_label">Total</label>
                <input name="" type="text" id="total" value="" placeholder="" class="col-lg-1 col-md-1 col-xs-1 entry_panel_input" readonly>
                <label for="Medicine Name" class="col-lg-3 col-md-3 col-xs-3 entry_panel_label">Including Vat & Discount</label>
                <input name="" type="text" id="discountedvat_price2" value="" placeholder="" class="col-lg-1 col-md-1 col-xs-1 entry_panel_input" readonly>
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
                <input type="submit" id="submit" name="submit" value="Submit" class="col-lg-1 col-md-1 col-xs-1 btn btn-save btn-sm button button-save pull-right">
            </div>
        </div>

@section('scripts')
    <script>
        var opts;
        $(document).ready(function(){
            $("#delivery_date").datepicker({ dateFormat: 'yy-mm-dd' });
            $("#po_date").datepicker({ dateFormat: 'yy-mm-dd' }).datepicker("setDate", new Date());

            // show medicine dropdown based on company
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
                    success: function(data) {
                        $('#medicine_informations_id').empty();
                        len = Object.keys(data).length;
                        if (len == 0){
                            console.log("length = " + len);
                            $('#medicine_informations_id2').empty();
                            $('#medicine_informations_id2').append('<option></option>');
                        } else {
                            opts = data;
                            // Use jQuery's each to iterate over the opts value
                            // $('#department').append('<option value="">Select</option>');
                            $.each(opts, function(i, d) {
                                // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                                $('#medicine_informations_id').append('<option value="' + d.id + '">' + d.medicine_name + '</option>');
                            });
                            view();
                        }
                    }
                })
            });

            $('#medicine_company_infos_id').select2({
                placeholder: 'Search Company',
                delay: 1000,
                minimumInputLength: 1,
                minimumResultsForSearch: 1
            });

            // use these globally
            med = {!! json_encode($medicine_informations_id) !!};
            unit = {!! json_encode($medicine_units_id) !!};
            var i,j,a;
            var total = 0;
            var dis = 0;
            var vat = 0;
            var discountedvat_price = 0;
            var totalrow = 0;

            // function to add to view table from dropdown
            function view(){
                console.log("view");
                medicineid = document.getElementById('medicine_informations_id').value;
                for (k=0; k<Object.keys(med).length; k++) {
                    if (med[k].id == medicineid){
                        break;
                    }
                }

                for (a=0; a<Object.keys(unit).length; a++) {
                    if (unit[a].id == med[k].medicine_units_id){
                        break;
                    }
                }

                $('#medicine_informations_id2').empty();
                // Use jQuery's each to iterate over the opts value
                // $('#department').append('<option value="">Select</option>');
                $.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                    $('#medicine_informations_id2').append('<option value="' + d.id + '">' + d.medicine_name + '</option>');
                });

                $("#rate").attr("value", med[k].mrp);
                $('#rate').val(med[k].mrp);

                $("#default_discount").attr("value", med[k].default_discount);
                $('#default_discount').val(med[k].default_discount);

                $("#default_vat").attr("value", med[k].default_vat);
                $('#default_vat').val(med[k].default_vat);

                $("#quantity").attr("value", "1");
                $('#quantity').val("1");

                $("#unit").attr("value", unit[a].unit_name);
                $('#unit').val(unit[a].unit_name);

                $("#bon_quantity").attr("value", "0");
                $('#bon_quantity').val("0");

                calc();

                $("#discountedvat_price").attr("value", discountedvat_price);
                $('#discountedvat_price').val(discountedvat_price);

                $('#medicine_informations_id2').select2({
                    placeholder: 'Search Medincine',
                    delay: 1000,
                    minimumInputLength: 1,
                    minimumResultsForSearch: 1
                });
            };

            $('#datatable thead').on( 'change', '#medicine_informations_id2', function () {
                view2();
                calc();
            });
            $('#datatable thead').on( 'keyup', '#rate', function () {
                calc();
            });
            $('#datatable thead').on( 'keyup', '#default_discount', function () {
                calc();
            });
            $('#datatable thead').on( 'keyup', '#default_vat', function () {
                calc();
            });
            $('#datatable thead').on( 'keyup', '#quantity', function () {
                calc();
            });

            function view2(){
                console.log("view2");
                medicineid = document.getElementById('medicine_informations_id2').value;
                for (k=0; k<Object.keys(med).length; k++) {
                    if (med[k].id == medicineid){
                        break;
                    }
                }

                for (a=0; a<Object.keys(unit).length; a++) {
                    if (unit[a].id == med[k].medicine_units_id){
                        break;
                    }
                }

                // console.log(med[k]);
                // table2.clear()

                // table2.row.add( [
                //     '<select id="medicine_informations_id2" name="medicine_informations_id2" placeholder="" class="col-lg-7 col-md-7 col-xs-7 entry_panel_dropdown"></select>',
                //     '<input name="rate" type="text" id="rate" value="'+med[k].mrp+'" placeholder="price" class="col-lg-12 col-md-12 col-xs-12 entry_panel_input">',
                //     '<input name="default_discount" type="text" id="default_discount" value="'+med[k].default_discount+'" placeholder="discount" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">',
                //     '<input name="default_vat" type="text" id="default_vat" value="'+med[k].default_vat+'" placeholder="vat" class="col-lg-12 col-md-12 col-xs-12 entry_panel_input">',
                //     '<input name="quantity" type="text" id="quantity" value="1" placeholder="requisition_quantity" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">',				
                //     '<input name="bon_quantity" type="text" id="bon_quantity" value="0" placeholder="bonus_quantity" class="col-lg-3 col-md-3 col-xs-3 entry_panel_input">',
                //     unit[k].unit_name,
                //     '<button type="button" id="addrow">Add To Table</button>'
                // ] ).draw()

                // Surprisingly .attr doesn't change chnged input value and .val doesn't show that the
                // value changed in inspect so to be sure used both (.val should be enough)
                $("#rate").attr("value", med[k].mrp);
                $('#rate').val(med[k].mrp);

                $("#default_discount").attr("value", med[k].default_discount);
                $('#default_discount').val(med[k].default_discount);

                $("#default_vat").attr("value", med[k].default_vat);
                $('#default_vat').val(med[k].default_vat);

                $("#quantity").attr("value", "1");
                $('#quantity').val("1");

                $("#unit").attr("value", unit[a].unit_name);
                $('#unit').val(unit[a].unit_name);

                $("#bon_quantity").attr("value", "0");
                $('#bon_quantity').val("0");
            };

            function calc(){
                
                medicineid = document.getElementById('medicine_informations_id2').value;
                requisition_quantity = document.getElementById('quantity').value;
                price = document.getElementById('rate').value;
                discount = document.getElementById('default_discount').value;
                vatt = document.getElementById('default_vat').value;
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

                totalbaserow = price*requisition_quantity;
                disrow = requisition_quantity*price * discount/100 ;
                vatrow = requisition_quantity*price * vatt/100;
                totalrow = totalbaserow - disrow + vatrow;
                $("#totalrow").attr("value", totalrow);
                $("#totalrow").val(totalrow);

                total += price*requisition_quantity;
                dis += requisition_quantity*price * discount/100;
                vat += requisition_quantity*price * vatt/100;
                discountedvat_price = total - dis + vat;
                fdis = dis.toFixed(2);
                fvat = vat.toFixed(2);
                $("#dis").attr("value", fdis);
                $("#vat").attr("value", fvat);
                $("#total").attr("value", total);
                $("#discountedvat_price").attr("value", discountedvat_price);
                $("#discountedvat_price").val(discountedvat_price);
                console.log("calculated " + discountedvat_price);
            }
            // initialize order table
            var table = $('#datatable').DataTable({
                searching: false,
                ordering: false,
                paging: false,
                bInfo: false,

                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
        
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
        
                    // Total over this page
                    pageTotal = api
                        .column( 7, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
        
                    // Update footer
                    $( api.column( 7 ).footer() ).html(
                        'Total = '+pageTotal
                    );
                }
            });

            // add to order table on click from view table
            
            $('#datatable thead').on( 'click', '#addrow', function () {
                if (med[$('#row_delete').val()] == null) {
                    console.log(med[$('#row_delete').val()]);
                    calc();
                    table.row.add( [
                        med[i].medicine_name,
                        unit[j].unit_name,
                        price,
                        discount,
                        vatt,
                        requisition_quantity,
                        bonus_quantity,
                        totalrow,
                        '<button vatt="'+vatt+'" discount="'+discount+'" price="'+price+'" quantity="'+requisition_quantity+'" value="'+i+'" type="button" id="row_delete">Delete</button> <input name="sendmedicineid[]" type="text" id="id" value="'+medicineid+'" class="hidden"> <input name="requisition_quantity[]" type="text" id="requisition_quantity" value="'+requisition_quantity+'" class="hidden"> <input name="bonus_quantity[]" type="text" id="bonus_quantity" value="'+bonus_quantity+'" class="hidden"> <input name="rates[]" type="text" id="rates" value="'+price+'" class="hidden"><input name="discount[]" type="text" id="discount" value="'+discount+'" class="hidden"><input name="vat[]" type="text" id="vatt" value="'+vatt+'" class="hidden">'
                    ] ).draw()
                } else {
                    var medcom = med[$('#row_delete').val()].medicine_company_infos_id;
                    var selcom = $('#medicine_company_infos_id').val();
                    if (medcom != selcom) {
                        console.log(medcom + "!=" + selcom);
                        alert('Order from one company at a time (empty table or finish ordering)')
                    } else {
                        console.log(med[$('#row_delete').val()].medicine_company_infos_id);
                        calc();
                        table.row.add( [
                            med[i].medicine_name,
                            unit[j].unit_name,
                            price,
                            discount,
                            vatt,
                            requisition_quantity,
                            bonus_quantity,
                            totalrow,
                            '<button vatt="'+vatt+'" discount="'+discount+'" price="'+price+'" quantity="'+requisition_quantity+'" value="'+i+'" type="button" id="row_delete">Delete</button> <input name="sendmedicineid[]" type="text" id="id" value="'+medicineid+'" class="hidden"> <input name="requisition_quantity[]" type="text" id="requisition_quantity" value="'+requisition_quantity+'" class="hidden"> <input name="bonus_quantity[]" type="text" id="bonus_quantity" value="'+bonus_quantity+'" class="hidden"> <input name="rates[]" type="text" id="rates" value="'+price+'" class="hidden"><input name="discount[]" type="text" id="discount" value="'+discount+'" class="hidden"><input name="vat[]" type="text" id="vatt" value="'+vatt+'" class="hidden">'
                        ] ).draw()
                    }
                }
            });

            // delete a row from order table
            $('#datatable tbody').on( 'click', '#row_delete', function () {
                var val = $(this).val();
                var quantity = $(this).attr("quantity");
                var price = $(this).attr("price");
                var vatt = $(this).attr("vatt");
                var discount = $(this).attr("discount");

                total -= price*quantity;
                dis = dis - quantity*price * discount/100;
                vat = vat - quantity*price * vatt /100;
                discountedvat_price = total - dis + vat;
                fdis = dis.toFixed(2);
                fvat = vat.toFixed(2);
                $("#dis").attr("value", fdis);
                $("#vat").attr("value", fvat);
                $("#total").attr("value", total);
                $("#discountedvat_price").attr("value", discountedvat_price);
                table.row (
                    $(this).parents('tr')).remove().draw();
            });
        });
    </script>
@stop