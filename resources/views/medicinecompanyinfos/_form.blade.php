@csrf
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Company Name</label>
            <input name="company_name" type="text" id="company_name" value="{{ old('company_name',$medicinecompanyinfo->company_name??null) }}" placeholder="Company Name" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Address</label>
            <input name="address" type="text" id="address" value="{{ old('address',$medicinecompanyinfo->address??null) }}" placeholder="Address" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Contact Number</label>
            <input name="contact_number" type="text" id="contact_number" value="{{ old('contact_number',$medicinecompanyinfo->contact_number??null) }}" placeholder="Contact Number" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Contact Person</label>
            <input name="contact_person" type="text" id="contact_person" value="{{ old('contact_person',$medicinecompanyinfo->contact_person??null) }}" placeholder="Contact Person" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Default Discount</label>
            <input name="default_discount" type="number" id="default_discount" value="{{ old('default_discount',$medicinecompanyinfo->default_discount??null) }}" placeholder="Default Discuunt" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Default Vat</label>
            <input name="default_vat" type="number" id="default_vat" value="{{ old('default_vat',$medicinecompanyinfo->default_vat??null) }}" placeholder="Default Vat" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
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