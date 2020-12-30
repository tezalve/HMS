
@csrf
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <!-- <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Investigation Name</label> -->
            <label for="Investigation Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Investigation Name</label>
            <input name="investigationname" type="text" id="investigationname" placeholder="Investigation Name" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" value="{{old('investigationname', $investigation->name??null)}}">				
        </div>
    </div>		

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Price" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Price</label>
            <input name="price" type="text" id="price" placeholder="Price" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" value="{{old('price', $investigation->price??null)}}">
        </div>
    </div>	

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Refferal Fee" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Refferal Fee</label>
            <input name="refferal_fee" type="number" id="refferal_fee" placeholder="20" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" value="{{old('refferal_fee', $investigation->refferal_fee??null)}}">			
        </div>
    </div>	

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Refferal Type" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Refferal Type</label>
            <select id="refferal_type" name="refferal_type" placeholder="" class="col-lg-7 entry_panel_dropdown">
                @if ($form_type == 'edit'){
                    @if ($investigation->refferal_type == '0') {
                        <option value="0" selected>%</option>
                        <option value="1">Tk</option>
                    } @else {
                        <option value="0">%</option>
                        <option value="1" selected>Tk</option>
                    }
                    @endif
                } @else {
                    <option value="0">%</option>
                    <option value="1">Tk</option>
                }
                @endif
            </select>
        </div>
    </div>	

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Department" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Department</label>
            <select id="department" name="department" placeholder="" class="col-lg-7 entry_panel_dropdown">
                @if ($form_type == 'edit'){
                    @foreach ($departments as $department)
                    @if ($department->id==$investigation->department_id) {
                        <option value="{{$department->id}}" selected>{{$department->departmentname}}</option>
                    }
                    @else
                        <option value="{{$department->id}}">{{$department->departmentname}}</option>
                    @endif	
                    @endforeach
                } @else {
                    @foreach ($departments as $department)
                    <option value="{{$department->id}}">{{$department->departmentname}}</option>
                    @endforeach
                }
                @endif
            </select>
        </div>
    </div>	


    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Module Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Sub Department</label>
            <select id="subdepartment" name="subdepartment" placeholder="" class="col-lg-7 entry_panel_dropdown">
                @if ($form_type == 'edit'){
                    @foreach ($subdepartment as $keys)
                    @if ($keys->id==$investigation->sub_department) {
                        <option value="{{$keys->id}}" selected>{{$keys->description}}</option>
                    }
                    @else
                        <option value="{{$keys->id}}">{{$keys->description}}</option>
                    @endif	
                    @endforeach
                } @else {
                    @foreach ($subdepartment as $keys)
                    <option value="{{$keys->id}}">{{$keys->description}}</option>
                    @endforeach
                }
                @endif
            </select>
        </div>
    </div>	

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="col-lg-12 entry_panel_body">
            <input type="submit" id="submit" name="submit" value="Update" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
        </div>
    </div>
</form>

@if ($form_type == 'create')
    <div class="modal fade" id="addDepartment" tabindex="-1" role="dialog" aria-labelledby="catAddLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 400px;">
            <div class="modal-content">
                <form action="{{route('departments.store')}}" method="POST" id="departmentForm">
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
                                        <option value="1">Lab</option>
                                        <option value="2">Imaging</option>
                                    </select>      				
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-12 entry_panel_body">
                            <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                                        @foreach ($departments as $department)
                                            <option value={{$department->id}}>{{$department->departmentname}}</option>
                                        @endforeach
                                    </select>      				
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-12 entry_panel_body">
                            <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif