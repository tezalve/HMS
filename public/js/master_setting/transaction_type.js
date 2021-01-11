// ***************************from submit***********************************************


    $('#transaction_type_form').on('submit',(function(e) {
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
                      window.location.replace('/transactionType');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
                }
                   

               },
            
           });

    }));

// *************************************end from submit*****************************************************






// *************************************Start Get data for trtansaction type*****************************************************
 $(document).ready(function($) {
              $.ajax({
              type:   'get',
              url :   "/transaction_list",
            
              dataType: 'json',
              success: function(data) {
              var dataSet = data.data;
              table = $('#list_table').DataTable( {
              destroy:    true,
              paging:     false,
              searching:  false,
              ordering:   true,
              bInfo:      false,
              "data":     dataSet,
              "columns": [
              { "data": "transaction_type_name" },
              { "data": "alias" },
              // { "data": "Link",
              //   "mRender": function (data, type, full) {
              //       return '<a href="{{URL::to('/')}}/role/'+full.id+'/edit" data-toggle="modal" data-target="#modal_material_type" data-whatever="@mdo" style="width: 14%;"> <span class="glyphicon glyphicon-edit"></span> Edit</a>';
              
              //   }
              // },
              { "data": "Link",
              "mRender": function (data, type, full) {
              return '<a  data-id="'+full.id+'" data-alias="'+full.alias+'"  class="btn btn-primary btn-flat btn-sm showme"> <span class="glyphicon glyphicon-edit">Edit</a>';
              }
              },
              ],
              "order": [[0,'asc']]
              });
              }
              });
              $('#list_table').on('click', '.showme', function(e){
              $('#id').val($(this).data('id'));
              $('#alias').val($(this).data('alias'));
              $('#modal_material_type').modal('show');
              });
              $('#modal_material_type').on('hidden.bs.modal', function () {
              location.reload();
              })
              });

// *************************************end Get data for trtansaction type*****************************************************



// *************************************Start Ignore Space*****************************************************

            function ignoreSpaces(event) {
              var character = event ? event.which : window.event.keyCode;
              if (character == 32) return false;
              }

// *************************************end Ignore Space*****************************************************