

// ***************************form submit***********************************************


    $('#user_form').on('submit',(function(e) {
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
                      window.location.replace('/users');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
                }
                   

               },
            
           });

    }));

// *************************************end from submit*****************************************************







// *************************************Start Radio button click to show input option*****************************************************



    $(document).ready(function(){
             $("#salesInfoBox").show();
          $("#hide").click(function(){
            $("#salesInfoBox").hide();
                  });
                $("#show").click(function(){
                 $("#salesInfoBox").show();
                  });
             });

// *************************************end Radio button click to show input option*****************************************************


// *************************************Start  Select 2 And User list Collection*****************************************************
$(document).ready(function($) {
      $.ajax({
        type:   'POST',
        url :   "/userslocationlist",
        headers:{ 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        data   :{ user_id: $("#user_id").val(),},
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
            { "data": "location_name" },
            { "data": "checkbox",
                "mRender": function (data, type, full) {
                if(full.users_id > 0 ){
                  return '<input type="checkbox"  name="permissionlocation[]" checked value="'+full.id+'">';
                }else{
                  return '<input type="checkbox"  name="permissionlocation[]" value="'+full.id+'">';
                }
              }
            },
            { "data": "radio",
                "mRender": function (data, type, full) {
              if(full.default_location == 1 ){
                  return '<input type="radio" name="defaultlocation[]" checked="checked" value="'+full.id+'">';
                }else{
                  return '<input type="radio" name="defaultlocation[]" value="'+full.id+'">';
                }
                
              }
            }
          ],
          "order": [[0,'asc']]
          });
        }
      });
    $('#employee_name').select2({
    placeholder: 'Enter Employee Name',
    allowClear: true,
    ajax: {
    dataType: 'json',
    url: '/join_employee_list',
    delay: 250,
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
    cache: true
    }
    });
});
// *************************************end Select 2 And User list Collection *****************************************************