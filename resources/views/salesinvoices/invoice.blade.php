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

<!-- ============================================ -->
<script>



    $(document).ready(function(){
        $('#top-entrypanel-validation input').keydown(function(e){

         if(e.keyCode==13){

            var inputType = $(':input:eq(' + ($(':input').index(this)) + ')').attr('id');

            if (inputType == 'description'){
              if (document.getElementById("description").value ==''){
                $('#lessfrom').focus(); 
              }
            }

            if (inputType == 'patentname'){
                var patientid   = document.getElementById("patientid").value;
                if (patientid == ''){
                  $('#patentname').focus(); 
                  return;
                }
            }            

            if (inputType == 'consultantby'){
                var consultantbyid  = document.getElementById("consultantbyid").value;
                if (consultantbyid  == ''){
                  $('#consultantby').focus(); 
                  return;
                }
            }


            if (inputType == 'referenceby'){
                var referencebyid  = document.getElementById("referencebyid").value;
                if (referencebyid  == ''){
                  $('#referenceby').focus(); 
                  return;
                }
            }


            switch (inputType) { 
              case 'invoice_no': 
                $('#invoicedate').focus(); 
                break;
              case 'invoicedate': 
                $('#patentname').focus(); 
                break;
              case 'patentname':
                $('#consultantby').focus(); 
                break;    
              case 'consultantby': 
                $('#referenceby').focus(); 
                break;
              case 'referenceby': 
                $('#remarks').focus(); 
                break;
              case 'remarks': 
                $('.dataTables_filter input').first().focus();   
                break;                
              case 'description': 
                $('#addRow').click(); 
                break;                
              case 'price': 
                $('#addRow').click(); 
                break;
              case 'lessfrom': 
                $('#lesspc').focus(); 
                break;
              case 'lesspc': 
                $('#lesstype').focus(); 
                break;
              case 'lesstype': 
                $('#lessamount').focus(); 
                break;
              case 'lessamount': 
                $('#advance').focus(); 
                break;
              case 'advance': 
                $('#submit').click(); 
                break;                

              default:

            }            


          }
        });

    })


$(document).ready(function() {
      $('#lessfrom').keydown(function(event) {  
          if(event.which==13)
              {
                  $('#lesspc').focus(); 
              }
      }); 
});
$(document).ready(function() {
      $('#lesstype').keydown(function(event) {  
          if(event.which==13){ 
            $('#advance').focus(); 
          }
      });
});


