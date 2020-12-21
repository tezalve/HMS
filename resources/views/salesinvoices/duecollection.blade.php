@extends('layouts.master')
@section ('includes')



<script>
	function less_calculation(a){
    calculation_less  = 0;
		doctorcommision 	= document.getElementById("doctor_commision").value;
		lessfrom 			    = document.getElementById("lessfrom").value;
		lesspc 			      = document.getElementById("lesspc").value;
    lesstype          = document.getElementById("lesstype").value;
    due_amount        = document.getElementById("due_amount").value;
    lessamount        = document.getElementById("lessamount").value;
    

    if (lesstype == 0){
      calculation_less = parseInt(lesspc);
    }else{
      calculation_less = (parseInt(due_amount)*parseInt(lesspc)/100);
    }

    if (IsNumeric(calculation_less)==false){
      calculation_less = 0;
    }

    // if (IsNumeric(document.getElementById("lesspc").value)==false){
    //   document.getElementById("lesspc").value = 0;
    // }

    document.getElementById("collection_amount").value  = 0;
    document.getElementById("lessamount").value         = calculation_less;

    // 1 for Both
    // 2 for Doctor
    if (lessfrom == 1){
      if (doctorcommision<(calculation_less/2)){
        alert("you can't give less more than both polacy");
        document.getElementById("lessamount").value = 0;
        document.getElementById("lesspc").value     = 0;        
        netreceivables();
        return;
      }
    }

    if (lessfrom == 2){
      if (doctorcommision<(calculation_less)){
        alert("you can't give less more than doctor polacy");
        document.getElementById("lessamount").value = 0;
        document.getElementById("lesspc").value     = 0;        
        netreceivables();
        return;
      }
    }
    netreceivables();

	}

function IsNumeric(input){
  var RE = /^-{0,1}\d*\.{0,1}\d+$/;
  return (RE.test(input));
}

function checkduecollection(a){
    netreceivables();
}  



function netreceivables(){
    due_amount        = document.getElementById("due_amount").value;
    lessamount        = document.getElementById("lessamount").value;
    collection        = document.getElementById("collection_amount").value;
    // collection        = document.getElementById("collection_amount").value;

    if (IsNumeric(lessamount)==false){
      lessamount = 0;
    }

    if (IsNumeric(collection)==false){
      collection = 0;
    }

    document.getElementById("netreceivable").value = (due_amount - lessamount - collection);

}

</script>
@stop


