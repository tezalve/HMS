

// ***************************from submit***********************************************


    $('#permission_form').on('submit',(function(e) {
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
                      window.location.replace('/permission');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
                }
                   

               },
            
           });

    }));

// *************************************end from submit*****************************************************





// *************************************Start permission rules/message*****************************************************

//   $("#frm_permission").validate({
//    rules: {
//     // simple rule, converted to {required:true}
//     permission_name: {"required":true, "minlength": 5}
//     display_name: {"required":true, "minlength": 5}
    


//   },
//   messages: {
//     permission_name: {"required":"Please specify permission name"}
//     display_name: {"required":"Please specify display name", "minlength": "minlength"}
//   }
// });

// *************************************end permission rules/message*****************************************************

