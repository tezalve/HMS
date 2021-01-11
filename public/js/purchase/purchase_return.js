
// *START Select2 Portion******************************************************************************* 

      $customer=$('.vendor').select2({
              placeholder: 'Select Vendor Name',
              allowClear: true,

              ajax: {
                  dataType: 'json',
                  url: "/getVendorInfo_data",
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
              $("#vendor_address").val($(this).select2('data')['0']['street_address']);
          })


          $customer.on("select2:unselect", function(e) {
              $("#vendor_address").val('');
          });



 

          $invoice_data =$('.purchase_invoice_id').select2({
              placeholder: 'Select Purchase Invoice',
              allowClear: true,

              ajax: {
                  dataType: 'json',
                  url: "/getPurchaseInvoiceListData",
                  delay: 250,
                  data: function(params) {
                      return {
                          term: params.term,
                          vendor_id : $("#vendor").val(),
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


          $invoice_data.on("select2:select", function(e) {
            
             $("#purchase_invoice_master_id").val($(this).select2('data')['0']['purchase_invoice_master_id']);
           dataload(); 
           setTimeout(function(){totalcalculat();}, 1000);
                
          })


          $invoice_data.on("select2:unselect", function(e) {
              $("#purchase_invoice_master_id").val($(this).select2('data')['0']['purchase_invoice_master_id']);
                dataload();
                setTimeout(function(){totalcalculat();}, 1000);
              
          });

          dataload = function(){

            $.ajax({
              type:   'GET', 
              url :   "/getPurchaseInvoiceDataByInvoiceNo",
              headers:{
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                      },        
              data:   {
                         master_id: $("#purchase_invoice_id").val(),
                      },          
              dataType: 'json',
              success: function(data) {
                var dataSet = data.data;
                  table = $('#purchase-invoice-table').DataTable( {
                    destroy:    true,
                    paging:     false,
                    searching:  false,
                    ordering:   false,
                    bInfo:      false,  
                    "data":     dataSet,
                    "columns": [
                    { "data": "item_description",
                        "mRender": function (data, type, full) {
                        return '<p>'+full.item_description+'</p> <input type="hidden" style="width:100%;"  name="item_info_name[]'+full.item_id+'" id="item_info_name"  value="'+full.item_id+'" onfocus="this.select();">';
                      }
                    },  { "data": "serial_number",
                        "mRender": function (data, type, full) {
                        return '<p>'+full.serial_number+'</p><input type="hidden" style="width:100%;"  name="serial_number[]'+full.serial_number+'" id="serial_number"  value="'+full.serial_number+'" onfocus="this.select();">';
                      }
                    },
                     { "data": "quantity",
                        "mRender": function (data, type, full) {
                        return '<p>'+full.quantity+'</p><input type="hidden" style="width:100%;"  name="balance[]'+full.quantity+'" id="balance"  value="'+full.quantity+'" onfocus="this.select();">';
                      }
                    },
                    { "data": "rate",
                        "mRender": function (data, type, full) {
                        return '<p>'+full.rate+'</p><input type="hidden" style="width:100%;" class="rate"  name="rate[]'+full.rate+'" id="rate"  value="'+full.rate+'" onfocus="this.select();">';
                      }
                    },
                     { "data": "text",
                        "mRender": function (data, type, full) {
                        return '<input type="number" style="width:100%;" class="qty"  name="quantity[]'+full.item_id+'" id="qty"  value="'+full.quantity+'" onfocus="this.select();">';
                      }
                    },
                     { "data": "total_amount",
                        "mRender": function (data, type, full) {
                        return '<input type="text" readonly style="width:100%;" class="line_total_class" name="total_amount[]'+full.total_amount+'" id="total_amount" value="'+full.total_amount+'" onfocus="this.select();">';
                      }
                    },
                     { "data": "discount",
                        "mRender": function (data, type, full) {
                        return '<input type="text" readonly style="width:100%;" class="discount" name="discount[]'+full.discount+'" id="discount" value="'+full.discount+'" onfocus="this.select();">';
                      }
                    },

                     { "data": "button",
                        "mRender": function (data, type, full) {
                          return '<a class="btn btn-danger btn-block delete-button btn-flat" id="" style="padding: 3px 10px;">Delete</a>';
                        
                      }
                    },
                      { "data": "hidden_discount",
                        "mRender": function (data, type, full) {
                        return '<input type="hidden" style="width:100%;" class="hidden_discount" name="hidden_discount[]'+full.discount+'" id="hidden_discount" value="'+full.discount+'" onfocus="this.select();">';
                      }
                    }

                      ],
                     order: [ 1, 'asc' ]
                  });
              }
            }); 
            
          } 





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
              // $("#remarks").focus();    
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
              $("#quantity").focus();
          });

          $serial_number.on("select2:unselect", function(e) {
              $("#balance").val('');
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



// *End Select2 Portion*******************************************************************************







//Start  purchase-invoice-table DataTable  **********************************************************************


          purchase_invoice_table = $("#purchase-invoice-table").DataTable({
                  "searching": false,
                  "paging": false,
                  "ordering": false,
                  "autoWidth": false,
                  "bInfo": false,
                  "footerCallback": function(row, data, start, end, display) {
                      api = this.api(), data;
                  },
          });




        totalcalculat = function() {
              qty_info   =0;
              line_total =0;
              total_discount   =0;
              
              $(".qty").each(function() {
                  if (!isNaN(this.value) && this.value.length != 0) {

                      qty_info += parseFloat(this.value);

                  }
              });


            $(".line_total_class").each(function () {
                  //add only if the value is number
                  if (!isNaN(this.value) && this.value.length != 0) {
                      line_total += parseFloat(this.value);
                  }
              }); 

              $(".discount").each(function () {
                  //add only if the value is number
                  if (!isNaN(this.value) && this.value.length != 0) {
                      total_discount += parseFloat(this.value);
                  }
              });  



              $(api.column(3).footer()).html('Total Quantity:');
            console.log(api);

             $(api.column(4).footer()).html(qty_info.toFixed(2));
             $(api.column(5).footer()).html(line_total.toFixed(2));
             $(api.column(6).footer()).html(total_discount.toFixed(2));
          //   $(api.column(5).footer()).html(line_total.toFixed(2));
              // (#subTotal).val(line_total);
              $('#subTotal').val(line_total);
              $('#discount_amount').val(total_discount);


              due_amount_calculation();
//

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

              if (isBlank(balance) && isBlank(qty)) {
                  alert("qty or price can't be blank");
                  return;
              }


              var entry = [
                  //'<select class="form-control  " name="item_info_name[]" style="width: 100%;"><option value="' + item_id + '">' + item_info_name + '</option></select>',
                  '<input  type="text"    class="form-control "  style="width: 100%;text-align:left;"  value="' + item_info_name + '"    readonly>'+'<input  type="hidden"  name="item_info_name[]" value="' + item_id + '"    >',
                  '<input  type="text"    name="serial_number[]"   class="form-control "  style="width: 100%;text-align:left;"  value="' + serial_number + '"    readonly>',
                  //'<select class="form-control  " name="serial_number[]" style="width: 100%;"><option value="' + serial_number_id + '">' + serial_number + '</option></select>',
                  '<input  type="number"  name="balance[]"  id="balance"  class="form-control " placeholder="balance" style="width: 100%;text-align:center;"  value="' + balance + '"   onclick="this.select();" readonly>',
                  '<input  type="number"    name="rate[]"  class="form-control rate_class"  style="width: 100%;text-align:center;"  value="' + rate + '"   onclick="this.select();" >',
                  '<input  type="number"    name="quantity[]" id="qty" class="form-control qty"  style="width: 100%;text-align:center;"  value="' + qty + '"   onclick="this.select();" >',
                  '<input  type="number"    name="line_total[]"  class="form-control line_total_class"  style="width: 100%;text-align:center;"  value="' + line_total + '"   onclick="this.select();" readonly>',
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



          $('#purchase-invoice-table tbody').on('click', '.delete-button', function() {
              sales_invoice_table = $("#purchase-invoice-table").DataTable();
              sales_invoice_table.row($(this).parents('tr')).remove().draw(false);
  // confirm("Press a button!");
                totalcalculat();

              // sales_invoice_table.row( $(this).parents('tr') ).remove().draw();

              // var index = sales_invoice_table
              // .row( $(this).parents('tr') )
              // .index();
              //     //remove index from data
              //     data.splice(index,1);
              //     sales_invoice_table
              //     .row( $(this).parents('tr') )
              //     .remove()
              //     .draw();

              // totalcalculat();

            //  due_amount_calculation();
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

          // $('#qty').on('input', function() {
          //   alert('hi');
          //       qty     = $("#qty").val();
          //       rate    = $("#rate").val();
          //       amount  = qty*rate;
          //       $("#line_total").val(amount);


          //         if (parseFloat($('#balance').val()) < parseFloat($('#qty').val())) {
          //             alert("insufficient balance");
          //             balance = $("#balance").val();
          //             $("#qty").val(balance);
          //             return;
          //         }


          // });

          // $('#rate').on('input', function() {
          //       qty      = $("#qty").val();
          //       rate     = $("#rate").val();
          //       amount   =qty*rate;
          //       $("#line_total").val(amount);
          // });


          $('#discount_percent').on('input', function() {
                discount_percent    = $("#discount_percent").val();
                subTotal            = $("#subTotal").val();
                amount   =subTotal*discount_percent/100;
                $("#discount_amount").val(amount);
                due_amount_calculation();
          });

            $('#restock_percent').on('input', function() {
                restock_percent    = $("#restock_percent").val();
                subTotal            = $("#subTotal").val();
                amount   =subTotal*restock_percent/100;
                $("#restock_amount").val(amount);
                due_amount_calculation();
          });





            $('#restock_type_amount').on('input', function() {

                  restock_type_amount    = $("#restock_type_amount").val();
                  subTotal            = $("#subTotal").val();
         

                  if($("#restocking_type").val()=='%'){
                      amount   =subTotal*restock_type_amount/100;
                  }else{
                      amount   =restock_type_amount;
                 
                  }  

                  $("#restocking_amount").val(amount);
                  due_amount_calculation();
              });


           $("#restocking_type").change(function() { 

                restock_type_amount    = $("#restock_type_amount").val();
                subTotal            = $("#subTotal").val();

                if($("#restocking_type").val()=='%'){
                    amount   =subTotal*restock_type_amount/100;
                }else{
                    amount   =restock_type_amount;
               
                }  

                $("#restocking_amount").val(amount);
                due_amount_calculation();
          });
        // End (Quantity*Rate) = Line Cost Calculation




          // $('#purchase-invoice-table tbody').keyup(function(e) {
          //   totalcalculat();
          // }); 

          $('#purchase-invoice-table tbody').on( 'keyup', 'tr', function () {

              stock = $(this).find('td:eq(2)').find('input').val();            
              unitprice = $(this).find('td:eq(3)').find('input').val();            
              quantity  = $(this).find('td:eq(4)').find('input').val();
              discount  = $(this).find('td:eq(8)').find('input').val();

         

            quantity = parseFloat(quantity);
            stock = parseFloat(stock);
            discount = parseFloat(discount);

            single_pro_discount=discount/stock;
             // alert(single_pro_discount);
             // alert(discount);
             // alert(quantity);
            // alert(pro_discount);

            if(stock<quantity){
                alert("You can't sale more then stock balance");
                $(this).find('td:eq(4)').find('input').val(stock);
                $(this).find('td:eq(5)').find('input').val((parseFloat(unitprice)*parseFloat(quantity)).toFixed(2));           
                $(this).find('td:eq(6)').find('input').val((parseFloat(single_pro_discount)*parseFloat(quantity)).toFixed(2));
              }

          
           $(this).find('td:eq(5)').find('input').val((parseFloat(unitprice)*parseFloat(quantity)).toFixed(2));
           $(this).find('td:eq(6)').find('input').val((parseFloat(single_pro_discount)*parseFloat(quantity)).toFixed(2));

              // $(this).find('td:eq(5)').find('input').val((parseFloat(unitprice)*parseFloat(quantity)).toFixed(2));
               totalcalculat();
          });

          $('#purchase-invoice-table tbody').on( 'focusout', 'tr', function () {
              stock     = $(this).find('td:eq(2)').find('input').val();
              quantity  = $(this).find('td:eq(4)').find('input').val();
              unitprice = $(this).find('td:eq(3)').find('input').val();            


           // console.log(stock );
           // console.log(quantity);

            unitprice = parseFloat(unitprice);
            quantity = parseFloat(quantity);
            stock = parseFloat(stock);


            single_pro_discount=discount/stock;

              if(stock<quantity){

                alert("You can't sale more then stock balance");
                $(this).find('td:eq(4)').find('input').val(stock);
                $(this).find('td:eq(5)').find('input').val((parseFloat(unitprice)*parseFloat(stock)).toFixed(2));
          $(this).find('td:eq(6)').find('input').val((parseFloat(single_pro_discount)*parseFloat(stock)).toFixed(2));
           
              }


          $(this).find('td:eq(5)').find('input').val((parseFloat(unitprice)*parseFloat(quantity)).toFixed(2));
          $(this).find('td:eq(6)').find('input').val((parseFloat(single_pro_discount)*parseFloat(quantity)).toFixed(2));

              totalcalculat();


              if(quantity<0){
                alert("You can't sale Invalid quantity");
                $(this).find('td:eq(4)').find('input').val(stock);
                $(this).find('td:eq(5)').find('input').val((parseFloat(unitprice)*parseFloat(stock)).toFixed(2));           
                $(this).find('td:eq(6)').find('input').val((parseFloat(single_pro_discount)*parseFloat(stock)).toFixed(2));
                
                totalcalculat();
              }
          })          


//END  purchase-invoice-table DataTable  **********************************************************************
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

              if (isBlank(payment_method_id)) {
                  alert("You can't add without Payment Method");
                  return;
              }
              if (isBlank(payment_method_amount)) {
                  alert("You can't add without Payment Amount");
                  return;
              }

              var entry = [
              '<input  type="text"      class="form-control "  style="width: 100%;text-align:left;"  value="' + payment_method_name + '"  readonly >'+'<input  type="hidden" name="payment_method_id[]"     class="form-control "  style="width: 100%;text-align:left;"  value="' + payment_method_id + '"  readonly >',
              '<input  type="number"    name="payment_method_amount[]"  class="form-control payment_method_amount"  style="width: 100%;text-align:left;"  value="' + payment_method_amount + '"   >',
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



          $('#payment-method-table').keyup(function(e) {
            totalcalculatPayment();
          }); 

          $('#payment-method-table tbody').on( 'keyup', 'tr', function () {

              // unitprice = $(this).find('td:eq(3)').find('input').val();
              // quantity  = $(this).find('td:eq(4)').find('input').val();
              // $(this).find('td:eq(5)').find('input').val((parseFloat(unitprice)*parseFloat(quantity)).toFixed(2));
              // totalcalculat();
              // recieve_voucher_table.cell($(this),3).data( (parseFloat(unitprice)*parseFloat(quantity)).toFixed(2) );
          });

//END  payment-method-table DataTable  **********************************************************************




//Start Due Amount Calculation ******

        due_amount_calculation = function(){
                    if(isNaN(parseFloat($('#discount_amount').val()))){
                      discount_amount = 0;
                    }else{
                      discount_amount = parseFloat($('#discount_amount').val());
                    }
                     if(isNaN(parseFloat($('#restocking_amount').val()))){
                      restock_amount = 0;
                    }else{
                      restock_amount = parseFloat($('#restocking_amount').val());
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
                    

                     if(restock_amount<0){
                      alert("Invalid restocking amount");
                      $("#restocking_amount").val(0);
                      $("#restock_type_amount").val(0);
                      $("#restock_type_amount").focus();
                      net_amount_calculation();
                    }

                    $('#due_amount').val(line_total-discount_amount-restock_amount-payment);        

        }

//End Due Amount Calculation ******



/*********Warranty Expired Calculation**********/
        $("#transaction_date, #warranty").change(function() {
           var date = new Date($("#transaction_date").val()),
                 days = parseInt($("#warranty").val(), 10);
              
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
          var date = new Date($("#transaction_date").val()),
                 days = parseInt($("#warranty").val(), 10);
              
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



    $('#purchase_return_form').on('submit',(function(e) {
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
                  window.location.replace('/purchase_return');

            }else{
                  toastr.error(data.messages);
                  $('#btnSubmit').attr("disabled", false);
                  $("#btnSubmit").val('Submit');
            }
               },
            
           });

    }));


