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
        @php $form_type = 'create' @endphp
        @include('investigations/_form')
    </form>

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


