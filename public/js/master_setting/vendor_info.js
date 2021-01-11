// ***************************from submit***********************************************


    $('#vendor_info_form').on('submit',(function(e) {
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
                      window.location.replace('/vendor_information');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
                }
                   

               },
            
           });

    }));

// *************************************end from submit*****************************************************



// *************************************Start Select 2*****************************************************


 $('.city_id').select2({
              placeholder:'City Information',
              allowClear: true,

                ajax: {
                    dataType: 'json',
                    url: "/getCity_dataInfo",
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


// *************************************Start get Vendor data*****************************************************

 $(document).ready(function($) {


  $('#vendor-table').DataTable( {
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
          "url":    "/getVendor",
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
        { "data": "vendor_type_name" },
        { "data": "vendor_code" },
        { "data": "Link",
                 "mRender": function (data, type, full) {
                     return '<a target="_blank"  href="vendor_information/'+full.id+'/view">'+full.vendor_name+'</a>';
                 }
         },
        { "data": "phone_no" },
        { "data": "email" },
        { "data": "street_address" },
        { "data": "Link", name: 'link', orderable: false, searchable: false}      
        ],
        "order": [[0, 'asc']]
      });


        $.ajax({
            type: 'GET',
            url: "/getVendorType",
           
            dataType: 'json',
            success: function(data) {
                var dataSet = data.data;
                table = $('#vendorType-table').DataTable({
                     destroy: true,
                    paging: true,
                    searching: true,
                    ordering: true,
                    bInfo: false,
                    "data": dataSet,
                    "columns": [{
                            "data": "vendor_type_name"
                        },
                        {
                            "data": "Link",
                            "mRender": function(data, type, full) {
                                return '<a  data-vendor_type_id="' + full.id + '" data-vendor_type_name="' + full.vendor_type_name + '"  class="btn btn-primary btn-flat btn-sm showme"> <span class="glyphicon glyphicon-edit">Edit</a>';
                            }
                        },
                    ],
                    "order": [
                        [0, 'asc']
                    ]
                });
            }
        });
        $('#vendorType-table').on('click', '.showme', function(e) {
            $('#vendor_type_id').val($(this).data('vendor_type_id'));
            $('#vendor_type_name').val($(this).data('vendor_type_name'));
            $('#modal_vendor_type').modal('show');
        });
        $('#modal_vendor_type').on('hidden.bs.modal', function() {
            location.reload();
        })
      

    });
// *************************************end get Vendor data*****************************************************