$(document).ready(function() {

      invoicetable = $('#invoicetable').DataTable( {  
        "ordering":   false,
        "info":       false,
        "searching":  false,
        "paging":     false,
        "scrollY":    "300px",

        "columnDefs": [{
          "targets": [ 4 ],
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

                    totalrefferal_amount = api
                          .column(4)
                          .data()
                          .reduce( function (a, b) {
                          return intVal(a) + intVal(b);
                    },0);

                document.getElementById('subtotal').value           = total;
                document.getElementById('dues').value               = total;
                document.getElementById('grandtotal').value         = total;
                document.getElementById('refferal_amount').value    = totalrefferal_amount;
                
            }
      });

      $('#invoicetable tbody').on( 'click', '#button', function () {
          invoicetable.row (
            $(this).parents('tr')).remove().draw();
      });

});





        function adddata(description,investigtion_id,price,refferal_fee,refferal_type){

            if (refferal_type==0){
              refferal_amount = roundToTwo((price*refferal_fee)/100);
            }else{
              refferal_amount = roundToTwo(refferal_fee);
            }


            if(description==""){
              // alert("Description field cannot be blank");
              return;
            }

            if (investigtion_id==""){
              // alert("Description field cannot be blank");
              return;              
            }

          invoicetable.row.add([    // type text shorate hobe for the addition and deletion feature 
            description,
            price,
            price,
            '<button                          type="button"    id="button"                 class="btn btn-sm button btn-danger pull-right">Delete</button>'+
            '<input                           type="hidden"    id="investigtion_id_grid"   name="investigtion_id_grid[]"           value="'+investigtion_id+'">'+
            '<input                           type="hidden"    id="price_grid"             name="price_grid[]"                     value="'+price+'">'+
            '<input                           type="hidden"    id="refferal_amount_grid"   name="refferal_amount_grid[]"           value="'+refferal_amount+'">',
            refferal_amount,
          ]).draw();            

      }




  $(document).ready(function() {

    charttable = $('#charttable').dataTable({
        "ordering":   false,
        "info":       false,
        "searching":  true,
        "paging":     false,
        "scrollY":    "400px"
    });
    $('.dataTables_filter input').attr("placeholder", "Investigation Item..");
    $('.dataTables_filter input').attr("size", "30px");
  });  


</script>





<script>
$(function() {
  $( "#invoicedate" ).datepicker({
    changeMonth: true,
    changeYear: true
  });
});

function  stringtohtml(html) {
    var el = document.createElement('div');
    el.innerHTML = html;
    return el.childNodes[0];
}

$( document ).ready(function() {
        $('#patientid').select2({
        placeholder: 'Enter a patent name',
            ajax: {
                dataType: 'json',
                url: "{{URL::to('/')}}/auto/patient",
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

$( document ).ready(function() {
        $('#consultantby').select2({
        placeholder: 'Enter a consultant by',
            ajax: {
                dataType: 'json',
                url: "{{URL::to('/')}}/auto/doctord",
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


$( document ).ready(function() {
        $('#referenceby').select2({
        placeholder: 'Enter a reference by',
            ajax: {
                dataType: 'json',
                url: "{{URL::to('/')}}/auto/doctord",
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



$(document).ready(function(){
  var ac_config = {
    source: "{{URL::to('/')}}/auto/investigtion",
    select: function(event, ui){
      $("#description").val(ui.item.name);
      $("#investigtion_id").val(ui.item.id);
      $("#price").val(ui.item.price);
      $("#totalamt").val(ui.item.price);
      $("#refferal_fee").val(ui.item.refferal_fee);
      $("#refferal_type").val(ui.item.refferal_type);
      
    },
    minLength:1
  };
  $("#description").autocomplete(ac_config);
});

function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}

function getfrom(datas){

      var lessamount = 0;
      var calculetamt = 0;
      var less            = document.getElementById("lesspc").value ;
      var lessfrom        = document.getElementById("lessfrom").value ;
      var refferal_amount = document.getElementById("refferal_amount").value ;
      var subtotal        = document.getElementById("subtotal").value ;
      var data            = document.getElementById("lesstype").value ;
  
      if (lessfrom==0){
          if (data==0){
              lessamount = less;  
          }else{
              lessamount = (subtotal*less)/100;
          }
          document.getElementById("lessamount").value  = lessamount ;
          document.getElementById("dues").value   = subtotal-lessamount ; 
          document.getElementById("grandtotal").value   = subtotal-lessamount ;   
      }



    if (lessfrom==1){
        if (data==0){
            lessamount = less;  
        }else{
            lessamount = (subtotal*less)/100;
        }
        document.getElementById("lessamount").value  = lessamount ;
        document.getElementById("dues").value   = subtotal-lessamount ;
        document.getElementById("grandtotal").value   = subtotal-lessamount ;  
    }



    if (lessfrom==2){
        if (data==0){
            if (refferal_amount>less){
                lessamount = less;  
            }else{
                lessamount = refferal_amount; 
            }

        }else{
            calculetamt = (subtotal*less)/100;
            if (refferal_amount>calculetamt){
                lessamount = calculetamt;
            }else{
                lessamount = refferal_amount;
                document.getElementById("lesspc").value   = lessamount ;
                document.getElementById("lesstype").value = 0;
            }
        }

        document.getElementById("lessamount").value  = lessamount ;
        document.getElementById("dues").value   = subtotal-lessamount ;
        document.getElementById("grandtotal").value   = subtotal-lessamount ;
        
    }

    grandtotal = document.getElementById("grandtotal").value;
    advance    = document.getElementById("advance").value;
    if (IsNumeric(advance)==false){
      advance = 0;
    }  

    document.getElementById("dues").value   = (parseFloat(grandtotal)-parseFloat(advance));
    
}

function IsNumeric(input) {
  return (input - 0) == input && input.length > 0;
}

function IsNumeric(input){
  var RE = /^-{0,1}\d*\.{0,1}\d+$/;
  return (RE.test(input));
}

 

function findinvestigation(id){

  level1 = id;
  $.ajax({ 
    type: 'POST', 
    url: "<?php echo URL::to('/'); ?>/auto/investigationdata",
    data: {p:level1}, 
    dataType: 'json',
    success: function(getdata){ 
    // console.log(getdata);
      if (getdata !=''){

        description        = getdata[0].name;
        investigtion_id    = getdata[0].id;
        price              = getdata[0].price;
        refferal_fee       = getdata[0].refferal_fee;
        refferal_type      = getdata[0].refferal_type;
        adddata(description,investigtion_id,price,refferal_fee,refferal_type);

          var table = $('#charttable').DataTable();
          table
           .search( '' )
           .columns().search( '' )
           .draw();
           $('.dataTables_filter input').first().focus(); 
      }else{
          if (level1 !=""){
            alert("Invalid Investigation!!!! Please Check");
            return;       
          }else{
            document.getElementById("description").focus(); 
          }
      }
    } 
  }); 

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
<legend style="background: coral;">Invoice</legend>
<!-- 'onkeypress'=> "return event.keyCode != 13;"-->
<form action="{{ route('invoices.store') }}" id="top-entrypanel-validation" method="POST" onkeypress="return event.keyCode != 13;">

	<input type="hidden" id="refferal_fee"       name="refferal_fee"     >
	<input type="hidden" id="refferal_type"      name="refferal_type"    >
	<input type="hidden" id="refferal_amount"    name="refferal_amount"   >
  <input type="hidden" id="investigtion_id"    name="investigtion_id"  >
  <input type="hidden" id="age"                name="age"                
  <input type="hidden" id="regno"              name="regno"              >
  


    <div class="col-lg-6 col-md-6 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Invoice No</label>
        <input type="text" id="invoice_no" name="invoice_no" placeholder="invoice no.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input">
      </div>
    </div>  


    <div class="col-lg-6 col-md-6 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Invoice Date</label>
        <input type="text" id="invoicedate" name="invoicedate" placeholder="" class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" readonly data-date-format="DD/MM/YY" value="{{ date('d/m/Y') }}">
      </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label" style="padding: 3px;">Patient Name</label>
        <select id="patientid" name="patientid" placeholder="" class="col-lg-8 col-md-8 col-xs-8 entry_panel_dropdown" >
        </select>        
      </div>
    </div>


    <div class="col-lg-6 col-md-6 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label" style="padding: 3px;">Consultant by</label>
        <select id="consultantby" name="consultantby" placeholder="" class="col-lg-8 col-md-8 col-xs-8 entry_panel_dropdown" >
        </select>               
      </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label" style="padding: 3px;">Reference by</label>
        <select id="referenceby" name="referenceby" placeholder="" class="col-lg-8 col-md-8 col-xs-8 entry_panel_dropdown" >
        </select>       
      </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Remarks</label>
        <input type="text" id="remarks" name="remarks" placeholder="Remarks.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input">
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
                  <th style="width:15%;">Charge</th>
                  <th style="width:15%;">Total</th>
                  <th style="width:5%;">Delete</th>
              </tr>
          </thead>                 

          <tbody>
          </tbody>
      </table>







    <div class="col-lg-4 col-md-4 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">From</label>
            <select id="lessfrom" name="lessfrom" placeholder="" class="col-lg-7 col-md-7 col-xs-7 entry_panel_dropdown" onChange="getfrom(this.value)">
              <option value="0">Company</option>
              <option value="1">Both</option>
              <option value="2">Doctor</option>
            </select>          
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Less</label>
        <input type="text" id="lesspc" name="lesspc" placeholder="Less.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" onkeyup="getfrom(this.value)">
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Sub Total</label>
        <input type="text" id="subtotal" name="subtotal" placeholder="Sub Total.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input" >
      </div>
    </div>        

    <div class="col-lg-4 col-md-4 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
          <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Less Type</label>
          <select id="lesstype" name="lesstype" placeholder="" class="col-lg-7 col-md-7 col-xs-7 entry_panel_dropdown" onChange="getfrom(this.value)">
              <option value="0">Tk</option>
              <option value="1">%</option>
          </select>          
      </div>
    </div>  


    <div class="col-lg-4 col-md-4 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Less (Tk.)</label>
        <input type="text" id="lessamount" name="lessamount" placeholder="Less Amount.." readonly class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
      </div>
    </div> 

    <div class="col-lg-4 col-md-4 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Grand Total</label>
        <input type="text" id="grandtotal" name="grandtotal" placeholder="Grand Total.." readonly class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
      </div>
    </div> 


    <div class="col-lg-4 col-md-4 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Advance</label>
        <input type="text" id="advance" name="advance" placeholder="Advance.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input"  onkeyup="getfrom(this.value)">
      </div>
    </div> 

    <div class="col-lg-4 col-md-4 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
        <label for="invoice num" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Dues</label>
        <input type="text" id="dues" name="dues" placeholder="Dues.." readonly class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">
      </div>
    </div> 


    <div class="col-lg-4 col-md-4 col-xs-12">
      <div class="col-lg-12 entry_panel_body ">
          <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-7 col-md-7 col-xs-7 btn btn-save btn-sm button button-save pull-right" style="background: rgb(5, 142, 27); color: aliceblue;" >
      </div>
    </div> 


  </div>
  
  <div class="col-lg-4 ">
    <table id="charttable" class="stripe row-border order-column" cellspacing="0" width="100%">
      <thead>
<!--           <tr>
            <th colspan="2" style="background: rgba(255, 255, 255, 0.99);"><input type="text" id="investigationitem" name="investigationitem" placeholder="Investigation Item.." class="col-lg-12 col-md-12 col-xs-12 entry_panel_input"  style="border: black 1px solid;"></th>
          </tr> -->
          <tr>
            <th style="width:35%;">Description</th>
            <th style="width:15%;">Charge</th>
          </tr>
      </thead>                 
      <tbody>
          @foreach ($investigation as $investigation)
            <tr>
            <td><a href="#" onclick="findinvestigation({{$investigation->id}});">{{$investigation->name}}</a></td>
            <td>{{$investigation->price}}</td>
            </tr>
          @endforeach        
      </tbody>
    </table>
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
          subtotal: "required",
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