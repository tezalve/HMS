@extends('layouts.master')
@section('content')
    <legend style="background: coral;">New Patient Registration</legend>

    <form action="{{ route('patients.store') }}" method="POST">
		@php $form_type ='create' @endphp
		@include('patients/_form')
	</form>
	@stop

@section('scripts')

	<script type="text/javascript">
		$( "#OccupationsForm" ).submit(function( event ) {
		// Stop form from submitting normally
			event.preventDefault();
			// Get some values from elements on the page:
			var $form   = $( this ),
			departments = $form.find( "input[name='occupationsdescription']" ).val(),
			url         = $form.attr( "action" ); 
			var posting = $.post( url, {new_occupationsdescription: departments} );

			// Put the results in a div
			posting.done(function( data ) {
				$('#OccupationsForm').trigger("reset");
				$('#occupationsmodel').modal('hide');

				//Reload the options of dropdown list using ajax.

				$.ajax({
					// type: "POST",
					url: "{{URL::to('/')}}/occupations/create",
					dataType: "json",
					success: function(data){
						$('#occupations').empty();
						var opts = data;
						// Use jQuery's each to iterate over the opts value
						$('#occupations').append('<option value="">Select</option>');
						$.each(opts, function(i, d) {
						// You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
						$('#occupations').append('<option value="' + d.id + '">' + d.description + '</option>');
						});
					}
				})

			});
		});

	</script>
@stop