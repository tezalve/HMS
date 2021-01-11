// ***************************from submit***********************************************


    $('#email_setup_form').on('submit',(function(e) {
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
                      window.location.replace('/emailsetup');

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


 
    $('.company_id').select2({
              placeholder:'Select company',
              allowClear: true,

                ajax: {
                    dataType: 'json',
                    url: "/get_company_info_data",
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
// *************************************end Select 2*****************************************************