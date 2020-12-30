<!-- editclinicalchart -->
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

	<legend style="background: coral;">Edit Clinical Chart Entry</legend>

	<form action="{{ route('clinicalcharts.update', $clinicalchartdata->id) }}" method="POST", id="">
		@method('PUT')

		@php $form_type ='edit' @endphp
        @include('clinicalcharts/_form')
	</form>

@stop


@section('scripts')
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