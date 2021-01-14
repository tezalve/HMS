    @csrf
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">PO Number</label>
                <select id="medicine_purchase_orders_id" name="medicine_purchase_orders_id" placeholder="" class="col-lg-7 entry_panel_dropdown">
                <option value="">Select Value</option>
                    @foreach ($medicine_purchase_orders_id as $medicine_purchase_orders_id)
                            @if (old('medicine_purchase_orders_id')==$medicine_purchase_orders_id->id)
                                <option value="{{$medicine_purchase_orders_id->id}}" selected>{{ $medicine_purchase_orders_id->po_number }}</option>
                            @else
                                <option value="{{$medicine_purchase_orders_id->id}}" >{{ $medicine_purchase_orders_id->po_number }}</option>
                            @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12 hidden">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" style="height: 40px;" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Delivery Date</label>
                <input name="delivery_date" type="date" id="delivery_date" value="<?= date('Y-m-d'); ?>" placeholder="delivery_date" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
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
                    <option value="cash">Cash</option>
                    <option value="bkash">Bkash</option>
                    <option value="card">Card</option>
                    <option value="payorder">Pay Order</option>
                    <option value="check">Check</option>
                </select>
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
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Bonus Quantity</label>
                <input name="transaction_masters_id" type="text" id="transaction_masters_id" value="{{ old('transaction_masters_id',$medicinepurchase->transaction_masters_id??null) }}" placeholder="transaction_masters_id" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
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
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">quantity</label>
                <input name="quantity" type="text" id="quantity" value="{{ old('quantity',$medicinepurchase->quantity??null) }}" placeholder="quantity" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">mrp</label>
                <input name="mrp" type="text" id="mrp" value="{{ old('mrp',$medicinepurchase->mrp??null) }}" placeholder="mrp" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">tp</label>
                <input name="tp" type="text" id="tp" value="{{ old('tp',$medicinepurchase->tp??null) }}" placeholder="tp" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">vat</label>
                <input name="vat" type="text" id="vat" value="{{ old('vat',$medicinepurchase->vat??null) }}" placeholder="vat" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">discount</label>
                <input name="discount" type="text" id="discount" value="{{ old('discount',$medicinepurchase->discount??null) }}" placeholder="discount" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">discount_type</label>
                <input name="discount_type" type="text" id="discount_type" value="{{ old('discount_type',$medicinepurchase->discount_type??null) }}" placeholder="discount_type" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Note</label>
                <input name="bonus_quantity" type="text" id="bonus_quantity" value="{{ old('bonus_quantity',$medicinepurchase->bonus_quantity??null) }}" placeholder="bonus_quantity" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Bonus Unit</label>			
                <select id="medicine_units_id_bonus" name="medicine_units_id_bonus" placeholder="" class="col-lg-6 entry_panel_dropdown">
                <option value="">Select Value</option>	
                    @foreach ($medicine_units_id_bonus as $medicine_units_id_bonus)
                            @if (old('medicine_units_id_bonus')==$medicine_units_id_bonus->id)
                                <option value="{{$medicine_units_id_bonus->id}}" selected>{{ $medicine_units_id_bonus->unit_name }}</option>
                            @else
                                <option value="{{$medicine_units_id_bonus->id}}" >{{ $medicine_units_id_bonus->unit_name }}</option>
                            @endif
                    @endforeach
                </select>
                <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#medicine_units_id_bonusModal">... </button></td>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="col-lg-12 entry_panel_body">
                <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
            </div>
        </div>
    </form>

