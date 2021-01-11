

$( document ).ready(function() {


// *START Select2 Portion*******************************************************************************  

    $("#adjustment_date").datepicker('setDate', new Date());

      $customer = $('.customer').select2({
        placeholder: 'Enter a customer',
        width: '100%',
        allowClear: true,
        ajax: {
          dataType: 'json',
          url: "/getCustomerInfo_data",
          delay: 100,
          data: function(params){
            return{
              term: params.term,
              client_type: 1
            }
          },
          processResults: function (data,params){
            params.page = params.page || 1;
            return{
              results: data
            }
          }
        }
      });


    $customer.on("select2:select", function (e) {
        $("#address").val($(this).select2('data')['0']['address']);
        $("#email").val($(this).select2('data')['0']['email']);
        $("#phone_no").val($(this).select2('data')['0']['phone_no']);
 
    })

    $customer.on("select2:unselect", function (e) { 
      $("#address").val('');
      $("#email").val('');
      $("#phone_no").val('');
    });

    

      $('.payment_method').select2({
          placeholder: 'Collection By',
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

      $customer.on("select2:select", function (e) {
          getBalanceAmount();
      });


      $customer.on("select2:unselect", function (e) { 

      });



// *End Select2 Portion*******************************************************************************

   


// **************************Start customer wise list**********************************
 

     function getBalanceAmount(){
    
          if ($("#customer").val() == null){
            $customer_id = 0;
          }else{
            $customer_id = $("#customer").val();
          }

      
          $.ajax({
            type:   'GET', 
            url :   "/customer_wise_due_list",
            headers:{
                      'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },        
            data:   {
                       customer_id: $customer_id,
                    },    

            dataType: 'json',
            success: function(data) {
              var dataSet = data.data;
                var md_table = $('#due_collection_table').DataTable( {
                  destroy:    true,
                  paging:     false,
                  searching:  false,
                  ordering:   true,
                  bInfo:      false,  
                "data":     dataSet,
                  "footerCallback": function ( row, data, start, end, display ) {
                      md_table = this.api(), data;
                       // Remove the formatting to get integer data for summation
                      var intVal = function ( i ) {
                          return typeof i === 'string' ?
                              i.replace(/[\$,]/g, '')*1 :
                              typeof i === 'number' ?
                                  i : 0;
                      };

                        totaldue = md_table
                          .column(2)
                          .data()
                          .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                          },0);

                      $( md_table.column(1).footer()).html("Total Sales Amount");
                      $( md_table.column(2).footer() ).html(totaldue.toFixed(2));
                  },

                  "columns": [
                  { "data": "transaction_number" },
                  { "data": "transaction_date" },
                  { "data": "sales_amount" },
                  { "data": "receive_amount" },
                  { "data": "due_amount" },
                  { "data": "Link",
                    "mRender": function (data, type, full) {
                      return '<input type="text"    name="collect_amount[]"   class="md_txt  input-mini allownumericwithdecimal form-control"  placeholder="Input Amt."  style="width:100%;"  onclick="this.select();">'+
                           '<input type="hidden"  name="id[]"  value="'+full.id+'">';
                    }
                  },
                  ],
                  order: [ 1, 'asc' ]
                });


              $('#due_collection_table tbody').on( 'keyup', 'tr', function () {  


                        

                        if ($("#adjustment_amount").val()=='' ){
                          $(this).find('td:eq(3)').find("input[name='collect_amount[]']").val(0);
                          alert("Please provide adjustable amount");
                          $('#adjustment_amount').focus();
                          return;
                        }

                        sum = 0;
                        $(".md_txt").each(function(){
                              if(!isNaN(this.value) && this.value !=0){
                                sum +=parseFloat(this.value);
                              }
                            }); 

                        $(md_table.column(5).footer() ).html(sum.toFixed(2));  


                        if ( parseFloat(md_table.cell($(this),4).data()) < parseFloat($(this).find('td:eq(5)').find('input').val())){
                                  alert("you can't adjustment more then due amount");
                                  $(this).find('td:eq(5)').find("input[name='collect_amount[]']").val(parseFloat(md_table.cell($(this),4).data()));
                                  sum = 0;
                                  $(".md_txt").each(function(){
                                        if(!isNaN(this.value) && this.value !=0){
                                          sum +=parseFloat(this.value);
                                        }
                                      }); 

                                  $(md_table.column(5).footer() ).html(sum.toFixed(4)); 


                         }

                        sum_total = 0;
                        $(".input-mini").each(function(){
                          if(!isNaN(this.value) && this.value !=0){
                            sum_total +=parseFloat(this.value);
                          }
                        });

                    

                       // $("#remaining_amount").val(parseFloat($("#adjustment_amount").val()) - parseFloat(sum_total));
                        $("#subTotal").val(parseFloat(sum_total));
                         due_amount_calculation();


                        if ( parseFloat($("#remaining_amount").val()) < 0 ){
                          alert("you can't adjustment more then adjustable balance !! please check");
                          $(this).find('td:eq(3)').find("input[name='collect_amount[]']").val(0);

                          // return;

                         sum_total = 0;
                          $(".input-mini").each(function(){
                            if(!isNaN(this.value) && this.value !=0){
                              sum_total +=parseFloat(this.value);
                            }
                          });

                        //  $("#remaining_amount").val(parseFloat($("#adjustment_amount").val()) - parseFloat(sum_total));
                            $("#subTotal").val(parseFloat(sum_total));
                            due_amount_calculation();

                        }


              })

            }
          }); 

    } 
 



 // ********************************End Customer wise list script**************************

        $("#adjustment_amount").on('keyup', function() {

            if ( parseFloat($("#adjustable_balance").val()) < parseFloat($("#adjustment_amount").val()) ){
              alert("you can't adjustment more then adjustable balance !! please check");
              $("#adjustment_amount").val(parseFloat($("#adjustable_balance").val()));
            }
        
            sum_total = 0;
            $(".input-mini").each(function(){
              if(!isNaN(this.value) && this.value !=0){
                sum_total +=parseFloat(this.value);
              }
            });

           // $("#remaining_amount").val(parseFloat($("#adjustment_amount").val()) - parseFloat(sum_total));
             $("#subTotal").val(parseFloat(sum_total));
                         due_amount_calculation();

        });



 $('#frm_challan').on('submit',(function(e) {
           e.preventDefault();

      dueamount  =      $("#due_amount").val();

      if(dueamount != 0){
          alert('You must be full pay invoice amount.');
          return;
      }

      if(confirm('Do you want to save?')){

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
                        window.location.replace('/due_collection');

                  }else{
                        toastr.error(data.messages);
                        $('#btnSubmit').attr("disabled", false);
                        $("#btnSubmit").val('Submit');
                  }
                     },
                  
                 });

                   }else{
          return;
        }  

    }));









