@extends('layouts.master')
@section ('includes')

<script type="text/javascript">

jQuery(document).ready(function($){
  	$('#department').change(function(){

		var departmentid     = document.getElementById('department').value;
		var senddata = '&department_id='+departmentid;
              $.ajax({
                  headers: {
                            'X-CSRF-TOKEN':'{{csrf_token()}}'
                  },
                  type: "POST",
                  url :   "{{URL::to('/')}}/subdeplist",
                  data :  senddata,
                  dataType: "json",
                  success: function(data){
                  	console.log(data);
                      $('#subdepartment').empty();
                      var opts = data;
                      // Use jQuery's each to iterate over the opts value
                      // $('#department').append('<option value="">Select</option>');
                      $.each(opts, function(i, d) {
                      // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                      $('#subdepartment').append('<option value="' + d.id + '">' + d.description + '</option>');
                      });
                  }
              })		
		});
	})              
</script>

@stop
@section('content')
	
	<legend style="background: coral;">Edit Investigation</legend>

    <form action="{{ route('investigations.update', $investigation->id)}}" method="POST" id="editinvestigation">
    @csrf
    @method('PUT')

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <!-- <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Investigation Name</label> -->
                <label for="Investigation Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Investigation Name</label>
                <input name="investigationname" type="text" id="investigationname" placeholder="Investigation Name" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" value="{{ $investigation->name }}">				
            </div>
        </div>		

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Price" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Price</label>
                <input name="price" type="text" id="price" placeholder="Price" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" value="{{ $investigation->price }}">
            </div>
        </div>	

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Refferal Fee" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Refferal Fee</label>
                <input name="refferal_fee" type="number" id="refferal_fee" placeholder="20" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" value="{{ $investigation->refferal_fee }}">			
            </div>
        </div>	

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Refferal Type" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Refferal Type</label>
                <select id="refferal_type" name="refferal_type" placeholder="" class="col-lg-7 entry_panel_dropdown">
                    @if ($investigation->refferal_type == '0') {
                        <option value="0" selected>%</option>
                        <option value="1">Tk</option>
                    } @else {
                        <option value="0">%</option>
                        <option value="1" selected>Tk</option>
                    }
                    @endif	
                </select>
            </div>
        </div>	

        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Department" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Department</label>
                <select id="department" name="department" placeholder="" class="col-lg-7 entry_panel_dropdown">
                    @foreach ($departments as $department)
                    @if ($department->id==$investigation->department_id) {
                        <option value={{$department->id}} selected>{{$department->departmentname}}</option>
                    }
                    @else
                        <option value={{$department->id}}->{{$department->departmentname}}</option>
                    @endif	
                    @endforeach
                </select>
            </div>
        </div>	


        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="col-lg-12 entry_panel_body ">
                <label for="Module Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Sub Department</label>
                <select id="subdepartment" name="subdepartment" placeholder="" class="col-lg-7 entry_panel_dropdown">
                    @foreach ($subdepartment as $keys)
                    @if ($keys->id==$investigation->sub_department) {
                        <option value={{$keys->id}} selected>{{$keys->description}}</option>
                    }
                    @else
                        <option value={{$keys->id}}>{{$keys->description}}</option>
                    @endif	
                    @endforeach
                </select>
            </div>
        </div>	

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-12 entry_panel_body">
                <input type="submit" id="submit" name="submit" value="Update" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
            </div>
        </div>
    </form>
@stop

@section('scripts')
<script src="/js/jquery-ui.js"></script>
<script>
$( "#tabs" ).tabs();
// Hover states on the static widgets
$( "#dialog-link, #icons li" ).hover(
	function() {
		$( this ).addClass( "ui-state-hover" );
	},
	function() {
		$( this ).removeClass( "ui-state-hover" );
	}
);
$(function () {
    // validate signup form on keyup and submit
		$("#editinvestigation").validate({
	  		rules: {
				investigationname: "required",
				investigationname: {
					required: true,
				},
				price: {
					required: true
				},
				refferal_fee: {
					required: true
				},
			},
			tooltip_options: {
           		investigationname: {trigger:'focus'},
        	},
			messages: {
				investigationname: "Please enter Investigation name",
				price: {
					required: "Please enter a price",
				},
				refferal_fee: {
					required: "Please enter refferal fee",
				},
			}
			
		});
});
</script>
<script type="text/javascript"></script>	
@stop


