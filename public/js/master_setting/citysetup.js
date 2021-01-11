

// *************************************start Select 2*****************************************************


   var $country_name= $('#country_id_for_state').select2({
            placeholder: 'Enter an Country Name',
            allowClear: true,
            ajax: {
                dataType: 'json',
                url: "/getCountry_data",
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term
                    }
                },
                processResults: function(data, params) {
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


var $state_name_select = $('#state_id_for_city').select2({
            placeholder: 'Enter an State Name',
            allowClear: true,
            ajax: {
                dataType: 'json',
                url: "/getState_data",
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term
                    }
                },
                processResults: function(data, params) {
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


var $state_name = $('#state_id_data').select2({
            placeholder: 'Enter an State Name',
            allowClear: true,
            ajax: {
                dataType: 'json',
                url: "/getState_data",
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term
                    }
                },
                processResults: function(data, params) {
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






// ***************************from submit***********************************************


    $('#citysetup_form').on('submit',(function(e) {
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
                      window.location.replace('/citysetup');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
                }
                   

               },
            
           });

    }));

// *************************************end from submit*****************************************************



// ***************************start state from submit***********************************************


    $('#state_form').on('submit',(function(e) {
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
                      window.location.replace('/citysetup');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
                }
                   

               },
            
           });

    }));

// *************************************end state from submit*****************************************************





// ***************************start Country from submit***********************************************


    $('#country_form').on('submit',(function(e) {
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
                      window.location.replace('/citysetup');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
                }
                   

               },
            
           });

    }));

// *************************************end COuntry from submit*****************************************************




// *************************************start city/country/stare data get*****************************************************
 $(document).ready(function($) {

        $.ajax({
            type: 'GET',
            url: "/getCountry",
          
            dataType: 'json',
            success: function(data) {
                var dataSet = data.data;
                table = $('#country-table').DataTable({
                    destroy: true,
                    paging: true,
                    searching: true,
                    ordering: true,
                    bInfo: false,
                    "data": dataSet,
                    "columns": [{
                            "data": "country_name"
                        },
                        {
                            "data": "Link",
                            "mRender": function(data, type, full) {
                                return '<a  data-country_id="' + full.id + '" data-country_name="' + full.country_name + '"  class="btn btn-primary btn-flat btn-sm showme"> <span class="glyphicon glyphicon-edit">Edit</a>';
                            }
                        },
                    ],
                    "order": [
                        [0, 'asc']
                    ]
                });
            }
        });
        $('#country-table').on('click', '.showme', function(e) {
            $('#country_id').val($(this).data('country_id'));
            $('#country_name').val($(this).data('country_name'));
            $('#modal_country').modal('show');
        });
        $('#modal_country').on('hidden.bs.modal', function() {
            location.reload();
        })

        // GET STATE

        $.ajax({
            type: 'GET',
            url: "/getState",
         
            dataType: 'json',
            success: function(data) {
                var dataSet = data.data;
                table = $('#state-table').DataTable({
                    destroy: true,
                    paging: true,
                    searching: true,
                    ordering: true,
                    bInfo: false,
                    "data": dataSet,
                    "columns": [
                        {"data": "state_name"},
                        {"data": "country_name"},
                        {
                            "data": "Link",
                            "mRender": function(data, type, full) {
                                return '<a  data-state_id="' + full.id + '" data-state_name="' + full.state_name_data + '" data-country_name="' + full.country_name + '" data-country_id="' + full.country_id + '" class="btn btn-primary btn-flat btn-sm showme-state"> <span class="glyphicon glyphicon-edit">Edit</a>';
                            }
                        },
                    ],
                    "order": [
                        [0, 'asc']
                    ]
                });
            }
        });

     

        $('#state-table').on('click', '.showme-state', function(e) {

            $('#state_id').val($(this).data('state_id'));
            $('#state_name').val($(this).data('state_name'));
            var $dpt_option = $('<option selected>'+$(this).data('country_name')+'</option>').val($(this).data('country_id')); 
            $country_name.append($dpt_option).trigger('change'); 
            $('#modal_state').modal('show');
        });


        $('#modal_state').on('hidden.bs.modal', function() {
            location.reload();
        })


    

  
      $(".onchange").change(function(){
           dataLoad();
       });


        dataLoad = function(){

              var table = $('#city-table').DataTable( {
                "destroy":    true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "/getCity",
                    "type": "GET",
                    "data":   {state_id: $("#state_id_data").val()}                
                },

                "columns": [
                            {"data": "city_name" },
                            {"data": "state_name" },
                            {"data": "country_name" },
                                                    {
                                "data": "Link",
                                "mRender": function(data, type, full) {
                                    return '<a  data-city_id="' + full.id + '" data-city_name="' + full.city_name + '"  data-state_name="' + full.state_name + '"  data-state_id="' + full.state_id + '" class="btn btn-primary btn-flat btn-sm showme-city"> <span class="glyphicon glyphicon-edit">Edit</a>';

                                }
                            }, 
                ],
                "order": [[1, 'asc']]
              });

        };




     


        $('#city-table').on('click', '.showme-city', function(e) {

            $('#city_id').val($(this).data('city_id'));
            $('#state_id').val($(this).data('state_name'));
            $('#city_name').val($(this).data('city_name'));


             var $dpt_option_state = $('<option selected>'+$(this).data('state_name')+'</option>').val($(this).data('state_id')); 
            $state_name_select.append($dpt_option_state).trigger('change'); 
            $('#modal_city').modal('show');
        });

        $('#modal_city').on('hidden.bs.modal', function() {
            location.reload();
        })

           dataLoad();

    });

// *************************************end city/country/stare data get*****************************************************

