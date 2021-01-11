

// ***************************from submit***********************************************


    $('#sales_rep_form').on('submit',(function(e) {
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
                      window.location.replace('/sales_rep_info');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
                }
                   

               },
            
           });

    }));

// *************************************end from submit*****************************************************



// *************************************Start Add input field*****************************************************


  $(document).ready(function(){      
    //  var postURL = "<?php echo url('addmore'); ?>";
      var i=1;  


      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<div id="row'+i+'" class="dynamic-added input-group col-lg-12 col-md-12 col-xs-12"><div  class="dtable table-bordered"> <table><tr><td><input type="text" name="file_name[]" placeholder="Enter file name" class="form-control name_list" required="required" /></td><td><input type="file" name="uploads_doc[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td> </tr></table></div></div>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


     


      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }
    });  
// *************************************end Add input field*****************************************************



// *************************************Start Select 2*****************************************************





$('#city_id').select2({
          placeholder:'Select City Name',
          allowClear: true,
          minimumInputLength: 2,
            ajax: {
                dataType: 'json',
                url: "/getCity_data",
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



// *************************************start Image show script*****************************************************

$(document).ready(function () {
  $('#choose-file').change(function () {
    var i = $(this).prev('label').clone();
    var file = $('#choose-file')[0].files[0].name;
    $(this).prev('label').text(file);
  }); 
 });

// *************************************end Image show script*****************************************************



