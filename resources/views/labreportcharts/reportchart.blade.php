@extends('layouts.master')
@section ('includes')

<style>



table thead{
  background-color: #525A6E;
  color:#FFFFFF;
}
input {
	border: none;
}

</style>
	<script type="text/javascript" language="javascript" src="/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="/js/jquery.validation.tooltip.js"></script>
	<script type="text/javascript" language="javascript" src="/js/jquery.validate.min.js"></script>

	
	<!-- Validation end -->
<script type="text/javascript">
	$(document).ready(function(){
	  var ac_config = {
	    source: "/auto/investigtion",
	    select: function(event, ui){
	      $("#description").val(ui.item.name);
	      $("#investigtion_id").val(ui.item.id);
	    },
	    minLength:1
	  };
	  $("#description").autocomplete(ac_config);
	});

$( document ).ready(function() {
        $('#investigtion_name').select2({
        placeholder: 'Enter a investigtion name',
            ajax: {
                dataType: 'json',
                url: "{{URL::to('/')}}/auto/investigtionnew",
                // url: "{{URL::to('/')}}/auto/patient",
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term
                    }
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data
                    };
                },
            }
        });
  });

    
</script>

	<script type="text/javascript" language="javascript" class="init">
		$(document).ready(function() {
				// $('#example').dataTable( {
			example = $('#example').DataTable( {	
  					"ordering": false,
  					"info": false,
  					"searching": false,
  					"paging": false,
					"scrollY": "280px"
					// "scrollCollapse": true
				} );

				$('#addRow').on( 'click', function () {
					// alert("Add");

					var parameter_name   = document.getElementById("parametername").value;
					var groupname   	 = document.getElementById("groupname").value;
					var aliasname   	 = document.getElementById("aliasname").value;
					var unitname   		 = document.getElementById("unitname").value;
					var normalvalue   	 = document.getElementById("normalvalue").value;
					var groupls   		 = document.getElementById("groupls").value;
					var slno   			 = document.getElementById("slno").value;
					var result_value 	 = document.getElementById("result_value").value;



				example.row.add([    // type text shorate hobe for the addition and deletion feature 
					'<input style="width:100%;"  type="text"   		id="parametername_grid"  		name="parametername_grid[]"  	readonly value="'+parameter_name+'">',
					'<input style="width:100%;"  type="text"   		id="aliasname_grid"   			name="aliasname_grid[]"   		readonly value="'+aliasname+'">',
					'<input style="width:100%;"  type="text"   		id="unitname_grid"     			name="unitname_grid[]"     		readonly value="'+unitname+'">',
					'<input style="width:100%;"  type="text"   		id="normalvalue_grid"      		name="normalvalue_grid[]"      	readonly value="'+normalvalue+'">',
					'<input style="width:100%;"  type="text"   		id="result_value_grid"      	name="result_value_grid[]"      readonly value="'+result_value+'">',
					'<input style="width:100%;"  type="text"   		id="groupname_grid"       	 	name="groupname_grid[]"		   	readonly value="'+groupname+'">',
					'<input style="width:100%;"  type="text"   		id="groupls_grid"      			name="groupls_grid[]"      		readonly value="'+groupls+'">',
					'<input style="width:100%;"  type="text"   		id="slno_grid"     	 			name="slno_grid[]"    	   		readonly value="'+slno+'">',
					'<button style="width:60px;" type="button" 		id="button"           			class="btn btn-sm button btn-danger pull-right">Delete</button>'+
					'<input                      type="hidden" 		id="per_unit_new"     			name="per_unit_new[]"     		value="'+slno+'">',

				// ], calculettotal(total_amount, totalamount, lessamt, vat_amt), refreshdata()).draw();					
				],refreshdata()).draw();					
				});
			
				$('#example tbody').on( 'click', '#button', function () {
						example.row (
							$(this).parents('tr')).remove().draw();
				});


			});	


	function refreshdata(){
		document.getElementById("parametername").value = "";
		document.getElementById("groupname").value = "";
		document.getElementById("aliasname").value = "";
		document.getElementById("unitname").value = "";
		document.getElementById("normalvalue").value = "";
		document.getElementById("groupls").value = "";
		document.getElementById("slno").value = "";
		document.getElementById("groupname").focus();
	}