@section('content')
<legend>Due Collection</legend>
{{ Form::open(['route' => 'duecollection.store', 'id' => 'top-entrypanel-validation']) }}



  <input type="hidden" id="invoice_id"         name="invoice_id" 			  value="{{ $sqlduecollection[0]->id }}">
  <input type="hidden" id="patientid"          name="patientid"  			  value="{{ $sqlduecollection[0]->patientregistration_id }}">
  <input type="hidden" id="doctore_id"         name="doctore_id" 			  value="{{ $sqlduecollection[0]->doctors_id }}">
  <input type="hidden" id="doctor_commision"   name="doctor_commision" 	value="{{ $sqlduecollection[0]->doctor_commision }}">
  

	<div class="col-lg-8 col-md-8 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
			<label for="" class="col-lg-3 col-md-3 col-xs-3">Invoice No</label>
			<input name="invoice_no" type="text" class="col-lg-3 col-md-3 col-xs-3" id="invoice_no" readonly placeholder="Invoice No" value="{{ $sqlduecollection[0]->invoice_no }}" >        
			<label for="" class="col-lg-3 col-md-3 col-xs-3">Invoice Date</label>
			<input name="invoicedate" type="text" class="col-lg-3 col-md-3 col-xs-3" id="invoicedate" placeholder="Invoice Date" value="{{ $sqlduecollection[0]->date }}" readonly>
		</div>
	</div>  

	<div class="col-lg-8 col-md-8 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
			<label for="" class="col-lg-3 col-md-3 col-xs-3">Transaction Date</label>
			<input name="transactiondate" type="text" class="col-lg-3 col-md-3 col-xs-3" id="transactiondate" readonly placeholder="Invoice Date" value="{{ date('Y-m-d') }}">
		</div>
	</div>

	<div class="col-lg-8 col-md-8 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
			<label for="" class="col-lg-3 col-md-3 col-xs-3">Patient Name</label>
			<input name="patentname" type="text" class="col-lg-9 col-md-9 col-xs-9" id="patentname" placeholder="Patient Name" value="{{ $sqlduecollection[0]->patient_name }}" readonly>
		</div>
	</div>

	<div class="col-lg-8 col-md-8 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
			<label for="" class="col-lg-3 col-md-3 col-xs-3">Due Amount</label>
			<input name="due_amount" type="text" class="col-lg-3 col-md-3 col-xs-3" id="due_amount" placeholder="Due Amount" value="{{ $sqlduecollection[0]->DueAmount }}" readonly>
		</div>
	</div>

    <div class="col-lg-8 col-md-8 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        	<label for="invoice num" class="col-lg-3 col-md-3 col-xs-3"> Less From</label>
            <select id="lessfrom" name="lessfrom" placeholder="" class="col-lg-3 col-md-3 col-xs-3 entry_panel_dropdown" onChange="less_calculation(this.value)">
              <option value="0">Company</option>
              <option value="1">Both</option>
              <option value="2">Doctor</option>
            </select>          
      </div>
    </div>

    <div class="col-lg-8 col-md-8 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-3 col-md-3 col-xs-3">Less Type</label>
        <select id="lesstype" name="lesstype" placeholder="" class="col-lg-3 col-md-3 col-xs-3 entry_panel_dropdown" onChange="less_calculation(this.value)">
              <option value="0">Tk</option>
              <option value="1">%</option>
        </select>                   
      </div>
    </div>

    <div class="col-lg-8 col-md-8 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-3 col-md-3 col-xs-3">Less</label>
        <input type="text" id="lesspc" name="lesspc" placeholder="Less.." class="col-lg-3 col-md-3 col-xs-3" onkeyup="less_calculation(this.value)" >                    
      </div>
    </div>


    <div class="col-lg-8 col-md-8 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-3 col-md-3 col-xs-3 ">Less (Tk.)</label>
        <input type="text" id="lessamount" name="lessamount" placeholder="Less Amount.." readonly class="col-lg-3 col-md-3 col-xs-3">
      </div>
    </div>

    <div class="col-lg-8 col-md-8 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
          <label for="invoice num" class="col-lg-3 col-md-3 col-xs-3 ">Net Receivable</label>
          <input type="text" id="netreceivable" name="netreceivable" placeholder="Net Receivable.." class="col-lg-3 col-md-3 col-xs-3" value="{{ $sqlduecollection[0]->DueAmount }}" readonly>
      </div>
    </div>


    <div class="col-lg-8 col-md-8 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
		      <label for="invoice num" class="col-lg-3 col-md-3 col-xs-3 ">Receive Amount</label>
		      <input type="text" id="collection_amount" name="collection_amount" placeholder="Receive Amount.." class="col-lg-3 col-md-3 col-xs-3 " onkeyup="checkduecollection(this.value)" >
      </div>
    </div>



<!-- 	<div class="col-lg-8 col-md-8 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
			<label for="" class="col-lg-3 col-md-3 col-xs-3">Due Amount</label>
			<input name="due_amount" type="text" class="col-lg-3 col-md-3 col-xs-3" id="due_amount" placeholder="Due Amount" value="{{ $sqlduecollection[0]->DueAmount }}" readonly>
		</div>
	</div> -->

<!-- 
  <div id="invoiceno">
    <div id="invoiceno">
      <label for="">Receive Amount</label>
      <input name="collection_amount" type="text" class="input-small" id="collection_amount" placeholder="Consultant Name" value="{{ $sqlduecollection[0]->DueAmount }}">
    </div>
  </div>

   -->

	<div class="col-lg-8 col-md-8 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
          <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-6 col-md-6 col-xs-6 btn btn-save btn-sm button button-save pull-left" style="background: rgb(5, 142, 27); color: aliceblue;" >
      </div>
    </div> 

{{ Form::close() }}

@stop

@section('scripts')
  <script>
    $(function () {
    $("#top-entrypanel-validation").validate({
      rules: {
          collection_amount:   "required",
          collection_amount: {
            required: true,
            number: true,
            digits: true,
            min:1
          },          
          netreceivable: {
            required: true,
            number: true,
            digits: true
          },   
          lessamount: {
            number: true,
            digits: true
          },  
          lesspc: {
            number: true,
            digits: true
          }                 
      },

      messages: {
        collection_amount: {
          required: "Please enter receive amount",
        },        
        netreceivable: {
          required: "Please net receivable",
        },        
        lessamount: {
          required: "Please enter less amount",
        },        
        lesspc: {
          required: "Please enter less",
        }        
      }
      
    });      
    });
  </script>

@stop
