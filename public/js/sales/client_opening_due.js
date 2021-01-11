// ***************************from submit***********************************************


    $('#client_opening_due_form').on('submit',(function(e) {
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
                      window.location.replace('/client_opening_due');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
                }
                   

               },
            
           });

    }));

// *************************************end from submit*****************************************************



// *************************************STart Select 2*****************************************************


 
   $customer= $('.customer_id').select2({
              placeholder:'Select Customer',
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
// *************************************end Select 2*****************************************************