//START  payment-method-table DataTable  **********************************************************************


       payment_method_table = $("#payment-method-table").DataTable({
                  "searching": false,
                  "paging": false,
                  "ordering": false,
                  "autoWidth": false,
                  "bInfo": false,
                  "footerCallback": function(row, data, start, end, display) {
                      api = this.api(), data;
                  },
          });


        //When addPayment button clicked
          var payment_data = [];
           var data = [];
    
          $('#addPayment').click(function(event) {

          event.preventDefault();

   if (parseFloat($('#balance').val()) < parseFloat($('#qty').val())) {
                  alert("insufficient balance");
                  return;
              }

              var payment_method_name   = $("#payment_method option:selected").text();
              var payment_method_id     = $("#payment_method").val();
              var payment_method_amount = $("#payment_method_amount").val();
              var payment_method_note = $("#payment_method_note").val();
              var subTotal              = $("#subTotal").val();
              var due_amount            = $("#due_amount").val();
              var collection            = $(".collection").val();

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

              var entry = [
              '<input  type="text" class="form-control"  style="width: 100%;text-align:left;"  value="' + payment_method_name + '"  readonly >'+'<input  type="hidden" name="payment_method_id[]"     class="form-control "  style="width: 100%;text-align:left;"  value="' + payment_method_id + '"  readonly >',
              '<input  type="number" name="payment_method_amount[]" class="form-control payment_method_amount"  style="width: 100%;text-align:left;"  value="' + payment_method_amount + '"   >',
              '<input  type="text" name="payment_method_note[]"  class="form-control payment_method_note"  style="width: 100%;text-align:left;"  value="' + payment_method_note + '"   >',
              '<button class="btn btn-danger btn-block delete-button btn-flat" id="' + '" style="padding: 3px 10px;">Delete</button>',
              '<input  type="hidden" name="payment_method_id[]"  class="form-control"  style="width: 100%;text-align:left;"  value="' + payment_method_id + '"  readonly >',
                    
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



//Start Due Amount Calculation ******

        due_amount_calculation = function(){



                    if(isNaN(parseFloat(sum_total))){
                      remaining_amount = 0;
                    }else{
                      remaining_amount = parseFloat(sum_total);
                    }
                    if(isNaN(parseFloat($('#payment').val()))){
                      payment = 0;
                    }else{
                      payment = parseFloat($('#payment').val());
                    }      


                    // alert(payment);
                   // $('#due_amount').val(line_total-remaining_amount-payment);        
                    $('#due_amount').val(remaining_amount-payment);        

        }

//End Due Amount Calculation ******




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



          $('#payment-method-amount').keyup(function(e) {
            // alert("NOMAN");
            totalcalculatPayment();
          }); 


       

          $('#payment-method-table tbody').on( 'focusout', 'tr', function () {

              var due_amount             = $("#due_amount").val();
              var subTotal              = $("#subTotal").val();
               
              amount = $(this).find('td:eq(1)').find('input').val();

         
          
              if (parseFloat(amount)<0) {
                  alert("You can't add Invalid Payment Amount");
                  amount = $(this).find('td:eq(1)').find('input').val('00');
                 

              }

              if (parseFloat(amount)>parseFloat(subTotal)) {
                  alert("You can't add Invalid Payment Amount");
                  amount = $(this).find('td:eq(1)').find('input').val('00');
                  
              }


               if (parseFloat(amount)>parseFloat(due_amount)) {
                  alert("You can't add Invalid Payment Amount");
                  amount = $(this).find('td:eq(1)').find('input').val('00');

              }
            totalcalculatPayment();
              // quantity  = $(this).find('td:eq(4)').find('input').val();
              // $(this).find('td:eq(5)').find('input').val((parseFloat(unitprice)*parseFloat(quantity)).toFixed(2));
              // totalcalculat();
              // recieve_voucher_table.cell($(this),3).data( (parseFloat(unitprice)*parseFloat(quantity)).toFixed(2) );
          });




//END  payment-method-table DataTable  **********************************************************************



        
    });




