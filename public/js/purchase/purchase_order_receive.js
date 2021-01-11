


var sum = 0;
var table = document.getElementById("recieve-table");
var ths = table.getElementsByTagName('th');
var tds = table.getElementsByClassName('countable');


for(var i=0;i<tds.length;i++){
  sum += isNaN(tds[i].innerText) ? 0 : parseInt(tds[i].innerText);
}

var row = table.insertRow(table.rows.length);
var cell = row.insertCell(0);
cell.setAttribute('colspan', ths.length);
    
     $('#subTotal').val(sum);
var totalBalance  = document.createTextNode('Total Balance ' + sum);
// cell.appendChild(totalBalance);


  $(document).ready(function($) {
    //initialize datepicker
    $("#cheque_date").datepicker('setDate', new Date());    
    //initialize datatable
    recieve_voucher_table = $("#recieve-voucher-table").DataTable({
      "searching": false,
      "paging": false,
      "ordering": false,
      "autoWidth": false,
      "bInfo": false,
        "footerCallback": function ( row, data, start, end, display ) {
            api = this.api(), data;
        },  
            
    });

    price_info = 0;
    var deduct_info = 0;
    totalCalculate = function(){
      price_info = 0;
    //  $('#price').val(qty_info.toFixed(2));
     // $('#qty').val(price_info.toFixed(2));
    
      $(".price_info").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                price_info += parseFloat(this.value);               
            }          
        });  

      $( api.column(1).footer() ).html(price_info.toFixed(2));

      var totalPrice =Number(price_info.toFixed(2));

      // alert(totalPrice);

      // $('#totalPrice').val(sum+totalPrice);

      $('#amountData').val(price_info.toFixed(2));

      /*************Total Deduction*************/
          deduct_info = 0;
        
          $(".deduct_info").each(function () {

                //add only if the value is number
                if (!isNaN(this.value) && this.value.length != 0) {
                    deduct_info += parseFloat(this.value);
                    
                }
               
            });   
          $( api.column(2).footer() ).html(deduct_info.toFixed(2));

          var totalDeduct =Number(deduct_info.toFixed(2));

 
          $('#deductedTotal').val(deduct_info.toFixed(2));
      /*************Total Deduction*************/           
      $('#totalPrice').val(sum+totalPrice-totalDeduct);
    };
    
    /*************Call totalCalculate on change in input*************/           
    $('#recieve-voucher-table').keyup(function(e) {
        totalCalculate();
      }); 
    /*************Call totalCalculate on change in input*************/  

    /*************Delete row from the recieve-voucher-table*************/
    $('#recieve-voucher-table tbody').on( 'click', '.delete-button', function () {
       
            recieve_voucher_table.row($(this).parents('tr')).remove().draw();
             dataLoad();
            totalCalculate();
      });           
    /*************Delete row from the recieve-voucher-table*************/

    totalCalculate();
    $("#recieve-voucher-table tbody tr").on('keyup', function() {
      totalCalculate();
    });
    var cheque_info_ststus = false;
    //When add button clicked
    $('#add').click(function(event){

      event.preventDefault();
      //add array to data

      var particulars = $('#option1').val();
      // price       = $('#option2').val();
      price       = intVal($('#option2').val());

      deductPrice       = intVal($('#option3').val());
 
   
      // need to add tally condition

      var tableSize   = $('#recieve-voucher-table tbody tr').length;
      price_row    = 0;

      for (i = 0; i < tableSize; i++) { 


        if(recieve_voucher_table.cell(i,3).nodes().to$().find('input').val()>0){
          price_row = price_row+1;
        }
      }

     

      var entry = [
        '<input  type="text"  name="option1[]"     class="form-control option1"   style="width: 100%;"  value="'+particulars+'"    onclick="this.select();">',
        '<input  type="text"  name="price_info[]"    class="form-control price_info"  style="width: 100%;"  value="'+price+'"   onclick="this.select();">',
        '<input  type="text"  name="deduct_info[]"  class="form-control deduct_info"  style="width: 100%;"  value="'+deductPrice+'" onclick="this.select();">',
       
        // ' <select class="form-control serial " name="serial[]" style="width: 100%;" ><option value="'+serial+'" selected>'+serial_name+'</option></select>',
            '<button class="btn btn-danger btn-block delete-button btn-flat" id="' + '" style="padding: 3px 10px;">Delete</button>',
      ];
      $("#option1").val('');
      $('#price').val('');     
      recieve_voucher_table.row.add(entry).draw(false);
      dataLoad();
      totalCalculate();
    });

        var intVal = function ( i ) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '')*1 :
                typeof i === 'number' ?
                    i : 0;
        };
      
  $('#recieve-voucher-table tbody').on( 'keyup', 'tr', function () {

      quantity = $(this).find('td:eq(1)').find('input').val();

      unitprice = $(this).find('td:eq(2)').find('input').val();
      $(this).find('td:eq(3)').find('input').val((parseFloat(quantity)).toFixed(2));
      // recieve_voucher_table.cell($(this),3).data( (parseFloat(unitprice)*parseFloat(quantity)).toFixed(2) );
  });


})

        //delete row on button click
    $('#recieve-voucher-table tbody').on( 'click', '.delete-button', function () {

          recieve_voucher_table.row( $(this).parents('tr') ).remove().draw();
           dataLoad();
          totalCalculate();
    });
      dataLoad = function(){
      $("#remarks").val(''),
      $('#option2').val(null).trigger("change");
      $('#option3').val(null).trigger("change");
          
      }

    stringtohtml = function(html) {
        var el = document.createElement('div');
        el.innerHTML = html;
        return el.childNodes[0];
    }  


  /*********Warranty Expired Calculation**********/

  $( document ).ready(function() {


      if($("#warranty_days_year").val() == 'year'){
          days = parseInt($("#warranty").val(), 10);
          days = days*365;  
      }else{
          days = parseInt($("#warranty").val(), 10);
      };


    var date = new Date($("#po_date").val()),

        days = days ;
                  
        if(!isNaN(date.getTime())){
            date.setDate(date.getDate() + days);
            
            if(date =='Invalid Date'){
              $("#warranty_expire").val("");
            }else{
              $("#warranty_expire").val(date.toInputFormat());

            }
        } else {
            alert("Invalid Date");  
        }
});

  $("#po_date, #warranty , #warranty_days_year").change(function() {

      if($("#warranty_days_year").val() == 'year'){
          days = parseInt($("#warranty").val(), 10);
          days = days*365;  
      }else{
          days = parseInt($("#warranty").val(), 10);
      };


     var date = new Date($("#po_date").val()),
           days = days;

       
        
        if(!isNaN(date.getTime())){
            date.setDate(date.getDate() + days);
            
            // $("#warranty_expire").val(date.toInputFormat());
            if(date =='Invalid Date'){
              $("#warranty_expire").val("");
            }else{
              $("#warranty_expire").val(date.toInputFormat());

            }
        } else {
            alert("Invalid Date");  
        }
  });


  $("#po_date, #warranty").keyup(function() {

      if($("#warranty_days_year").val() == 'year'){
          days = parseInt($("#warranty").val(), 10);
          days = days*365;  
      }else{
          days = parseInt($("#warranty").val(), 10);
      };


    var date = new Date($("#po_date").val()),
           days = days;
        
        if(!isNaN(date.getTime())){
            date.setDate(date.getDate() + days);
            
            $("#warranty_expire").val(date.toInputFormat());
            if(date =='Invalid Date'){
              $("#warranty_expire").val("");
            }else{
              $("#warranty_expire").val(date.toInputFormat());

            }
        } else {
            alert("Invalid Date");  
        }
  });


  Date.prototype.toInputFormat = function() {
     var yyyy = this.getFullYear().toString();
     var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
     var dd  = this.getDate().toString();
     return  (mm[1]?mm:"0"+mm[0]) + "/"+  (dd[1]?dd:"0"+dd[0]) +"/"+ yyyy ; // padding
  };

  /*********Warranty Expired Calculation**********/






$('#purchase_order_receive_form').on('submit',(function(e) {
       e.preventDefault();

    $("#btnSubmit").attr("disabled", true);
    $("#btnSubmit").val('Please wait..');


       var formData = new FormData(this);

       $.ajax({
           type:'POST',
           url: $(this).attr('action'),
           data:formData,
           cache:false,
           contentType: false,
           processData: false,
           success:function(data){

            if(data.success == true) {
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
                      window.location.replace('/purchase_order_receive');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
            }

           },
        
       });



   }));


