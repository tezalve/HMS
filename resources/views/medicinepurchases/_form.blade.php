    @csrf
        <!-- first one to submit, second one to show -->
        <div class="col-lg-6 col-md-6 col-xs-12 hidden">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" style="height: 40px;" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">PO Number</label>
                <input name="medicine_purchase_orders_id" type="text" id="medicine_purchase_orders_id" value="{{$medicinePurchaseOrder->id}}" placeholder="" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" readonly>				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">PO Number</label>
                <input name="" type="text" id="" value="{{$medicinePurchaseOrder->po_number}}" placeholder="" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" readonly>				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Delivery Date</label>
                <input name="delivery_date" type="text" id="delivery_date" value="<?= date("Y-m-d") ?>" placeholder="delivery_date" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" Readonly>				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Note</label>
                <input name="note" type="text" id="note" value="{{ old('note',$medicinepurchase->note??null) }}" placeholder="note" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Transaction Type</label>
                <select id="transaction_type" name="transaction_type" placeholder="" class="col-lg-7 col-md-7 col-xs-7 entry_panel_dropdown" >
                    <option value="">Select Type</option>
                    <option value="Cash">Cash</option>
                    <option value="Bkash">Bkash</option>
                    <option value="Card">Card</option>
                    <option value="Payorder">Pay Order</option>
                    <option value="Check">Check</option>
                </select>
			</div>
		</div>

        <!-- first one to submit, second one to show -->
        <div class="col-lg-6 col-md-6 col-xs-12 hidden">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" style="height: 40px;" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">medicine_company_infos_id</label>
                <input name="medicine_company_infos_id" type="text" id="medicine_company_infos_id" value="{{$medicine_company_infos_id->id}}" placeholder="{{$medicine_company_infos_id->po_number}}" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" readonly>				
            </div>
        </div> 

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Medicine Company</label>
                <input name="" type="text" id="" value="{{$medicine_company_infos_id->company_name}}" placeholder="" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" readonly>				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Transaction Master</label>
                <input name="transaction_masters_id" type="text" id="transaction_masters_id" value="{{ old('transaction_masters_id',$medicinepurchase->transaction_masters_id??null) }}" placeholder="transaction_masters_id" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12"> 
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">VAT</label>
                <input name="vat" type="text" id="vat" value="0" placeholder="vat" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Discount</label>
                <input name="discount" type="text" id="discount" value="0" placeholder="discount" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="discount_type" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Discount Type</label>
                <select id="discount_type" name="discount_type" placeholder="" class="col-lg-7 col-md-7 col-xs-7 entry_panel_dropdown" >
                    <option value="">Select Type</option>
                    <option value="Tk" selected>TK</option>
                    <option value="%">%</option>
                </select>
			</div>
		</div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Base Price</label>
                <input name="total_price" type="text" id="total_price" value="{{ $total_price }}" placeholder="tp" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" readonly>				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Payable</label>
                <input name="payable" type="text" id="payable" value="{{ $total_price }}" placeholder="payable" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" readonly>				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Dues</label>
                <input name="dues" type="text" id="dues" value="" placeholder="dues" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" readonly>				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="pay" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Pay</label>
                <input name="pay" type="text" id="pay" value="" placeholder="Pay" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="col-lg-12 entry_panel_body">
                <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
            </div>
        </div>
    </form>

@section('scripts')
    <!-- Calculation -->
    <script>
        $("#delivery_date").datepicker({ dateFormat: 'yy-mm-dd' });
        $(document).ready(function(){
            let totPri = $("#total_price").val();
            let dis = 0;
            let vat = 0;
            $("#dues").attr("value", $("#payable").val());

            function disvat(){
                let disType = $("#discount_type").val();
                
                if (disType=="Tk"){
                    dis = $("#discount").val();
                    vat = totPri * $("#vat").val()/100;
                    $("#payable").attr("value", (totPri - dis + vat).toFixed(2));
                    $("#dues").attr("value", $("#payable").val());
                    
                } else if (disType=="%"){
                    dis = totPri * $("#discount").val()/100;
                    vat = totPri * $("#vat").val()/100;
                    $("#payable").attr("value", (totPri - dis + vat).toFixed(2));
                    $("#dues").attr("value", $("#payable").val());
                };
            };

            $("#discount_type").change(disvat);
            $("#discount").keyup(disvat);
            $("#vat").keyup(disvat);

            function dues(){
                let diff = $("#payable").val() - $("#pay").val();
                $("#dues").attr("value", diff.toFixed(2));
            }

            $("#pay").change(dues);
            $("#pay").keyup(dues);
        });
    </script>
@stop