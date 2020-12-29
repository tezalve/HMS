@extends('layouts.master')
@section ('includes')
	
	<!-- Validation end -->

	<script type="text/javascript" language="javascript" class="init">
		$(document).ready(function() {
		var table = $('#example').dataTable({
				scrollCollapse: false,
				searching:      true,
		        "ordering":   	false,
		        "info":       	false,
		        "searching":  	true,
		        // "paging":     false,
		        // "scrollY":    "300px"			
		});
			
			$('#name').keyup(function(){
				table.fnFilter( $(this).val() );
			})
		});


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

	<!-- <legend>Investigation Registration</legend> -->
	<!-- <legend style="background: coral; text-align: center;">Investigation Registration</legend> -->
	<legend style="background: coral;">Investigation Registration</legend>

    <form action="{{ route('investigations.store') }}" method="POST" id="createpatient">
    @csrf
    
		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Investigation Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Investigation Name</label>
				<input name="investigationname" type="text" id="investigationname" placeholder="Investigation Name" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
			</div>
		</div>		

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Price" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Price</label>
				<input name="price" type="text" id="price" placeholder="Price" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
			</div>
		</div>	

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Refferal Fee" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Refferal Fee</label>
				<input name="refferal_fee" type="number" id="refferal_fee" placeholder="20" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
			</div>
		</div>	

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Refferal Type" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Refferal Type</label>
				<select id="refferal_type" name="refferal_type" placeholder="" class="col-lg-7 entry_panel_dropdown">
					<option value="0">%</option>
					<option value="1">TK</option>
				</select>
			</div>
		</div>	

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Department" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Department</label>
				<select id="department" name="department" placeholder="" class="col-lg-6 entry_panel_dropdown">
				<option value="">Select Value</option>	
				@foreach ($departments as $department)
					<option value={{$department->id}}>{{$department->departmentname}}</option>
	        	@endforeach
				</select>
		        <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#addDepartment">... </button></td>					
			</div>
		</div>	

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
	            <label for="Sub Department" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Sub Department</label>
				<select id="subdepartment" name="subdepartment" placeholder="" class="col-lg-6 entry_panel_dropdown">
					<option value="">Select Value</option>
				</select>	            
		        <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#subaddDepartment">... </button></td>		
			</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="col-lg-12 entry_panel_body">
				<input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
			</div>
		</div>
    </form>

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

@stop
@section('scripts')

    <script type="text/javascript">
        $( "#departmentForm" ).submit(function( event ) {
        // Stop form from submitting normally
            event.preventDefault();
            // Get some values from elements on the page:
            var $form   = $( this ),
            department  = $form.find( "input[name='new_department']" ).val(),
            type        = $form.find( "select[name='investigationType']" ).val(),
            url         = $form.attr( "action" ); 
            var posting = $.post( url, {"new_department": department, "investigationType": type} );
            // Put the results in a div
            posting.done(function( data ) {
                $('#departmentForm').trigger("reset");
                $('#addDepartment').modal('hide');

                //Reload the options of dropdown list using ajax.

                $.ajax({
                    // type: "post",
                    url: "{{URL::to('/')}}/departments/create",
                    dataType: "json",
                    success: function(data){
                        $('#department').empty();
                        var opts = data;
                        // Use jQuery's each to iterate over the opts value
                        // $('#department').append('<option value="">Select</option>');
                        $.each(opts, function(i, d) {
                        // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                        $('#department').append('<option value="' + d.id + '">' + d.description + '</option>');
                        });
                    }
                })

            });
        });

// for sub department model

    $( "#subdepartmentForm" ).submit(function( event ) {
        // Stop form from submitting normally
        event.preventDefault();
        // Get some values from elements on the page:
        var $form   = $( this ),
        department  = $form.find( "input[name='new_sub_department']" ).val(),
        type        = $form.find( "select[name='departmentlist']" ).val(),
        url         = $form.attr( "action" ); 
        var posting = $.post( url, {"new_sub_department": department, "departmentlist": type} );
        // Put the results in a div
        posting.done(function( data ) {
            $('#subdepartmentForm').trigger("reset");
            $('#subaddDepartment').modal('hide');

            //Reload the options of dropdown list using ajax.
            $.ajax({
                // type: "GET",
                url: "{{URL::to('/')}}/subdepartments/create",
                dataType: "json",
                success: function(data){
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
    });
</script>

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
            $("#createpatient").validate({
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
                    department: {
                        required: true
                    },
                    subdepartment: {
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
                    department: {
                        required: "Please Select Department",
                    },
                    subdepartment: {
                        required: "Please Select Sub Department",
                    },								
                }
                
            });
    });
    </script>
    <script type="text/javascript"></script>	
@stop


