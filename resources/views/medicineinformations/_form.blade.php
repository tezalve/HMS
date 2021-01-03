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
            <select id="medicine_generic_names_id" name="medicine_generic_names_id" placeholder="" class="col-lg-7 entry_panel_dropdown">
            <option value="">Select Value</option>	
                @foreach ($medicine_generic_names_id as $medicine_generic_names_id)
                        @if (old('medicine_generic_names_id')==$medicine_generic_names_id->id)
                            <option value={{$medicine_generic_names_id->id}} selected>{{ $medicine_generic_names_id->generic_name }}</option>
                        @else
                            <option value={{$medicine_generic_names_id->id}} >{{ $medicine_generic_names_id->generic_name }}</option>
                        @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Medicine Group</label>				
            <select id="medicine_groups_id" name="medicine_groups_id" placeholder="" class="col-lg-7 entry_panel_dropdown">
            <option value="">Select Value</option>	
                @foreach ($medicine_groups_id as $medicine_groups_id)
                        @if (old('medicine_groups_id')==$medicine_groups_id->id)
                            <option value={{$medicine_groups_id->id}} selected>{{ $medicine_groups_id->group_name }}</option>
                        @else
                            <option value={{$medicine_groups_id->id}} >{{ $medicine_groups_id->group_name }}</option>
                        @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Medicine Company Name</label>			
            <select id="medicine_company_infos_id" name="medicine_company_infos_id" placeholder="" class="col-lg-7 entry_panel_dropdown">
            <option value="">Select Value</option>	
                @foreach ($medicine_company_infos_id as $medicine_company_infos_id)
                        @if (old('medicine_company_infos_id')==$medicine_company_infos_id->id)
                            <option value={{$medicine_company_infos_id->id}} selected>{{ $medicine_company_infos_id->company_name }}</option>
                        @else
                            <option value={{$medicine_company_infos_id->id}} >{{ $medicine_company_infos_id->company_name }}</option>
                        @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Medicine Unit</label>			
            <select id="medicine_units_id" name="medicine_units_id" placeholder="" class="col-lg-7 entry_panel_dropdown">
            <option value="">Select Value</option>	
                @foreach ($medicine_units_id as $medicine_units_id)
                        @if (old('medicine_units_id')==$medicine_units_id->id)
                            <option value={{$medicine_units_id->id}} {{selected}}>{{ $medicine_units_id->unit_name }}</option>
                        @else
                            <option value={{$medicine_units_id->id}} >{{ $medicine_units_id->unit_name }}</option>
                        @endif
                @endforeach
            </select>
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