$(document).ready( function (){
	$("#investigtion_name" ).change(function() {	

		  tablename  = "labreport";
		  columnname = "investigation_id";
		  condition  = document.getElementById("investigtion_name").value;

		  if (condition==''){
		  	alert("Invalid Investigation Name");
		  	document.getElementById("description").focus();
		  	return;
		  }

		  $.ajax({ 
		    type: 'POST', 
		    url: "<?php echo URL::to('/'); ?>/auto/isempty",
		    // data: {p:level1}, 

		    data: {tablename:tablename,columnname:columnname,condition:condition}, 
		    dataType: 'json',
		    success: function(getdata){ 
		    // console.log(getdata[1]);
		    	if (getdata[0]==true){
		    			var tables = $('#example').DataTable();
 						tables.clear().draw();
						Object.keys(getdata[1]).forEach(function(key) {
							// console.log(getdata[1][key].id);
							var parameter_name   = getdata[1][key].parameter;
							var groupname   	 = getdata[1][key].report_group;
							var aliasname   	 = getdata[1][key].alias_name;
							var unitname   		 = getdata[1][key].unit;
							var normalvalue   	 = getdata[1][key].normal_value;
							var result_value   	 = 0; //getdata[1][key].result_value;
							var groupls   		 = getdata[1][key].group_sl;
							var slno   			 = getdata[1][key].sl_no;

							example.row.add([    // type text shorate hobe for the addition and deletion feature 
								'<input style="width:100%;"  type="text"   		id="parametername_grid"  		name="parametername_grid[]"  	readonly value="'+parameter_name+'">',
								'<input style="width:100%;"  type="text"   		id="aliasname_grid"   			name="aliasname_grid[]"   		readonly value="'+aliasname+'">',
								'<input style="width:100%;"  type="text"   		id="unitname_grid"     			name="unitname_grid[]"     		readonly value="'+unitname+'">',
								'<input style="width:100%;"  type="text"   		id="normalvalue_grid"      		name="normalvalue_grid[]"      	readonly value="'+normalvalue+'">',
								'<input style="width:100%;"  type="text"   		id="result_value_grid"      	name="result_value_grid[]"       		 value="'+result_value+'">',
								'<input style="width:100%;"  type="text"   		id="groupname_grid"       	 	name="groupname_grid[]"		   	readonly value="'+groupname+'">',
								'<input style="width:100%;"  type="text"   		id="groupls_grid"      			name="groupls_grid[]"      		readonly value="'+groupls+'">',
								'<input style="width:100%;"  type="text"   		id="slno_grid"     	 			name="slno_grid[]"    	   		readonly value="'+slno+'">',
								'<button style="width:60px;" type="button" 		id="button"           			class="btn btn-sm button btn-danger pull-right">Delete</button>'+
								'<input                      type="hidden" 		id="per_unit_new"     			name="per_unit_new[]"     		value="'+slno+'">',
							]).draw();							
						});

					
		    	}else{
		    			var tables = $('#example').DataTable();
 						tables.clear().draw();		    		
		    	}	
		    } 
		  }); 		
	});
});
	</script>
@stop
@section('content')
	
    <form action="{{ route('labreportcharts.store') }}" id="createpatient" method="POST">
		<!-- <input type="hidden" id="investigtion_id" name="investigtion_id"> -->
		<div class="col-lg-12 col-md-12 col-xs-12">
			<div class="col-lg-6 entry_panel_body ">
		        <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label" style="padding: 3px;">Investigation Name</label>
		        <select id="investigtion_name" name="investigtion_name" placeholder="" class="col-lg-7 col-md-7 col-xs-7 entry_panel_dropdown" >
		        </select>				
			</div>
		</div>
		<!-- <legend></legend> -->
		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Report File Name</label>
			      <select id="reportfilename" name="reportfilename" placeholder="" class="col-lg-7 col-md-7 col-xs-7 entry_panel_dropdown" >
			          <option value="Hematology">Hematology</option>
			          <option value="Biochemistry">Biochemistry</option>
			          <option value="Pathology">Pathology</option>
			          <option value="Serology">Serology</option>
			          <option value="Microbiology">Microbiology</option>
			          <option value="Immunology">Immunology</option>
			          <option value="HematologyCBC">HematologyCBC</option>
			          <option value="USG">USG</option>
			          <option value="X-Ray">X-Ray</option>
			          <option value="Others">Others</option>
		          </select>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Group Name</label>
				<input type="text" id="groupname" name="groupname"  placeholder="Group Name.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Parameter Name</label>
				<input type="text" id="parametername" name="parametername"  placeholder="Parameter Name.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
			</div>
		</div>


		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Alias Name</label>
				<input type="text" id="aliasname" name="aliasname"  placeholder="Alias Name.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Unit Value</label>
				<input type="text" id="unitname" name="unitname"  placeholder="Unit Value.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
			</div>
		</div>		

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Normal Value</label>
				<input type="text" id="normalvalue" name="normalvalue"  placeholder="Normal Value.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Result Value</label>
				<input type="text" id="result_value" name="result_value"  placeholder="Result Value.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Group Sl</label>
				<input type="text" id="groupls" name="groupls"  placeholder="Group Sl.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="col-lg-12 entry_panel_body ">
				<label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Sl No</label>
				<input type="text" id="slno" name="slno" placeholder="Sl No.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
			</div>
		</div>	

		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="col-lg-12 entry_panel_body">
				<input type="button" id="addRow" name="addRow" value="ADD" class="col-lg-offset-9 col-lg-1 col-md-offset-9 col-md-1 col-sm-offset-9 col-sm-1 col-xs-offset-7 col-xs-2 btn btn-sm button btn-primary button-save pull-right">
			</div>
		</div>

		<legend></legend>
        
		<div class="col-lg-12 datatablescope ">
			<table id="example" class="stripe row-border order-column" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Parameter Name</th>
						<th>Alias Name</th>
						<th>Unit Value</th>
						<th>Normal Value</th>
						<th>Result</th>
						<th>Group Name</th>
						<th>Group Sl</th>
						<th>Sl No</th>
						<th>Delete</th>					
					</tr>
				</thead>                 
				<tbody>
					
				</tbody>
			</table>
		</div>


		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="col-lg-12 entry_panel_body">
				<input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-offset-9 col-lg-1 col-md-offset-9 col-md-1 col-sm-offset-9 col-sm-1 col-xs-offset-7 col-xs-2 btn btn-save btn-sm button button-save pull-right" style="background: rgb(5, 142, 27); color: aliceblue;">	</div>
		</div>

	</form>

@stop
@section('scripts')
@stop