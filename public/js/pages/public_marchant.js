// ***************************from submit***********************************************


    $('#public_marchant_form').on('submit',(function(e) {
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
                      window.location.replace('/public_marchant_view');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
                }
                   

               },
            
           });

    }));

// *************************************end from submit*****************************************************




// *************************************Start Get data public marchant*****************************************************

$(document).ready(function($) {
      $.ajax({
          type:   'get',
          url :   "/public_sales_agent_list",
          headers:{
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          dataType: 'json',
          data:{
                   status_id   : 2
                },     
          success: function(data) {
          var dataSet = data.data;
          var table = $('#list_table').DataTable( {
              responsive: true,
              destroy:    true,
              paging:     false,
              searching:  false,
              ordering:   true,
              bInfo:      false,
              "data":     dataSet,
              "columns": [

              { "data": "form_name" },                     
              { "data": "file_link",
                  "mRender": function (data, type, full) {
                  return '<a href="uploads/'+full.file_link+'" target="_blank" class="btn btn-info btn-flat btn-sm"> <span class="glyphicon glyphicon-eye-open"> View</a>';            
                  }
                 }, 

              { "data": "Link",
                "mRender": function (data, type, full) {
                    return '<a href="sales_agent_form/'+full.id+'/download" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-download-alt"></span> Download</a>';
                }
              },

            ],
            "order": [[0,'asc']]
          });
      }
      });

});



// *************************************end Get data public marchant*****************************************************




// *************************************StartSelect 2*****************************************************
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



// *************************************Start Add+ Input field*****************************************************
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
// *************************************end Add+ Input field*****************************************************

