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
        @method('PUT')
        @php $form_type = 'edit' @endphp
        @include('investigations/_form')
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


