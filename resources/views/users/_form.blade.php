@csrf
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Full Name</label>
            <input name="name" type="text" id="name" value="{{ old('name',$user->name??null) }}" placeholder="Full Name" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Email</label>
            <input name="email" type="email" id="email" value="{{ old('email',$user->email??null) }}" placeholder="Email" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

@if ($form_type != 'edit')
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Password</label>
            <input name="password" type="password" id="password" value="{{null}}" placeholder="password" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Confirm Password</label>
            <input name="confirmpassword" type="password" id="confirmpassword" value="{{null}}" placeholder="password" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>
@endif

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Phone No</label>
            <input name="phone_no" type="text" id="phone_no" value="{{ old('phone_no',$user->phone_no??null) }}" placeholder="phone_no" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Address</label>
            <input name="address" type="text" id="address" value="{{ old('address',$user->address??null) }}" placeholder="Email" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Medicine Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Select Role</label>			
            <select id="roles" name="role" placeholder="" class="col-lg-6 entry_panel_dropdown">
            <option value="">Select Value</option>
                @foreach ($roles as $roles)
                        @if (old('roles')==$roles->id)
                            <option value="{{$roles->id}}" selected>{{ $roles->name }}</option>
                        @else
                            <option value="{{$roles->id}}" >{{ $roles->name }}</option>
                        @endif
                @endforeach
            </select>
            <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#rolesModal">... </button></td>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="col-lg-12 entry_panel_body">
            <input type="submit" id="submit" name="submit" value="SUBMIT" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
        </div>
    </div>