@extends('layouts.master')
@section ('includes')

    <script>
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
    <legend style="background: coral;">New Clinical Chart Entry</legend>

    <form action="{{ route('clinicalcharts.store') }}" method='POST' id="createnewclinicalchart">
        @php $form_type ='create' @endphp
        @include('clinicalcharts/_form')
    </form>
@stop


@section('scripts')
    <script type="text/javascript">
        // for department
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
                    // type: "POST",
                    url: "{{URL::to('/')}}/departments/create",
                    data : {_token: '{{csrf_token()}}'},
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
                    // type: "POST",
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

        // for unit

        $( "#unitform" ).submit(function( event ) {
        // Stop form from submitting normally
            event.preventDefault();
            // Get some values from elements on the page:
            var $form   = $( this ),
            unitdesc  	= $form.find( "input[name='addunit']" ).val(),
            // type        = $form.find( "select[name='departmentlist']" ).val(),
            url         = $form.attr( "action" ); 
            var posting = $.post( url, {"new_addunit": unitdesc} );
            // Put the results in a div
            posting.done(function( data ) {
                $('#unitform').trigger("reset");
                $('#addUnit').modal('hide');

                //Reload the options of dropdown list using ajax.

                $.ajax({
                    // type: "POST",
                    url: "{{URL::to('/')}}/unitinfos/create",
                    dataType: "json",
                    success: function(data){
                        $('#unit').empty();
                        var opts = data;
                        // Use jQuery's each to iterate over the opts value
                        $('#unit').append('<option value="">Select</option>');
                        $.each(opts, function(i, d) {
                        // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                        $('#unit').append('<option value="' + d.id + '">' + d.description + '</option>');
                        });
                    }
                })

            });
        });
    </script>

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
            $("#createnewclinicalchart").validate({
                rules: {
                    investigationname: "required",
                    investigationname: {
                        required: true,
                    },
                    chargeparunit: {
                        required: true,
                        number: true
                    },
                    department: {
                        required: true
                    },
                    subdepartment: {
                        required: true
                    },
                    unit: {
                        required: true
                    },
                },
                tooltip_options: {
                    investigationname: {trigger:'focus'},
                },
                messages: {
                    investigationname: "Please enter Investigation name",
                    department: {
                        required: "Please select Department",
                    },
                    subdepartment: {
                        required: "Please select Sub Department",
                    },
                    unit: {
                        required: "Please select Unit",
                    },				
                }
                
            });
        });
    </script>
@stop