
// ***************************from submit***********************************************


    $('#customer_form').on('submit',(function(e) {
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
                      window.location.replace('/customer_info');

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
// *************************************end Select 2*****************************************************




// *************************************Start Add+ Input Field*****************************************************
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
// *************************************end Add+ Input Field*****************************************************





// *************************************start customer data get*****************************************************
 $(document).ready(function($) {


  $('#customer-table').DataTable( {
        "processing":   true,
        "serverSide":   true,
        "paging":       true,
        "lengthChange": true,
        "searching":    true,
        "ordering":     true,
        "info":         true,
        "autoWidth":    false,
        "responsive":   true,
        "ajax": {
          "url":    "/getCustomer",
          "type":   "GET",
          "dataType": "json",
          "data": {status:2},
        },   
                // data:   {
                //    punch_date: $("#process_date").val(),
                //    location: location_id,
                //    // punch_date: $("#date-from").val(),
                //    // dateto:   $("#date-to").val()
                // },  
        "columns": [
        { "data": "customer_type_name" },
        { "data": "merchant_no" },
         { "data": "Link",
           "mRender": function (data, type, full) {
               return '<a target="_blank"  href="customer_info/'+full.id+'/view">'+full.merchant_name+'</a>';
           }
         },
        { "data": "pos_id" },
        { "data": "phone_no" },
        { "data": "email" },
        { "data": "address" },
        { "data": "Link", name: 'link', orderable: false, searchable: false}      
        ],
        "order": [[0, 'asc']]
      });


        $.ajax({
            type: 'GET',
            url: "/getCustomerType",
           
            dataType: 'json',
            success: function(data) {
                var dataSet = data.data;
                table = $('#customerType-table').DataTable({
                     destroy: true,
                    paging: true,
                    searching: true,
                    ordering: true,
                    bInfo: false,
                    "data": dataSet,
                    "columns": [{
                            "data": "customer_type_name"
                        },
                        {
                            "data": "Link",
                            "mRender": function(data, type, full) {
                                return '<a  data-customer_type_id="' + full.id + '" data-customer_type_name="' + full.customer_type_name + '"  class="btn btn-primary btn-flat btn-sm showme"> <span class="glyphicon glyphicon-edit">Edit</a>';
                            }
                        },
                    ],
                    "order": [
                        [0, 'asc']
                    ]
                });
            }
        });
        $('#customerType-table').on('click', '.showme', function(e) {
            $('#customer_type_id').val($(this).data('customer_type_id'));
            $('#customer_type_name').val($(this).data('customer_type_name'));
            $('#modal_customer_type').modal('show');
        });
        $('#modal_customer_type').on('hidden.bs.modal', function() {
            location.reload();
        })
      

    });
// *************************************end customer Data get*****************************************************





// *************************************start customer  pending data get*****************************************************
  $(document).ready(function($) {


  $('#customer-pending-table').DataTable( {
        "processing":   true,
        "serverSide":   true,
        "paging":       true,
        "lengthChange": true,
        "searching":    true,
        "ordering":     true,
        "info":         true,
        "autoWidth":    false,
        "responsive":   true,
      "ajax": {
        "url":    "/getCustomer",
        "type":   "GET",
            "dataType": "json",
            "data": {status:1},
      },    
        "columns": [
        // { "data": "customer_type_name" },
        // { "data": "merchant_no" },
        { "data": "merchant_name" },
        // { "data": "pos_id" },
        { "data": "phone_no" },
        { "data": "email" },
        { "data": "address" },
        { "data": "Link", name: 'link', orderable: false, searchable: false}      
        ],
        "order": [[0, 'asc']]
      });


        $.ajax({
            type: 'GET',
            url: "/getCustomerType",
         
            dataType: 'json',
            success: function(data) {
                var dataSet = data.data;
                table = $('#customerType-table').DataTable({
                     destroy: true,
                    paging: true,
                    searching: true,
                    ordering: true,
                    bInfo: false,
                    "data": dataSet,
                    "columns": [{
                            "data": "customer_type_name"
                        },
                        {
                            "data": "Link",
                            "mRender": function(data, type, full) {
                                return '<a  data-customer_type_id="' + full.id + '" data-customer_type_name="' + full.customer_type_name + '"  class="btn btn-primary btn-flat btn-sm showme"> <span class="glyphicon glyphicon-edit">Edit</a>';
                            }
                        },
                    ],
                    "order": [
                        [0, 'asc']
                    ]
                });
            }
        });
        $('#customerType-table').on('click', '.showme', function(e) {
            $('#customer_type_id').val($(this).data('customer_type_id'));
            $('#customer_type_name').val($(this).data('customer_type_name'));
            $('#modal_customer_type').modal('show');
        });
        $('#modal_customer_type').on('hidden.bs.modal', function() {
           location.reload();
        })
      

    });
// *************************************end customer pending Data get*****************************************************
