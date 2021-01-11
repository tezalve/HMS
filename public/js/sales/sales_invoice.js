

         // totalcalculat();
// *START Select2 Portion*******************************************************************************  
      $customer=$('.customer').select2({
              placeholder: 'Select Customer Name',
              allowClear: true,

              ajax: {
                  dataType: 'json',
                  url: "/getCustomerInfo_data",
                  delay: 250,
                  data: function(params) {
                      return {
                          term: params.term
                      }
                  },
                  processResults: function(data, params) {
                      params.page = params.page || 1;
                      return {
                          results: data,
                          pagination: {
                              more: (params.page * 30) < data.total_count
                          }
                      };
                  },
                  cache: true
              }
          });

         $customer.on("select2:select", function(e) {
              $("#customer_address").val($(this).select2('data')['0']['address']);
              $("#customer_email").val($(this).select2('data')['0']['email']);
          })


          $customer.on("select2:unselect", function(e) {
              $("#customer_address").val('');
              $("#customer_email").val('');
          });


          var $item_info_name = $('.item_info_name').select2({
              placeholder: 'Enter Item Info Name',
              allowClear: true,
              ajax: {
                  dataType: 'json',
                  url: "/getItemInfo_data",
                  delay: 100,
                  data: function(params) {
                      return {
                          term: params.term
                      }
                  },
                  processResults: function(data, params) {
                      params.page = params.page || 1;
                      return {
                          results: data
                      };
                  },
              }
          });

          $item_info_name.on("select2:select", function(e) {
            $("#rate").val($(this).select2('data')['0']['selling_price']);
            $('#serial_number').val(null).trigger("change");
            $('#serial_number').select2('open');  
          })


          $item_info_name.on("select2:unselect", function(e) {
              $('#serial_number').val(null).trigger("change");
              $("#balance").val('');
          });


          var $serial_number = $('.serial_number').select2({
              placeholder: 'Enter a Serial Number',
              width: '100%',
              allowClear: true,
              ajax: {
                  dataType: 'json',
                  url: "/get_items_by_serial",
                  delay: 100,
                  data: function(params) {
                      return {
                          term: params.term,
                          item_info_name: $("#item_info_name option:selected").val(),
                      }
                  },
                  processResults: function(data, params) {
                      params.page = params.page || 1;
                      return {
                          results: data
                      };
                  },
              }
          });

          $serial_number.on("select2:select", function(e) {
              $("#balance").val($(this).select2('data')['0']['current_stock']);
              $("#qty").val(1);
              qty    = $("#qty").val();
              rate   = $("#rate").val();
              amount = qty*rate;
              $("#line_total").val(amount);
              $("#rate").focus();




          });

          $serial_number.on("select2:unselect", function(e) {
              $("#balance").val('');
              $("#qty").val('');
              $("#rate").val('');
              $("#line_total").val('');
              
          });



          $('.payment_method').select2({
              placeholder: 'Enter Payment Method',
              allowClear: true,
              ajax: {
                  dataType: 'json',
                  url: "/getPaymentMethod_data",
                  delay: 100,
                  data: function(params) {
                      return {
                          term: params.term
                      }
                  },
                  processResults: function(data, params) {
                      params.page = params.page || 1;
                      return {
                          results: data
                      };
                  },
              }
          });




         $('.sales_representative_id').select2({
                    placeholder:'Select Sales Representative',
                    allowClear: true,

                      ajax: {
                          dataType: 'json',
                          url: "/getSalesRepresentative_data",
                          delay: 250,         
                        data: function(params) {
                            return {
                              term: params.term
                            }
                        },
                          processResults: function (data, params) {
                            params.page = params.page || 1;
                            return {
                              results: data,
                              pagination: {
                                more: (params.page * 30) < data.total_count
                              }
                            };
                          },
                       cache: true         
                  }
           });



// *End Select2 Portion*******************************************************************************







