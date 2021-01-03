@csrf
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Group Name</label>
            <input name="customer_type_name" type="text" id="customer_type_name" value="{{ old('customer_type_name',$customertype->customer_type_name??null) }}" placeholder="Customer Type Name" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="col-lg-12 entry_panel_body">
            <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
        </div>
    </div>