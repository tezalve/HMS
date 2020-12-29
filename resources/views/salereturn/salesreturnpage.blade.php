<!-- salesreturnpage -->
@extends('layouts.master')
@section ('includes')
<style type="text/css">
table thead{
  background-color: #DBDCDD;
  color:#000000;
}
/*input {
  border: none;
}*/
table.dataTable tbody td {
    padding: 3px 10px;
}
</style>




<!-- ============================================ -->

<script>

$(document).ready(function() {

      invoicetable = $('#invoicetable').DataTable( {  
        "ordering":   false,
        "info":       false,
        "searching":  false,
        "paging":     false,
        "scrollY":    "300px",

        "columnDefs": [{
          "targets": [ 4,5 ],
          "visible": false,
        }],


            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {

                    return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                    i : 0;
                    };

                    total = api
                          .column(2)
                          .data()
                          .reduce( function (a, b) {
                          return intVal(a) + intVal(b);
                    },0);

                    less_amount = api
                          .column(5)
                          .data()
                          .reduce( function (a, b) {
                          return intVal(a) + intVal(b);
                    },0);
                    $('#lessamt').val(less_amount);      
                    $('#subtotal').val(total);
                    $('#netreturn').val(total-less_amount)  

                    if (total >(parseInt($('#dues').val())+less_amount)){
                      $('#returnamount').val(total - (parseInt($('#dues').val())+less_amount));
                    } else {
                      $('#returnamount').val(0);
                    }

                   $( api.column( 3 ).footer() ).html(total);
                
            }
      });
      


      $('#invoicetable tbody').on( 'click', '#button', function () {
          invoicetable.row (
            $(this).parents('tr')).remove().draw();
      });

});

</script>





<script>
$(function() {
  $( "#returndate" ).datepicker({
    changeMonth: true,
    changeYear: true
  });
});

function  stringtohtml(html) {
    var el = document.createElement('div');
    el.innerHTML = html;
    return el.childNodes[0];
}



function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}


function IsNumeric(input) {
  return (input - 0) == input && input.length > 0;
}

function IsNumeric(input){
  var RE = /^-{0,1}\d*\.{0,1}\d+$/;
  return (RE.test(input));
}


</script>

<script>
    @if(Session::has('message'))
      // var json  = JSON.parse('{{Session::get('message')}}');
      // window.open('{{URL::to('/')}}/invoice/'+json.invoiceid, '_blank');
    @endif
</script>

@stop

@section('content')



