// ***************************from submit***********************************************


    $('#marchant_form').on('submit',(function(e) {
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
                      window.location.replace('/marchant_form');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
                }
                   

               },
            
           });

    }));

// *************************************end from submit*****************************************************




// *************************************start get marchant data *****************************************************

$(document).ready(function($) {
      $.ajax({
          type:   'get',
          url :   "/sales_agent_list_data",
        
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
                    return '<a href="/sales_agent_form/'+full.id+'/download" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-download-alt"></span> Download</a>';
                }
              },


             { "data": "Link",
                  "mRender": function (data, type, full) {
                  return '<a  data-id="'+full.id+'" data-form_name="'+full.form_name+'"  class="btn btn-primary btn-flat btn-sm showme"> <span class="glyphicon glyphicon-edit">Edit</a>';            
                  }
                 },


            { "data": "file_link",
                  "mRender": function (data, type, full) {
                  return '<a  onclick="return confirm(\'Do you really want to DELETE?\')" href="sales_agent_delete/'+full.id+'" class="btn btn-danger btn-flat btn-sm"> <span class="glyphicon glyphicon-trash"   > Delete</a>';            
                  }
                 }, 

            ],
            "order": [[0,'asc']]
          });
      }
      });
      
      // new $.fn.dataTable.FixedHeader( table );


       $('#list_table').on('click', '.showme', function(e){
             $('#id').val($(this).data('id'));
             $('#form_name').val($(this).data('form_name'));
             $('#modal_material_type').modal('show');
         });

       $('#modal_material_type').on('hidden.bs.modal', function () {
        location.reload();
       })

        // $('#modal_state').on('hidden.bs.modal', function() {
        //     location.reload();
        // })


});




// *************************************end get marchant data *****************************************************

