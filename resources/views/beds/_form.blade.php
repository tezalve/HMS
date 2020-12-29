@csrf
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Investigation Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Bed Number</label>
            <input name="bedno" type="text" id="bedno" value="{{ old('bed_no',$bed->bed_no??null) }}" placeholder="Bed Number" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Investigation Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Description</label>
            <input name="description" type="text" id="description" value="{{ old('description',$bed->description??null) }}" placeholder="Bed Description" class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="floorno" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Floor Number</label>
            <select id="floorno" name="floorno" placeholder="" class="col-lg-6 entry_panel_dropdown">
                
                <option value="">Select Value</option>

                @foreach ($floor as $floor)
                    <option value="{{$floor->id}}">{{$floor->description}}</option>
                @endforeach
            
            </select>
            <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#addfloor">... </button></td>					
        </div>
    </div>	

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="bedcategory" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Bed Category</label>
            <select id="bedcategory" name="bedcategory" placeholder="" class="col-lg-6 entry_panel_dropdown">
                <option value="">Select Value</option>
                    @foreach ($bedgroup as $group)
                        <option value="{{$group->id}}">{{$group->description}}</option>
                    @endforeach
            </select>
            <td><button type="button" class="col-lg-1 entry_panel_label" data-toggle="modal" data-target="#addcategory">... </button></td>					
        </div>
    </div>	


    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 entry_panel_body ">
            <label for="Investigation Name" class="col-lg-5 col-md-5 col-xs-5 entry_panel_label">Charge Par Day</label>
            <input name="unitprice" type="text" id="unitprice" value="{{ old('charge',$bed->charge??null) }}" placeholder="Charge Par Day.." class="col-lg-7 col-md-7 col-xs-7 entry_panel_input">				
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="col-lg-12 entry_panel_body">
            <input type="submit" id="submit" name="submit" value="SAVE" class="col-lg-3 col-md-3 col-xs-3 btn btn-save btn-sm button button-save pull-right">
        </div>
    </div>

@section('scripts')
    <script type="text/javascript" language="javascript" class="init">
		$(document).ready(function() {
			var table = $('#example').dataTable({
				bInfo: false,	
				ordering:       false,
				// scrollY:        "300px",
				// scrollX:        true,
				// scrollCollapse: false,
				// paging:         true,
				// searching:      true,

				  "ajax": "{{URL::to('/')}}/bed/create",
				    "columns": [
					      { "data": "bed_no" },
					      { "data": "bed_description" },
					      { "data": "floor" },
					      { "data": "bed_group" },
					      { "data": "charge" },
					      { "data": "Link",
						      "mRender": function (data, type, full) {
						        return '<a href="{{URL::to('/')}}/bed/'+full.id+'/edit"     class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="right" title="Edit" style="width: 100%; text-align: center;"></a>';
						      }
					      }				      				      
				    	],
				"order": [[1, 'asc']]

			});
			// $('#name').keyup(function(){
		 //     	table.fnFilter( $(this).val() );
			// })
		});
	</script>

    <script src="/js/jquery-ui.js"></script>

    <div class="modal fade" id="addfloor" tabindex="-1" role="dialog" aria-labelledby="catAddLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 380px;">
            <div class="modal-content">
                <form action="{{ route('floors.store') }}" method="post" id="addflooor">
                    <div class="modal-header" style="background: coral; padding: 10px;">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="catAddLabel">Add New Floor</h4>
                    </div>

                    <div class="modal-body">
                        <table style="width: 350px;">
							<tr>
								<td>
									<input name="new_floorname" type="text" id="new_floorname" placeholder="Floor name" class="col-lg-12 col-md-12 col-xs-12" style="height: 30px;">
								</td>
							</tr>      		
						</table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" name="category_save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="catAddLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 420px;">
            <div class="modal-content">
                <form action="{{ route('bedgroups.store') }}" method="post" id="addgroup">
                    <div class="modal-header" style="background: coral; padding: 10px;">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="catAddLabel">Add New Category</h4>
                    </div>

                    <div class="modal-body">
                        <table style="width: 385px;">
							<tr>
								<td>
									<input name="new_category_name" type="text" id="new_category_name" placeholder="New Category" class="col-lg-12 col-md-12 col-xs-12" style="height: 30px;">
								</td>
							</tr>      		
						</table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="width: 140px; background: rgb(9, 173, 61); height:30px;" name="category_save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript">

        $( "#addflooor" ).submit(function( event ) {
        // Stop form from submitting normally
            event.preventDefault();
            // Get some values from elements on the page:
            var $form   = $( this ),
            term        = $form.find( "input[name='new_floorname']" ).val(),
            url         = $form.attr( "action" ); 
            // Send the data using post
            var posting = $.post( url, { new_floorname: term } );

            // Put the results in a div
            posting.done(function( data ) {
                $('#addflooor').trigger("reset");
                $('#addfloor').modal('hide');

                //Reload the options of dropdown list using ajax.
                $.ajax({
                    // type: "POST",
                    url: "{{URL::to('/')}}/floors/show",
                    dataType: "json",
                    success: function(data){
                        $('#floorno').empty();
                        console.log(data);
                        var opts = data;
                        // Use jQuery's each to iterate over the opts value
                        $('#floorno').append('<option value="">Select</option>');
                        $.each(opts, function(i, d) {
                        // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                        $('#floorno').append('<option value="' + d.id + '">' + d.description + '</option>');
                        });
                    }
                })

            });
        });


        $( "#addgroup" ).submit(function( event ) {
        // Stop form from submitting normally
            event.preventDefault();
            // Get some values from elements on the page:
            var $form   = $( this ),
            term        = $form.find( "input[name='new_category_name']" ).val(),
            url         = $form.attr( "action" ); 
            // Send the data using post
            var posting = $.post( url, { new_category_name: term } );

            // Put the results in a div
            posting.done(function( data ) {
                $('#addgroup').trigger("reset");
                $('#addcategory').modal('hide');

                //Reload the options of dropdown list using ajax.
                $.ajax({
                    // type: "POST",
                    url: "{{URL::to('/')}}/bedgroups/show",
                    dataType: "json",
                    success: function(data){
                        $('#bedcategory').empty();
                        console.log(data);
                        var opts = data;
                        // Use jQuery's each to iterate over the opts value
                        $('#bedcategory').append('<option value="">Select</option>');
                        $.each(opts, function(i, d) {
                        // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                        $('#bedcategory').append('<option value="' + d.id + '">' + d.description + '</option>');
                        });
                    }
                })

            });
        });

    </script>


    <script>
        $( "#tabs" ).tabs();
        // Hover states on the static widgets
        $( "#dialog-link, #icons li" ).hover(
            function() {
                $( this ).addClass( "ui-state-hover" );
            },
            function() {
                $( this ).removeClass( "ui-state-hover" );
            }
        );


        $(function () {
        // validate signup form on keyup and submit
            $("#createbedinfo").validate({
                rules: {
                    bedno: "required",
                    bedno: {
                        required: true,
                    },
                    description: {
                        required: true
                    },
                    floorno: {
                        required: true
                    },
                    bedcategory: {
                        required: true
                    },								
                    unitprice: {
                        required: true,
                        number: true
                    },				
                },
                tooltip_options: {
                    bedno: {trigger:'focus'},
                },
                messages: {
                    bedno: "Please enter Bed No",
                    description: {
                        required: "Please enter a Description",
                    },
                    unitprice: {
                        required: "Please enter Charge Par Day",
                    },
                }
                
            });
        });
    </script>
@stop    