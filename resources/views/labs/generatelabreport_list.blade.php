<!-- file name generatelabreport_list -->
@extends('layouts.master')
@section ('includes')

<style type="text/css">
table thead{
  background-color: #DBDCDD;
  color:#000000;
}
table.dataTable tbody td {
    padding: 3px 10px;
}
</style>


	<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
	var table = $('#example').dataTable({

      scrollY:        "480px",
      scrollX:        false,
      scrollCollapse: false,
      paging:         false,
      searching:      true,
      ordering:       false,
      bInfo:          false,

		"ajax": "{{URL::to('/')}}/labreport/create",
		"columns": [

			{ "data": "invoice_no" },
			{ "data": "patient_name" },
			{ "data": "investigation_name" },
			{ "data": "Link",
				  "mRender": function (data, type, full) {
				    return '<center><button type="button" id="order" class="btn btn-sm button btn-primary"> <a href="{{URL::to('/')}}/labreport/'+full.invid_icode+'/edit" style="text-decoration: none; color: white;">Generate Report</a></button></center>';
				  }
			}

        ],
        "order": [[1, 'asc']]
    });

	$('#name').keyup(function(){
      table.fnFilter( $(this).val() );
	})
	});
	</script>

@stop
@section('content')

	<legend>List Of Due Invoice</legend>

	<form action="duecollections.store" id="createpatient" method="POST">

		<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Invoice No</th>
				<th>Patient Name</th>
				<th>investigation Name</th>
				<th>Generate Report</th>
			</tr>
		</thead>

		<tbody>

		</tbody>
		</table>

	</form>

@stop