//Start  sales-invoice-table DataTable  **********************************************************************


          sales_invoice_table = $("#sales-invoice-table").DataTable({
                  "searching": false,
                  "paging": false,
                  "ordering": false,
                  "autoWidth": false,
                  "bInfo": false,
                  "footerCallback": function(row, data, start, end, display) {
                      api = this.api(), data;
                  },
          });

         qty_info = 0;



        totalcalculat = function() {


              qty_info   =0;
              line_total =0;
              
              $(".qty").each(function() {
                  if (!isNaN(this.value) && this.value.length != 0) {

                      qty_info += parseFloat(this.value);

                  }
              });

// alert(qty_info);

            $(".line_total_class").each(function () {
                  //add only if the value is number
                  if (!isNaN(this.value) && this.value.length != 0) {
                      line_total += parseFloat(this.value);
                  }
              });  


              qty_info   = parseFloat(qty_info);
              line_total = parseFloat(line_total);

              $(api.column(3).footer()).html('Total Quantity:');
              $(api.column(4).footer()).html(qty_info.toFixed(2));
              // $(api.column(5).footer()).html(line_total.toFixed(2));
              // (#subTotal).val(line_total);
              $('#subTotal').val(line_total);


              due_amount_calculation();


        };

 



        //When add button clicked
          var data = [];
          $('#add').click(function(event) {
          event.preventDefault();


              if (parseFloat($('#balance').val()) < parseFloat($('#qty').val())) {
                  alert("insufficient balance");
                  return;
              }

              var item_info_name  = $("#item_info_name option:selected").text();
              var serial_number   = $("#serial_number option:selected").text();
              var item_id         = $("#item_info_name").val();
              var balance         = $("#balance").val();
              var qty             = $('#qty').val();
              var rate            = $('#rate').val();
              var line_total      = (qty*rate);



              if (isBlank(item_id)) {
                  alert("You can't add without Item");
                  return;
              }

              if (isBlank(balance)) {
                  alert("You have no sufficiant balance");
                  return;
              }

             if (isBlank(rate)) {
                  alert("You can't add without rate");
                  return;
              }
              if(rate<0){
                alert("You can't add insufficient rate");
                  return;
              }
             
             
              if (isBlank(qty)) {
                  alert("Please check Quantity");
                  $("#qty").focus();    
                  return;
              }

              if ((qty<=0)) {
                  alert("Please check Quantity");
                  $("#qty").focus();    
                  return;
              }



              var entry = [
                  //'<select class="form-control  " name="item_info_name[]" style="width: 100%;"><option value="' + item_id + '">' + item_info_name + '</option></select>',
                  '<input  type="text"    class="form-control "  style="width: 100%;text-align:left;"  value="' + item_info_name + '"    readonly>'+'<input  type="hidden"  name="item_info_name[]" value="' + item_id + '"    >',
                  '<input  type="text"    name="serial_number[]"   class="form-control "  style="width: 100%;text-align:left;"  value="' + serial_number + '"    readonly>',
                  //'<select class="form-control  " name="serial_number[]" style="width: 100%;"><option value="' + serial_number_id + '">' + serial_number + '</option></select>',
                  '<input  type="number"  name="balance[]"    class="form-control " placeholder="balance" style="width: 100%;text-align:center;"  value="' + balance + '"   onclick="this.select();" readonly>',
                  '<input  type="text"    name="rate[]"  class="form-control rate_class"  style="width: 100%;text-align:center;"  value="' + rate + '"   onclick="this.select();" >',
                  '<input  type="text"    name="quantity[]"  class="form-control qty"  style="width: 100%;text-align:center;"  value="' + qty + '"   onclick="this.select();" >',
                  '<input  type="text"    name="line_total[]"  class="form-control line_total_class"  style="width: 100%;text-align:center;"  value="' + line_total + '"   onclick="this.select();" readonly>',
                  '<button class="btn btn-danger btn-block delete-button btn-flat" id="' + '" style="padding: 3px 10px;">Delete</button>',
                  item_id,
                  serial_number

              ];


            var product       = entry[7];
            var serial_number = entry[8];


            console.log(product);
            console.log(serial_number);
            var booleanValue  = false;
            if(data.length >= 1){
              for(i=0; i<data.length; i++){
                if(data[i][7] == product & data[i][8] == serial_number){
                  booleanValue = true;
                }
              }
            }


            if(booleanValue){
              alert("This product has already been added");
              return;
            }



              data.push(entry);  
              sales_invoice_table.row.add(entry).draw(false);

              totalcalculat();
              refresh();
          });



          $('#sales-invoice-table tbody').on('click', '.delete-button', function() {
              // sales_invoice_table.row($(this).parents('tr')).remove().draw();

              var index = sales_invoice_table
              .row( $(this).parents('tr') )
              .index();
                  //remove index from data
                  data.splice(index,1);
                  sales_invoice_table
                  .row( $(this).parents('tr') )
                  .remove()
                  .draw();

              totalcalculat();
          });


          refresh = function() {
              $('#balance').val('');
              $('#qty').val('');
              $('#rate').val('');
              $('#line_total').val('');
              $('#item_info_name').val(null).trigger("change");
              $('#serial_number').val(null).trigger("change");
          }



        // Start (Quantity*Rate) = Line Cost Calculation

          $('#qty').on('input', function() {
                qty     = $("#qty").val();
                rate    = $("#rate").val();
                amount  = qty*rate;
                $("#line_total").val(amount);


                  if (parseFloat($('#balance').val()) < parseFloat($('#qty').val())) {
                      alert("insufficient balance");
                      balance = $("#balance").val();
                      $("#qty").val(balance);
                      return;
                  }


          });

          $('#rate').on('input', function() {
                qty      = $("#qty").val();
                rate     = $("#rate").val();
                amount   =qty*rate;
                $("#line_total").val(amount);
          });


          $('#discount_type_amount').on('input', function() {

              discount_type_amount    = $("#discount_type_amount").val();
              subTotal            = $("#subTotal").val();

              if($("#discount_type").val()=='%'){
                  amount   =subTotal*discount_type_amount/100;
              }else{
                  amount   =discount_type_amount;
             
              }  

            $("#discount_amount").val(amount);
           

                  if(isNaN(parseFloat($('#discount_amount').val()))){
                      discount_amount = 0;
                    }else{
                      discount_amount = parseFloat($('#discount_amount').val());
                    }
                    if(isNaN(parseFloat($('#payment').val()))){
                      payment = 0;
                    }else{
                      payment = parseFloat($('#payment').val());
                    } 
                     if(isNaN(parseFloat($('#subTotal').val()))){
                      line_total = 0;
                    }else{
                      line_total = parseFloat($('#subTotal').val());
                    }     


                   if(line_total-payment<discount_amount){
                      alert("Invalid discount amount");
                      $("#discount_amount").val(0);
                      $("#discount_type_amount").val(0);
                      $('#due_amount').val(0); 
                      $("#discount_type_amount").focus();
                      net_amount_calculation();
                    } 

                    if(discount_amount<0){
                      alert("Invalid discount amount");
                      $("#discount_amount").val(0);
                      $("#discount_type_amount").val(0);
                      $("#discount_type_amount").focus();
                      net_amount_calculation();
                    }

                   due_amount_calculation();
           
          });

        

          $("#discount_type").change(function() { 

                discount_type_amount    = $("#discount_type_amount").val();
                subTotal                = $("#subTotal").val();
                payment                 = $("#payment").val();
                discount_amount         = $("#discount_amount").val();
                

                if($("#discount_type").val()=='%'){
                    amount   =subTotal*discount_type_amount/100;
                }else{
                    amount   =discount_type_amount;
               
                }  

             $("#discount_amount").val(amount);

                    if(isNaN(parseFloat($('#discount_amount').val()))){
                      discount_amount = 0;
                    }else{
                      discount_amount = parseFloat($('#discount_amount').val());
                    }
                    if(isNaN(parseFloat($('#payment').val()))){
                      payment = 0;
                    }else{
                      payment = parseFloat($('#payment').val());
                    } 
                     if(isNaN(parseFloat($('#subTotal').val()))){
                      line_total = 0;
                    }else{
                      line_total = parseFloat($('#subTotal').val());
                    }     


                   if(line_total-payment<discount_amount){
                      alert("Invalid discount amount");
                      $("#discount_amount").val(0);
                      $("#discount_type_amount").val(0);
                      $('#due_amount').val(0); 
                      $("#discount_type_amount").focus();
                      net_amount_calculation();
                    }  
               due_amount_calculation();
             
          });



        // End (Quantity*Rate) = Line Cost Calculation




          $('#sales-invoice-table tbody').on( 'keyup', 'tr', function () {

              unitprice = $(this).find('td:eq(3)').find('input').val();
              quantity  = $(this).find('td:eq(4)').find('input').val();

              $(this).find('td:eq(5)').find('input').val((parseFloat(unitprice)*parseFloat(quantity)).toFixed(2));



              totalcalculat();
          });

          $('#sales-invoice-table tbody').on( 'focusout', 'tr', function () {
              stock     = $(this).find('td:eq(2)').find('input').val();
              price  = $(this).find('td:eq(3)').find('input').val();
              quantity  = $(this).find('td:eq(4)').find('input').val();

              if(stock<quantity){
                alert("You can't sale more then stock balance");
                $(this).find('td:eq(4)').find('input').val(stock);
                $(this).find('td:eq(5)').find('input').val((parseFloat(unitprice)*parseFloat(stock)).toFixed(2));           
              }


              if(parseFloat(price)<0){
                alert("You can't add invalid balance");
                $(this).find('td:eq(3)').find('input').val('00');
                $(this).find('td:eq(5)').find('input').val((parseFloat('00')*parseFloat(stock)).toFixed(2));           
              }


               if(parseFloat(quantity)<0){
                alert("You can't add invalid quantity");
                $(this).find('td:eq(4)').find('input').val('00');
                $(this).find('td:eq(5)').find('input').val((parseFloat(unitprice)*parseFloat('00')).toFixed(2));           
              }



              totalcalculat();
          })          


