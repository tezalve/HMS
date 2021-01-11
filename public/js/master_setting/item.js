// ***************************from submit***********************************************


    $('#item_info_form').on('submit',(function(e) {
           e.preventDefault();

        $("#btnSubmitCategory").attr("disabled", true);
        $("#btnSubmitCategory").val('Please wait..');


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
                      $('#btnSubmitCategory').attr("disabled", false);
                      $("#btnSubmitCategory").val('Submit');
                      window.location.replace('/item_info');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmitCategory').attr("disabled", false);
                      $("#btnSubmitCategory").val('Submit');
                }
                   

               },
            
           });

    }));

// *************************************end from submit*****************************************************




// ***************************Item Cat from submit***********************************************


    $('#item_cat_info_form').on('submit',(function(e) {
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
                      window.location.replace('/item_info');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
                }
                   

               },
            
           });

    }));

// *************************************end from submit*****************************************************





// ***************************Item unit from submit***********************************************


    $('#item_unit_info_form').on('submit',(function(e) {
           e.preventDefault();

        $("#btnSubmitUnit").attr("disabled", true);
        $("#btnSubmitUnit").val('Please wait..');


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
                      $('#btnSubmitUnit').attr("disabled", false);
                      $("#btnSubmitUnit").val('Submit');
                      window.location.replace('/item_info');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmitUnit').attr("disabled", false);
                      $("#btnSubmitUnit").val('Submit');
                }
                   

               },
            
           });

    }));

// *************************************end from submit*****************************************************




// *************************************Start Select 2*****************************************************

 $('.item_unit').select2({
              placeholder:'Select Item Unit',
              allowClear: true,

                ajax: {
                    dataType: 'json',
                    url: "/getItemUnit_data",
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



$('.item_cat_id').select2({
              placeholder:'Select Item Category',
              allowClear: true,

                ajax: {
                    dataType: 'json',
                    url: "/getItemCat_data",
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





$('.item_type_id').select2({
              placeholder:'Select Item Type',
              allowClear: true,

                ajax: {
                    dataType: 'json',
                    url: "/getItemType_data",
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






// *************************************Start Get item data*****************************************************

$(document).ready(function($) {
    $('#item-table').DataTable( {
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
    "url":    "/getItem",
    "type":   "GET",
    "dataType": "json",
    "data": {status:2},
    },
// data:   {
//    punch_date: $("#process_date").val(),
//    location: location_id,
//    punch_date: $("#date-from").val(),
//    dateto:   $("#date-to").val()
// },
    "columns": [
    { "data": "item_type_name" },
    { "data": "item_code" },
    { "data": "item_description" },
    { "data": "cost_price" },
    { "data": "agent_cost" },
    { "data": "selling_price" },
    { "data": "tax" },
    { "data": "tariff" },
    { "data": "Link", name: 'link', orderable: false, searchable: false}
    ],
    "order": [[0, 'asc']]
    });

    $.ajax({
    type: 'GET',
    url: "/getItemType",
   
    dataType: 'json',
    success: function(data) {
    var dataSet = data.data;
    table = $('#itemType-table').DataTable({
    destroy: true,
    paging: true,
    searching: true,
    ordering: true,
    bInfo: false,
    "data": dataSet,
    "columns": [{
    "data": "item_type_name"
    },
    {
    "data": "Link",
    "mRender": function(data, type, full) {
    return '<a  data-item_type_id="' + full.id + '" data-item_type_name="' + full.item_type_name + '"  class="btn btn-primary btn-flat btn-sm showme"> <span class="glyphicon glyphicon-edit">Edit</a>';
    }
    },
    ],
    "order": [
    [0, 'asc']
    ]
    });
    }
    });
    $('#itemType-table').on('click', '.showme', function(e) {
    $('#item_type_id').val($(this).data('item_type_id'));
    $('#item_type_name').val($(this).data('item_type_name'));
    $('#modal_item_type').modal('show');
    });
    $('#modal_item_type').on('hidden.bs.modal', function() {
    location.reload();
    })
    $.ajax({
    type: 'GET',
    url: "/getItemUnit",
  
    dataType: 'json',
    success: function(data) {
    var dataSet = data.data;
    table = $('#itemUnit-table').DataTable({
    destroy: true,
    paging: true,
    searching: true,
    ordering: true,
    bInfo: false,
    "data": dataSet,
    "columns": [{
    "data": "unit_name"
    },
    {
    "data": "Link",
    "mRender": function(data, type, full) {
    return '<a  data-item_unit_id="' + full.id + '" data-item_unit_name="' + full.unit_name + '"  class="btn btn-primary btn-flat btn-sm showme"> <span class="glyphicon glyphicon-edit">Edit</a>';
    }
    },
    ],
    "order": [
    [0, 'asc']
    ]
    });
    }
    });
    $('#itemUnit-table').on('click', '.showme', function(e) {
    $('#item_unit_id').val($(this).data('item_unit_id'));
    $('#item_unit_name').val($(this).data('item_unit_name'));
    $('#modal_item_unit').modal('show');
    });
    $('#modal_item_unit').on('hidden.bs.modal', function() {
   location.reload();
    })
    $.ajax({
    type: 'GET',
    url: "/getItemCat",
   
    dataType: 'json',
    success: function(data) {
    var dataSet = data.data;
    table = $('#itemCat-table').DataTable({
    destroy: true,
    paging: true,
    searching: true,
    ordering: true,
    bInfo: false,
    "data": dataSet,
    "columns": [{
    "data": "category_name"
    },
    {
    "data": "Link",
    "mRender": function(data, type, full) {
    return '<a  data-item_cat_id="' + full.id + '" data-item_cat_name="' + full.category_name + '"  class="btn btn-primary btn-flat btn-sm showme"> <span class="glyphicon glyphicon-edit">Edit</a>';
    }
    },
    ],
    "order": [
    [0, 'asc']
    ]
    });
    }
    });
    $('#itemCat-table').on('click', '.showme', function(e) {
    $('#item_cat_id').val($(this).data('item_cat_id'));
    $('#item_cat_name').val($(this).data('item_cat_name'));
    $('#modal_item_cat').modal('show');
    });
    $('#modal_item_cat').on('hidden.bs.modal', function() {
    location.reload();
    })

});
// *************************************end get item data*****************************************************
