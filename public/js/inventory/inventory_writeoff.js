
    $(document).ready(function($) {

          $('#datepicker').datepicker({
              format: 'dd/mm/yyyy',
              autoclose: true
          });


          recieve_voucher_table = $("#recieve-voucher-table").DataTable({
              "searching": false,
              "paging": false,
              "ordering": false,
              "autoWidth": false,
              "bInfo": false,
              "footerCallback": function(row, data, start, end, display) {
                  api = this.api(), data;
              },
              drawCallback: function() {
                  var $item_info_name = $('.item_info_name').select2({
                      placeholder: 'Enter a Item Name',
                      allowClear: true,
                      ajax: {
                          dataType: 'json',
                          url: "/getItemInfo_data",
                          delay: 100,
                          data: function(params) {
                              return {
                                  term: params.term
                              }
                          },
                          processResults: function(data, params) {
                              params.page = params.page || 1;
                              return {
                                  results: data
                              };
                          },
                      }
                  });
              }
          });

          $('.vendor').select2({
              placeholder: 'Select Vendor Name',
              allowClear: true,

              ajax: {
                  dataType: 'json',
                  url: "/getVendorInfo_data",
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




          qty_info = 0;

          totalcalculat = function() {
              qty_info = 0;

              $(".qty").each(function() {
                  if (!isNaN(this.value) && this.value.length != 0) {

                      qty_info += parseFloat(this.value);

                  }
              });

              $(api.column(3).footer()).html(qty_info.toFixed(2));

          };



          totalcalculat();
          $("#recieve-voucher-table tbody tr").on('keyup', function() {
              totalcalculat();
          });


          //When add button clicked
          $('#add').click(function(event) {
          event.preventDefault();


          if (parseFloat($('#balance').val()) < parseFloat($('#qty').val())) {
              alert("insufficient balance");
              return;
          }

          var item_info_name = $("#item_info_name option:selected").text();
          var serial_number = $("#serial_number option:selected").text();
          item_id = $("#item_info_name").val();
          serial_number_id = $("#serial_number").val();
          balance = $("#balance").val();
          qty = $('#qty').val();


          if (isBlank(item_id)) {
              alert("You can't add without Item");
              return;
          }

          if (isBlank(balance) && isBlank(qty)) {
              alert("qty or price can't be blank");
              return;
          }

          var entry = [
              '<select class="form-control select2 " name="item_info_name[]" style="width: 100%;"><option value="' + item_id + '">' + item_info_name + '</option></select>',
              '<select class="form-control select2 " name="serial_number[]" style="width: 100%;"><option value="' + serial_number_id + '">' + serial_number + '</option></select>',
              '<input  type="number"  name="balance[]"    class="form-control " placeholder="balance" style="width: 100%;text-align:center;"  value="' + balance + '"   onclick="this.select();" readonly>',
              '<input  type="text"  name="quantity[]" readonly class="form-control qty"  style="width: 100%;text-align:center;"  value="' + qty + '"   onclick="this.select();" readonly>',
              '<button class="btn btn-danger btn-block delete-button btn-flat" id="' + '" style="padding: 3px 10px;">Delete</button>',
          ];

          recieve_voucher_table.row.add(entry).draw(false);

          dataLoad();
          totalcalculat();
          });



          $('#recieve-voucher-table tbody').on('click', '.delete-button', function() {
              recieve_voucher_table.row($(this).parents('tr')).remove().draw();
              totalcalculat();
          });


          dataLoad = function() {
              $('#balance').val('');
              $('#qty').val('');
              $('#item_info_name').val(null).trigger("change");
              $('#serial_number').val(null).trigger("change");
          }


          var $item_info_name = $('.item_info_name').select2({
              placeholder: 'Enter Item Info Name',
              allowClear: true,
              ajax: {
                  dataType: 'json',
                  url: "/getItemInfo_data",
                  delay: 100,
                  data: function(params) {
                      return {
                          term: params.term
                      }
                  },
                  processResults: function(data, params) {
                      params.page = params.page || 1;
                      return {
                          results: data
                      };
                  },
              }
          });

          $item_info_name.on("select2:select", function(e) {
              // $("#remarks").focus();    
          })


          $item_info_name.on("select2:unselect", function(e) {
              $('#serial_number').val(null).trigger("change");
              $("#balance").val('');
          });


          var $serial_number = $('.serial_number').select2({
              placeholder: 'Enter a Serial Number',
              width: '100%',
              allowClear: true,
              ajax: {
                  dataType: 'json',
                  url: "/get_items_by_serial",
                  delay: 100,
                  data: function(params) {
                      return {
                          term: params.term,
                          item_info_name: $("#item_info_name option:selected").val(),
                      }
                  },
                  processResults: function(data, params) {
                      params.page = params.page || 1;
                      return {
                          results: data
                      };
                  },
              }
          });

          $serial_number.on("select2:select", function(e) {
              $("#balance").val($(this).select2('data')['0']['current_stock']);
              $("#quantity").focus();
          });

          $serial_number.on("select2:unselect", function(e) {
              $("#balance").val('');
          });



          $('#frm_inventory_write_off').on('submit',(function(e) {
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
                      window.location.replace('/inventory_write_off');

                }else{
                      toastr.error(data.messages);
                      $('#btnSubmit').attr("disabled", false);
                      $("#btnSubmit").val('Submit');
                }
                   },
                
               });

        }));


        
    });