//END  sales-invoice-table DataTable  **********************************************************************
// **
// **
// **
// **
// **
// **
// **


//START  payment-method-table DataTable  **********************************************************************


       payment_method_table = $("#payment-method-table").DataTable({
                  "searching": false,
                  "paging": false,
                  "ordering": false,
                  "autoWidth": false,
                  "bInfo": false,
                  // "footerCallback": function(row, data, start, end, display) {
                  //     api = this.api(), data;
                  // },
          });


        //When addPayment button clicked
          var payment_data = [];
          $('#addPayment').click(function(event) {
          event.preventDefault();



              var payment_method_name   = $("#payment_method option:selected").text();
              var payment_method_id     = $("#payment_method").val();
              var payment_method_amount = $("#payment_method_amount").val();
              var payment_method_note   = $("#payment_method_note").val();
              var due_amount            = $('#due_amount').val();
              var collection            = $(".collection").val();
              var subTotal              = $("#subTotal").val();

      
     

              if (isBlank(payment_method_id)) {
                  alert("You can't add without Payment Method");
                  return;
              }
              if (isBlank(payment_method_amount)) {
                  alert("You can't add without Payment Amount");
                  return;
              }



              if (parseFloat(collection)<0) {
                  alert("You can't add Invalid Payment Amount");
                  return;
              }
           
              if (parseFloat(collection)>parseFloat(subTotal)) {
                  alert("You can't add Invalid Payment Amount");
                  return;
              }


               if (parseFloat(collection)>parseFloat(due_amount)) {
                  alert("You can't add Invalid Payment Amount");
                  return;
              }



                  if(parseFloat(due_amount)<parseFloat(payment_method_amount)){

                      alert("Invalid payment amount");
                      $("#payment_method_amount").val(0);
                      $("#payment_method_amount").focus(); 
                      return;
                     }

              var entry = [
              '<input  type="text"      class="form-control "  style="width: 100%;text-align:left;"  value="' + payment_method_name + '"  readonly >'+'<input  type="hidden" name="payment_method_id[]"     class="form-control "  style="width: 100%;text-align:left;"  value="' + payment_method_id + '"  readonly >',
              '<input  type="number"    name="payment_method_amount[]"  class="form-control payment_method_amount"  style="width: 100%;text-align:left;"  value="' + payment_method_amount + '"   >',
              '<input  type="text"    name="payment_method_note[]"  class="form-control payment_method_note"  style="width: 100%;text-align:left;"  value="' + payment_method_note + '"   >',
              '<button class="btn btn-danger btn-block delete-button btn-flat" id="' + '" style="padding: 3px 10px;">Delete</button>',
              '<input  type="hidden"   name="payment_method_id[]"   class="form-control "  style="width: 100%;text-align:left;"  value="' + payment_method_id + '"  readonly >',
                    
              ];


            var pay_id        = entry[3];
            var booleanValue  = false;
            if(data.length >= 1){
              for(i=0; i<data.length; i++){
                if(data[i][3] == payment_method_id ){
                  booleanValue = true;
                }
              }
            }


            if(booleanValue){
              alert("This paymnet Method has already been added");
              return;
            }



              payment_data.push(entry);  
              payment_method_table.row.add(entry).draw(false);

              totalcalculatPayment();
              refreshPayment();
          });


       

        totalcalculatPayment = function() {


              var payment_value   =0;
              

              $(".payment_method_amount").each(function() {
                  if (!isNaN(this.value) && this.value.length != 0) {

                      payment_value += parseFloat(this.value);
                  }
              });

              // console.log(payment_value);

              $('#payment').val(payment_value);
              due_amount_calculation();


        };




          $('#payment-method-table tbody').on('click', '.delete-button', function() {
              // sales_invoice_table.row($(this).parents('tr')).remove().draw();

              var index = payment_method_table
              .row( $(this).parents('tr') )
              .index();
                  //remove index from data
                  payment_data.splice(index,1);
                  payment_method_table
                  .row( $(this).parents('tr') )
                  .remove()
                  .draw();

              totalcalculatPayment();
          });


          refreshPayment = function() {
              $('#payment_method_amount').val('');
              $('#payment_method').val(null).trigger("change");
          }



          // $('#payment-method-table').keyup(function(e) {
          //   totalcalculatPayment();
          // }); 

          $('#payment-method-table tbody').on( 'keyup', 'tr', function () {

              // unitprice = $(this).find('td:eq(3)').find('input').val();
              // quantity  = $(this).find('td:eq(4)').find('input').val();
              // $(this).find('td:eq(5)').find('input').val((parseFloat(unitprice)*parseFloat(quantity)).toFixed(2));
              // totalcalculat();
              // recieve_voucher_table.cell($(this),3).data( (parseFloat(unitprice)*parseFloat(quantity)).toFixed(2) );
          });



            $('#payment-method-table tbody').on( 'focusout', 'tr', function () {

              var due_amount             = $("#due_amount").val();
              var subTotal               = $("#subTotal").val();
              var discount_amount        = $("#discount_amount").val();
              var payment_value          = 0;


              amount = $(this).find('td:eq(1)').find('input').val();
           
          
              if (parseFloat(amount)<0) {
                  alert("You can't add Invalid Payment Amount");
                  amount = $(this).find('td:eq(1)').find('input').val('00');
                 

              }

              if (parseFloat(amount)>parseFloat(subTotal)) {
                  alert("You can't add Invalid Payment Amount");
                  amount = $(this).find('td:eq(1)').find('input').val('00');
                  
              }

              
              $(".payment_method_amount").each(function() {
                  if (!isNaN(this.value) && this.value.length != 0) {

                      payment_value += parseFloat(this.value);
                  }
              });

              
            if (parseFloat(discount_amount)+parseFloat(payment_value)>parseFloat(subTotal)) {
                  alert("You can't add Invalid Payment Amount");
                  amount = $(this).find('td:eq(1)').find('input').val('00');
                  
              }
            totalcalculatPayment();
          });

