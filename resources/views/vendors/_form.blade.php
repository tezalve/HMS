@csrf
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">vendor Name</label>
            <input name="vendor_name" type="text" id="vendor_name" value="{{ old('vendor_name',$vendor->vendor_name??null) }}" placeholder="vendor Name" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Contact Number</label>
            <input name="contact_number" type="text" id="contact_number" value="{{ old('contact_number',$vendor->contact_number??null) }}" placeholder="Contact Number" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Email</label>
            <input name="email" type="text" id="email" value="{{ old('email',$vendor->email??null) }}" placeholder="email" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Address</label>
            <input name="address" type="text" id="address" value="{{ old('address',$vendor->address??null) }}" placeholder="address" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Contact Person</label>
            <input name="contact_person" type="text" id="contact_person" value="{{ old('contact_person',$vendor->contact_person??null) }}" placeholder="contact_person" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Medicine Unit</label>			
            <select id="vendor_type_id" name="vendor_type_id" placeholder="" class="col-lg-7 entry_panel_dropdown">
            <option value="">Select Value</option>	
                @foreach ($vendor_type_id as $vendor_type_id)
                        @if (old('vendor_type_id')==$vendor_type_id->id)
                            <option value={{$vendor_type_id->id}} {{selected}}>{{ $vendor_type_id->vendor_type_name }}</option>
                        @else
                            <option value={{$vendor_type_id->id}} >{{ $vendor_type_id->vendor_type_name }}</option>
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