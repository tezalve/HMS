@csrf
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Investigation Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Investigation Name</label>
            <input name="investigationname" type="text" id="investigationname" placeholder="Investigation Name.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" value="{{ old('investigationname',$clinicalchartdata->name??null) }}">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="department" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Department</label>
            <select id="department" name="department" placeholder="" class="col-lg-6 entry_panel_dropdown"value="">
                <option value="">Select Value</option>
                @foreach ($department as $values)
                <option value="{{$values->id}}">{{$values->description}}</option>
                @endforeach
            </select>
            <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#addDepartment">... </button></td>					
        </div>
    </div>	

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="subdepartment" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Sub Department</label>
            <select id="subdepartment" name="subdepartment" placeholder="" class="col-lg-6 entry_panel_dropdown">
                <option value="">Select Value</option>
            </select>
            <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#subaddDepartment">... </button></td>					
        </div>
    </div>	

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="chargeparunit" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Charge Par Unit</label>
            <input name="chargeparunit" type="text" id="chargeparunit" placeholder="Charge Par Unit.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" value="{{ old('chargeparunit',$clinicalchartdata->price??null) }}">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="unit" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Unit</label>
            <select id="unit" name="unit" placeholder="" class="col-lg-6 entry_panel_dropdown">
                <option value="">Select Value</option>
                @foreach ($unitinfo as $keys)
                <option value={{$keys->id}}>{{$keys->description}}</option>
                @endforeach	        		        	
            </select>
            <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#addUnit">... </button></td>					
        </div>
    </div>	

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="editstatus" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Edit Status</label>
            <select id="editstatus" name="editstatus" placeholder="" class="col-lg-7 entry_panel_dropdown">
                <option value="1">True</option>
                <option value="2">False</option>
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="doctorestatus" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Doctore Status</label>
            <select id="doctorestatus" name="doctorestatus" placeholder="" class="col-lg-7 entry_panel_dropdown">
                <option value="1">True</option>
                <option value="2">False</option>
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="col-lg-12 entry_panel_body">
            <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
        </div>
    </div>
</form>

@if ($form_type == 'create')

    <!-- for sub Detertment -->

    <div class="modal fade" id="addDepartment" tabindex="-1" role="dialog" aria-labelledby="catAddLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 400px;">
            <div class="modal-content">
                <form action="{{ route('departments.store') }}" method="POST" id="departmentForm">
                @csrf
                    <div class="modal-header" style="background: coral; padding: 10px;">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="catAddLabel">Add New Department</h4>
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>
                                    <label for="Department" class="col-lg-12 col-md-12 col-xs-12 entry_panel_label" style="margin-top: 2px;">Department</label>
                                </td>
                                <td>
                                    <input name="new_department" type="text" id="new_department" placeholder="Department Name" class="col-lg-12 col-md-12 col-xs-12 entry_panel_input">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="Sub Department" class="col-lg-12 col-md-12 col-xs-12 entry_panel_label" style="margin-top: 2px;">Investigation Type</label>
                                </td>
                                <td>
                                    <select id="investigationType" name="investigationType" placeholder="" class="col-lg-12 col-md-12 col-xs-12 entry_panel_dropdown">	
                                        <option value="3">Clinical Chart</option>
                                    </select>      				
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="modal-footer">
                        
                        <button type="button" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" name="category_save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- for sub Detertment -->

    <div class="modal fade" id="subaddDepartment" tabindex="-1" role="dialog" aria-labelledby="catAddLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 600px;">
            <div class="modal-content">

                <form action="{{ route('subdepartments.store') }}" method="POST" id="subdepartmentForm">
                @csrf
                    <div class="modal-header" style="background: coral; padding: 10px;">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="catAddLabel">Add New Sub Department</h4>
                    </div>
                    <div class="modal-body">
                        <table style="width: 500px;">
                            <tr>
                                <td>
                                    <label for="Department" class="col-lg-12 col-md-12 col-xs-12 entry_panel_label" style="margin-top: 2px;">Sub Department</label>
                                </td>
                                <td>
                                    <input name="new_sub_department" type="text" id="new_sub_department" placeholder="Sub Department Name" class="col-lg-12 col-md-12 col-xs-12 entry_panel_input">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="Sub Department" class="col-lg-12 col-md-12 col-xs-12 entry_panel_label" style="margin-top: 2px;">Department</label>
                                </td>
                                <td>
                                    <select id="departmentlist" name="departmentlist" placeholder="" class="col-lg-12 col-md-12 col-xs-12 entry_panel_dropdown">	
                                        @foreach ($department as $department)
                                            <option value="{{$department->id}}"->{{$department->departmentname}}</option>
                                        @endforeach
                                    </select>      				
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" name="category_save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- for unit -->

    <div class="modal fade" id="addUnit" tabindex="-1" role="dialog" aria-labelledby="catAddLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 400px;">
            <div class="modal-content">

                <form action="{{ route('unitinfos.store') }}" method="POST" id="unitform">
                @csrf
                    <div class="modal-header" style="background: coral; padding: 10px;">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="catAddLabel">Add New Unit</h4>
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>
                                    <label for="addunit" class="col-lg-12 col-md-12 col-xs-12 entry_panel_label" style="margin-top: 2px;">Unit Name</label>
                                </td>
                                <td>
                                    <input name="addunit" type="text" id="addunit" placeholder="Unit Name" class="col-lg-12 col-md-12 col-xs-12 entry_panel_input">
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" name="category_save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif