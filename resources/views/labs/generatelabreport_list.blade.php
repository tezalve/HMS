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

		"ajax": "{{URL::to('/')}}/labreports/create",
		"columns": [

			{ "data": "invoice_no" },
			{ "data": "patient_name" },
			{ "data": "investigation_name" },
			{ "data": "Link",
				  "mRender": function (data, type, full) {
				    return '<a id="order" class="btn btn-sm button btn-primary" href="{{URL::to('/')}}/labreports/'+full.invid_icode+'/edit/" style="text-decoration: none; color: white;">Generate Report</a>';
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

	<legend>Generate Lab Report</legend>

	<form action="{{ route('duecollections.store') }}" id="createpatient" method="POST">
	@csrf
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