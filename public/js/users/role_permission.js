

// ***************************from submit***********************************************


    $('#role_permission_form').on('submit',(function(e) {
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
                      window.location.replace('/role_permission');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
                }
                   

               },
            
           });

    }));

// *************************************end from submit*****************************************************


// *************************************Start role permission list***************************************************
 $(document).ready(function() {
        var table = $('#role_list').DataTable( {
            paging:         false,
            ordering:       false,
            bInfo:          false,
            searching:      false,            
        });      
      }); 
// *************************************end role permission list*****************************************************