<!-- <legend>Invoice</legend> -->
<legend style="background: coral;">Invoice Return</legend>
<form action="{{ route('invoicereturns.store') }}" onkeypress="return event.keyCode != 13;" id="top-entrypanel-validation">

	<input type="hidden" id="consultantbyid"  name="consultantbyid" value="{{$invoicedata[0]->doctors_id}}">
	<input type="hidden" id="referencebyid"   name="referencebyid" value="{{$invoicedata[0]->reference_doctor_id}}">
  <input type="hidden" id="invoiceid"       name="invoiceid" value="{{$invoicedata[0]->id}}">
  <input type="hidden" id="patientid"       name="patientid" value="{{$invoicedata[0]->patientid}}">

    <div class="col-lg-6 col-md-6 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Invoice No</label>
        <input type="text" id="invoice_no" name="invoice_no" placeholder="invoice no.." readonly class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="{{ $invoicedata[0]->invoice_no }}">
      </div>
    </div>  


    <div class="col-lg-6 col-md-6 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Return Date</label>
        <input type="text" id="returndate" name="returndate" placeholder="" readonly class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" data-date-format="DD/MM/YY" value="{{ date('d/m/Y') }}">
      </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Patient Name</label>
        <input type="text" id="patentname" name="patentname" placeholder="Patient Name.." readonly class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="{{ $invoicedata[0]->patientname }}">
          @if ($errors->has('patientid'))
            {{$errors->first ('patientid') }} <br>
          @endif        
      </div>
    </div>


    <div class="col-lg-6 col-md-6 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Consultant by</label>
        <input type="text" id="consultantby" name="consultantby" placeholder="Consultant by.." readonly class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="{{ $invoicedata[0]->consultant_name }}">
          @if ($errors->has('consultantbyid'))
            {{$errors->first ('consultantbyid') }} <br>
          @endif                
      </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Reference by</label>
        <input type="text" id="referenceby" name="referenceby" placeholder="Reference by.." readonly class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="{{ $invoicedata[0]->referred_by_doctors }}">
          @if ($errors->has('referencebyid'))
            {{$errors->first ('referencebyid') }} <br>
          @endif          
      </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Remarks</label>
        <input type="text" id="remarks" name="remarks" placeholder="Remarks.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" value="{{ old('remarks',$invoicedata[0]->remarks??null) }}">
          @if ($errors->has('remarks'))
            {{$errors->first ('remarks') }} <br>
          @endif          
      </div>
    </div>



  <div class="col-lg-8">
      <table id="invoicetable" class="stripe row-border order-column" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th style="width:55%;">Description</th>
                  <th style="width:10%;">Charge</th>
                  <th style="width:10%;">Total</th>
                  <th style="width:10%;">Delete</th>
              </tr>
          </thead>                 
          <tfoot>
              <tr>
                  <th colspan="3" style="text-align:right; font-size: x-large;">Sub Total:</th>
                  <th style="font-size: x-large;"></th>
              </tr>
          </tfoot>
          <tbody>
	          @foreach ($invoicedata as $investigation)
	            <tr>
	            <td>{{$investigation->investigation_name}}</td>
	            <td>{{$investigation->price}}</td>
	            <td>{{$investigation->price}}</td>
	            <!-- <td><input type="checkbox"></td> -->
              <td><button type="button"  id="button"           class="btn btn-sm button btn-danger pull-right">Delete</button>
                  <input  type="hidden"  id="investigation_id" name="investigation_id[]" value="{{$investigation->investigation_id}}">
                  <input  type="hidden"  id="refferal_amount"  name="refferal_amount[]"  value="{{$investigation->refferal_amount}}">
                  <input  type="hidden"  id="less_amount"      name="less_amount[]"      value="{{$investigation->less_amount}}">
              </td>
	            <td>{{$investigation->price}}</td>
              <td>{{$investigation->less_amount}}</td>
	            </tr>
	          @endforeach                  	
          </tbody>
      </table>
  </div>
  

  <div class="col-lg-4">	
    <div class="col-lg-12 col-md-12 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Total Return</label>
        <input type="text" id="subtotal" name="subtotal" placeholder="Total Return.." readonly class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" >
      </div>
    </div>        

    <div class="col-lg-12 col-md-12 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Less Amount</label>
        <input type="text" id="lessamt" name="lessamt" placeholder="Less Amount.." readonly class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
      </div>
    </div>

    <div class="col-lg-12 col-md-12 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Net Return</label>
        <input type="text" id="netreturn" name="netreturn" placeholder="Net Return.." readonly class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
      </div>
    </div>


    <div class="col-lg-12 col-md-12 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Advance Amount</label>
        <input type="text" id="advance" name="advance" placeholder="Advance Amount.." readonly class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" value="{{ $invoicedata[0]->advance }}">
      </div>
    </div>


    <div class="col-lg-12 col-md-12 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Due Amount</label>
        <input type="text" id="dues" name="dues" placeholder="Dues.." readonly class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" value="{{$invoicedata[0]->due}}">
      </div>
    </div> 




    <div class="col-lg-12 col-md-12 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Refund Amount</label>
        <input type="text" id="returnamount" name="returnamount" placeholder="Refund Amount.." readonly class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
      </div>
    </div>

    <div class="col-lg-12 col-md-12 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
          <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-7 col-md-7 col-xs-7 btn btn-save btn-sm button button-save pull-right" style="background: rgb(5, 142, 27); color: aliceblue;" >
      </div>
    </div> 
  </div>  

</form>

@stop

@section('scripts')
  <script>
    $(function () {
    $("#top-entrypanel-validation").validate({
      rules: {
          patentname:   "required",
          consultantby: "required",
          consultantby: "required",
          subtotal: 	"required",
          referenceby: {
            required: true
          },
          advance: {
            required: true,
            number: true,
            min:0
          },
          dues: {
            required: true,
            number: true,
            min:0            
          },
          subtotal: {
            required: true,
            number: true
          },
      },
   
      tooltip_options: {
              patentname: {trigger:'focus'},
          },
      messages: {
        patentname: "Please enter paten tname",
        consultantby: {
          required: "Please enter a consultant by",
        },
        referenceby: {
          required: "Please enter a consultant by",
        },        
        subtotal: {
          required: "Please add investigation",
        },        
      }
      
    });      
    });
  </script>

@stop