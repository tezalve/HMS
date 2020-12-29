@extends('layouts.master')
@section ('includes')

<script type="text/javascript">
$(function() {
  $( "#invoicedate" ).datepicker({
    changeMonth: true,
    changeYear: true
  });
});

	$(document).ready(function() {
		var table = $('#invoicelist').dataTable({
			scrollCollapse: false,
			paging:         true,
			searching:      true,
			ordering:       false,
			bInfo:          false,
			info: 			false,

				"ajax": "{{URL::to('/')}}/invoicelists/create",
				"columns": [

					{ "data": "invoice_no" },
					{ "data": "invoicedate" },
					{ "data": "patientname"},
					{ "data": "sales_amount" },
					{ "data": "less_amount" },
					{ "data": "recieved_amount" },
					{ "data": "return_amount" },
					{ "data": "refund_amount" },
					{ "data": "due" },
					{ "data": "Link",
						  "mRender": function (data, type, full) {
						    return '<a id="order" class="btn btn-sm button btn-primary active" target="_blank" href="{{URL::to('/')}}/duecollections/'+full.id+'/edit/" >Receive</a>';
						  }
					},		
					{ "data": "Link",
						  "mRender": function (data, type, full) {
						    return '<a id="order" class="btn btn-sm button btn-primary active" target="_blank" href="{{URL::to('/')}}/invoices/'+full.id+'/" style="text-decoration: none; color: white;">Print</a>';
						  }
					},
					{ "data": "Link",
						  "mRender": function (data, type, full) {
						    return '<a id="order" class="btn btn-sm button btn-primary" style="background-color: maroon; border-color: maroon;" href="{{URL::to('/')}}/invoices/'+full.id+'/edit/" style="text-decoration: none; color: white;">Return</a>';
						  }
					}
					// { "data": "Link",
					// 	  "mRender": function (data, type, full) {
					// 	    return '<button type="button" id="order" class="btn btn-sm btn-danger"> <a href="{{URL::to('/')}}/invoice/'+full.id+'/edit" style="text-decoration: none; color: white;">Delete</a></button>';
					// 	  }
					// }

		        ],
		        "order": [[1, 'asc']]


		});
	});
</script>

<script>
$(document).ready(function(){
	$("#invoicedate").change(function(){
		
		// var senddata = '&invoicedate='+$("#invoicedate").val();
		var senddata = '&invoicedate='+$("#invoicedate").val()+'&invoicetype='+$('input[type=radio][name=options]:checked').attr('id');
		// value = $('input[type=radio][name=options]:checked').attr('id')

		// console.log(senddata);

		$.ajax({
			type: 		'POST', 
			url :   	"{{URL::to('/')}}/invoicelistswithdate",
			data :  	senddata, 
			dataType: 	'json',
			success: function(data) {

				if (data!=""){
					var dataSet = data;
					table = $('#invoicelist').dataTable({
						destroy: 		true,
						scrollCollapse: false,
						paging:         true,
						searching:      true,
						ordering:       false,
						bInfo:          false,
						info: 			false,
					
				    	"data": 		dataSet,
	    				"columns": [
							{ "data": "invoice_no" },
							{ "data": "invoicedate" },
							{ "data": "patientname"},
							{ "data": "sales_amount" },
							{ "data": "less_amount" },
							{ "data": "recieved_amount" },
							{ "data": "return_amount" },
							{ "data": "refund_amount" },
							{ "data": "due" },
							{ "data": "Link",
								  "mRender": function (data, type, full) {
								    return '<button type="button" id="order" class="btn btn-sm button btn-primary active"> <a target="_blank" href="{{URL::to('/')}}/duecollection/'+full.id+'/edit" style="text-decoration: none; color: white;">Receive</a></button>';
								  }
							},												
							{ "data": "Link",
								  "mRender": function (data, type, full) {
								    return '<button type="button" id="order" class="btn btn-sm button btn-primary"> <a target="_blank" href="{{URL::to('/')}}/invoice/'+full.id+'" style="text-decoration: none; color: white;">Print</a></button>';
								  }
							},
							{ "data": "Link",
								  "mRender": function (data, type, full) {
								    return '<button type="button" id="order" class="btn btn-sm button btn-warning" style="background-color: maroon; border-color: maroon;"><a href="{{URL::to('/')}}/invoice/'+full.id+'/edit" style="text-decoration: none; color: white;">Return</a></button>';
								  }
							}
							// { "data": "Link",
							// 	  "mRender": function (data, type, full) {
							// 	    return '<button type="button" id="order" class="btn btn-danger"> <a href="{{URL::to('/')}}/labreport/'+full.id+'/edit" style="text-decoration: none; color: white;">Delete</a></button>';
							// 	  }
							// }
						],	
				        "order": [[1, 'asc']]
				    })

				} else {
					alert("Invalid Information");
					var table = $('#invoicelist').DataTable();
					 
					table
					    .clear()
					    .draw();
				}			

			}
		});	  
	});	
});
</script>
	
@stop
@section('content')

	<legend style="background: coral;">Invoice List</legend>

    <div class="col-lg-4 col-md-4 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Invoice Date</label>
        <input type="text" id="invoicedate" name="invoicedate" placeholder="" class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" readonly data-date-format="DD/MM/YY" value="{{ date('d/m/Y') }}">
      </div>
    </div>	


    <div class="col-lg-8 col-md-8 col-xs-12 btn-group" data-toggle="buttons">
      <div class="col-lg-12 entry_panel_body ">
		  <label class="btn btn-primary active" style="border-radius: 0px; margin-bottom: 10px; margin-left: 10px">
		    <input type="radio" name="options" id="allinvoice" autocomplete="off" checked>All Invoice
		  </label>        
		  <label class="btn btn-primary" style="border-radius: 0px; margin-bottom: 10px; margin-left: 10px">
		    <input type="radio" name="options" id="dueonly" autocomplete="off"> Due Only
		  </label>
		  <label class="btn btn-primary" style="border-radius: 0px; margin-bottom: 10px; margin-left: 10px">
		    <input type="radio" name="options" id="paidonly" autocomplete="off"> Paid Only
		  </label>		  
      </div>
    </div>	

    <div class="col-lg-12 col-md-12 col-xs-12">
	    <!-- <div class="col-lg-12 entry_panel_body "> -->
	    <div class="table-responsive">
			<table id="invoicelist" class="table" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th style="width: 8%;">Invoice No</th>
						<th style="width: 13%;">Invoice Date</th>
						<th style="width: 20%;">Patient Name</th>
						<th style="width: 10%;">Invoice Value</th>
						<th style="width: 6%;">Less</th>
						<th style="width: 8%;">Collection</th>
						<th style="width: 7%;">Return</th>
						<th style="width: 5%;">Refund</th>
						<th style="width: 8%;">Dues</th>
						<th style="width: 5%;">Receive</th>
						<th style="width: 5%;">Print</th>
						<th style="width: 5%;">Return</th>
						<!-- <th style="width: 5%;">Delete</th> -->
					</tr>
				</thead>

				<tbody>

				</tbody>
			</table>    
		</div>	
	</div>
@stop


