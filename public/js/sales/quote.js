




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
      drawCallback: function() {

       $('.item_info_name_dg').select2({
            placeholder: 'Enter a Item Name',
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
              processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                  results: data
                };
              },
            }
          });
          
      }           
    });




    $cust_name = $('.customer_name').select2({
              placeholder:'Select Customer Name',
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


    $cust_name.on("select2:select", function (e) {
        $("#address").val($(this).select2('data')['0']['address']);
        $("#email").val($(this).select2('data')['0']['email']);
        $("#phone_no").val($(this).select2('data')['0']['phone_no']);
 
    })

    $cust_name.on("select2:unselect", function (e) { 
      $("#address").val('');
      $("#email").val('');
      $("#phone_no").val('');
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



          $('#discount_type_amount').on('input', function() {

                discount_type_amount    = $("#discount_type_amount").val();
                subTotal            = $("#subTotal").val();

                if($("#discount_type").val()=='%'){
                    amount   =subTotal*discount_type_amount/100;
                }else{
                    amount   =discount_type_amount;
               
                }  

                $("#discount_amount").val(amount);
                net_amount_calculation();
          });

          

          $("#discount_type").change(function() { 

                discount_type_amount    = $("#discount_type_amount").val();
                subTotal            = $("#subTotal").val();

                if($("#discount_type").val()=='%'){
                    amount   =subTotal*discount_type_amount/100;
                }else{
                    amount   =discount_type_amount;
               
                }  

                $("#discount_amount").val(amount);
                net_amount_calculation();
          });



        net_amount_calculation = function(){


                    if(isNaN(parseFloat($('#discount_amount').val()))){
                      discount_amount = 0;
                    }else{
                      discount_amount = parseFloat($('#discount_amount').val());
                    }
  
                    if(isNaN(parseFloat($('#subTotal').val()))){
                      line_total = 0;
                    }else{
                      line_total = parseFloat($('#subTotal').val());
                    }    

                   

                    if(line_total<discount_amount){
                      alert("Invalid discount amount");
                      $("#discount_amount").val(0);
                      $("#discount_type_amount").val(0);
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
                 
                    
                    $('#net_amount').val(line_total-discount_amount);        

        }



    qty_info  = 0;
    amount = 0;


    totalcalculat = function(){
      qty_info  = 0;
      amount = 0;
      //$('#price').val(qty_info.toFixed(2));
      //$('#qty').val(price_info.toFixed(2));
      
      $(".qty_info").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
             
                qty_info += parseFloat(this.value);

            }
      });

      $(".amount").each(function () {
      
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                amount += parseFloat(this.value);
            }
      });   

      $( api.column( 0 ).footer() ).html('Total Qty :');
      $( api.column( 1 ).footer() ).html(qty_info.toFixed(0));
      // $( api.column( 2 ).footer() ).html('Total Price :');
      // $( api.column( 3 ).footer() ).html(price_info.toFixed(2));



      // $('#total-qty').val(qty_info.toFixed(2));
      // alert(amount.toFixed(0));
      $('#subTotal').val(amount.toFixed(0));           
    };  

    totalcalculat();
    net_amount_calculation();
    $("#recieve-voucher-table tbody tr").on('keyup', function() {
      totalcalculat();
    });
    var cheque_info_ststus = false;
    //When add button clicked

    var data = [];
    $('#add').click(function(event){


      event.preventDefault();
      var item_info_name = $("#item_info_name option:selected").text();

      item_id     = $("#item_info_name").val();

      // remarks      = $("#remarks").val();
      // qty        = $("#qty").val();
      // price       = $('#price').val();
      qty        = intVal($("#qty").val());
      price      = intVal($('#price').val());
 
   




      // need to add tally condition

      if(isBlank(item_id)){
        alert("You can't add without Item");
        return;
      }


      if(isBlank(qty)){
        alert("You can't add without Quantity");
        return;
      }



      if(qty<0){
        alert("You can't add without valid Quantity");
        return;
      }

        if(price<0){
        alert("You can't add without valid Price");
        return;
      }


      if(isBlank(price)){
        alert("You can't add without Price");
        return;
      }

      if (isBlank(qty) && isBlank(price)){
        alert("qty or price can't be blank");
        return;       
      }

      if (qty<0 && price<0){
        alert("can't be add same row in qty and price value");
        return;
      }

      var tableSize   = $('#recieve-voucher-table tbody tr').length;
      qty_row     = 0;
      price_row    = 0;

      for (i = 0; i < tableSize; i++) { 

        // var qty_val  = recieve_voucher_table.cell(i,2).nodes().to$().find('input').val()
        // var credit_val = recieve_voucher_table.cell(i,3).nodes().to$().find('input').val()
        
        if(recieve_voucher_table.cell(i,2).nodes().to$().find('input').val()>0){
          qty_row = qty_row+1;
        }

        if(recieve_voucher_table.cell(i,3).nodes().to$().find('input').val()>0){
          price_row = price_row+1;
        }
      }

      // if(qty>0){
      //   if(qty_row>=1){
      //     if(price_row>1){
      //       alert("you can't add maltepul Item for JV");
      //       return;
      //     }
      //   } 
      // }

      // if(price>0){
      //   if(price_row>=1){
      //     if(qty_row>1){
      //       alert("you can't add maltepul Item for JV");
      //       return;
      //     }
      //   } 
      // }

      // var dropdown = '<select class="form-control serial " name="serial[]" style="width: 100%;" >'+
      //                '<option value="'+serial+'" selected>'+serial_name+'</option>'+
      //                '<option value="'+serial2+'">'+serial_name2+'</option>'+
      //                '</select>'


      var entry = [
        '<select class="form-control select2 item_info_name_dg" name="item_info_name[]" style="width: 100%;"><option value="'+item_id+'">'+item_info_name+'</option></select>',
        '<input  type="number" name="qty_info[]" class="form-control qty_info" placeholder="Quantity" style="width: 100%;text-align:center; "  value="'+qty+'"    onclick="this.select();">',
        '<input  type="number" name="price_info[]" class="form-control price_info" placeholder="Price" style="width: 100%;text-align:center;"  value="'+price+'"   onclick="this.select();">',
        '<input  type="text" name="amount[]" readonly class="form-control amount" style="width: 100%;text-align:center;"  value="'+amount+'"   onclick="this.select();">',
        '<button class="btn btn-danger btn-block delete-button btn-flat" id="' + '" style="padding: 3px 10px;">Delete</button>',
        item_id
      ];

        $("#qty").val('');
        $('#price').val('');   
        $('#amount').val('');   

 

          var product       = entry[5];
          var booleanValue  = false;

          if(data.length >= 1){
            for(i=0; i<data.length; i++){
              if(data[i][5] == product ){
                booleanValue = true;
              }
            }
          }


          if(booleanValue){
            alert("This product has already been added");
            return;
          }



          data.push(entry);  



      recieve_voucher_table.row.add(entry).draw(false);
      dataLoad();
      totalcalculat();
      net_amount_calculation();
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
      $(this).find('td:eq(3)').find('input').val((parseFloat(unitprice)*parseFloat(quantity)).toFixed(0));
      totalcalculat();
      net_amount_calculation();
      // recieve_voucher_table.cell($(this),3).data( (parseFloat(unitprice)*parseFloat(quantity)).toFixed(2) );
  });



    //delete row on button click
$('#recieve-voucher-table tbody').on( 'click', '.delete-button', function () {

      // data.splice(index,1);
      // recieve_voucher_table.row( $(this).parents('tr') ).remove().draw();

      var index = recieve_voucher_table
      .row( $(this).parents('tr') )
      .index();
      //remove index from data
      data.splice(index,1);
      recieve_voucher_table
      .row( $(this).parents('tr') )
      .remove()
      .draw();

      totalcalculat();
      net_amount_calculation();
});


      dataLoad = function(){
      $("#remarks").val(''),
      $('#item_info_name').val(null).trigger("change");
      $('#item_info_name').select2('open');
      $('#item_info_name').select2('close');      
      }

    stringtohtml = function(html) {
        var el = document.createElement('div');
        el.innerHTML = html;
        return el.childNodes[0];
    }  


    $item_info_name = $('.item_info_name').select2({
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
          processResults: function (data, params) {
            params.page = params.page || 1;
            return {
              results: data
            };
          },
        }
    });

    $item_info_name.on("select2:select", function (e) {
        $("#price").val($(this).select2('data')['0']['selling_price']);
        $("#qty").val(1);
        
        qty    = $("#qty").val();
        price  = $("#price").val();
        amount = qty*price;

        $("#amount").val(amount);
        
       
    })

    $item_info_name.on("select2:unselect", function (e) { 
      $("#price").val('');
    });


    $('#qty').on('input', function() {
     qty    = $("#qty").val();
     price        = $("#price").val();
     amount=qty*price;
     
       
      $("#amount").val(amount);
    });

    $('#price').on('input', function() {
     qty        = $("#qty").val();
     price        = $("#price").val();
     amount=qty*price;

      $("#amount").val(amount);
    });





$('#quote_form').on('submit',(function(e) {
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

                  window.location.replace('/quote');

        }else{
           toastr.error(data.messages);
                
                $('#btnSubmit').attr("disabled", false);
                $("#btnSubmit").val('Submit');
        }

  
    


           },
        
       });



   }));




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
        $('#address').val(data.address);
        $("#email").val(data.email);
        $("#phone_no").val(data.phone_no);


        }else{
           toastr.error(data.messages);
                
                $('#btnSubmit').attr("disabled", false);
                $("#btnSubmit").val('Submit');
        }

  
    


           },
        
       });



   }));