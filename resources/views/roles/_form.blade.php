@csrf
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Role</label>
            <input name="name" type="text" id="name" value="{{ old('name',$role->name??null) }}" placeholder="Role" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="modal-body" style="padding: 0px;">
        <div class="col-lg-12 entry_panel_body ">
            <input type="hidden" class="form-control "  id="display_name" name="display_name" placeholder="Display Name" value="web" style="width: 100%; margin-left: 5px; margin-top: 10px; margin-bottom: 10px;" required/>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="col-lg-12 entry_panel_body">
            <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save">
        </div>
    </div>