//END  payment-method-table DataTable  **********************************************************************




//Start Due Amount Calculation ******

        due_amount_calculation = function(){


                    if(isNaN(parseFloat($('#discount_amount').val()))){
                      discount_amount = 0;
                    }else{
                      discount_amount = parseFloat($('#discount_amount').val());
                    }
                    if(isNaN(parseFloat($('#payment').val()))){
                      payment = 0;
                    }else{
                      payment = parseFloat($('#payment').val());
                    } 
                     if(isNaN(parseFloat($('#subTotal').val()))){
                      line_total = 0;
                    }else{
                      line_total = parseFloat($('#subTotal').val());
                    }     

                                 
                   $('#due_amount').val(line_total-discount_amount-payment);  

        }

//End Due Amount Calculation ******



  /*********Warranty Expired Calculation**********/

  $( document ).ready(function() {


      if($("#warranty_days_year").val() == 'year'){
          days = parseInt($("#warranty").val(), 10);
          days = days*365;  
      }else{
          days = parseInt($("#warranty").val(), 10);
      };


    var date = new Date($("#transaction_date").val()),

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

  $("#transaction_date, #warranty , #warranty_days_year").change(function() {

      if($("#warranty_days_year").val() == 'year'){
          days = parseInt($("#warranty").val(), 10);
          days = days*365;  
      }else{
          days = parseInt($("#warranty").val(), 10);
      };


     var date = new Date($("#transaction_date").val()),
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


  $("#transaction_date, #warranty").keyup(function() {

      if($("#warranty_days_year").val() == 'year'){
          days = parseInt($("#warranty").val(), 10);
          days = days*365;  
      }else{
          days = parseInt($("#warranty").val(), 10);
      };


    var date = new Date($("#transaction_date").val()),
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





        // $('input[type=checkbox][name=apply_quotation]').change(function() {
        //      alert("Yes");
        // });



    $('#sales_invoice_form').on('submit',(function(e) {
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
                  window.location.replace('/sales_invoice');

            }else{
                  toastr.error(data.messages);
                  $('#btnSubmit').attr("disabled", false);
                  $("#btnSubmit").val('Submit');
            }
               },
            
           });

    }));






// ************************ Modal script start *************************


$('#modal_customer_info').on('submit',(function(e) {
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
               toastr.success('Successfully Insert!');

                $("#btnSubmit").val('Submit');

                 $('.closeId').click();

        var newOption = new Option(data.customer_name, data.customer_id, true, true);
    // Append it to the select
        $('#customer_name').append(newOption).trigger('change.select2');
        $('#customer_address').val(data.address);
        $("#customer_email").val(data.email);
        $("#phone_no").val(data.phone_no);


        }else{
           toastr.error(data.messages);
                
                $('#btnSubmit').attr("disabled", false);
                $("#btnSubmit").val('Submit');
        }

  
    


           },
        
       });



   }));