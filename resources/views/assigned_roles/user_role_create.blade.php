  @extends('layouts.master')
  @section('includes')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker-bs3.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/plugins/iCheck/all.css')}}">
  @endsection
  @section('content')
        	<legend>User Role assigned page</legend>

      		<div class="box-tools pull-right">
        		<a type="button" href="{{ URL::previous() }}" class="btn btn-box-tool"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
     		</div>
      <!-- /.box-header -->

      <form action="{{url('add_user_role')}}" method="post" onkeypress="return event.keyCode != 13;", id="user_role_frm_data">
    	@csrf
			<div class="row">
          		<h2>User info</h2>
          		<div class="col-md-10">
            		<div class="col-md-4">
              			<div class="form-group">
                			<label>User Id</label>
                			<input type="number" id="user-id" name="users_id" class="form-control"placeholder="{{$user->id}}" value="{{$user->id}}" readonly>
              			</div>
            		</div>

            		<div class="col-md-4">
              			<div class="form-group">
                			<label>User Name</label>
                			<input type="text" id="user-name"name="user_name" class="form-control"placeholder="{{$user->name}}"  value="{{$user->name}}" readonly>
              			</div>
            		</div>

            		<div class="col-md-4" >
              			<div class="form-group">
                		<label>User Email Address</label>
                		<input type="email" id="email"name="email" class="form-control"placeholder="{{$user->email}}" value="{{$user->email}}" readonly>
              		</div>
            	</div>
        	</div>
        

            <div class="box-body">
              	<h3>Assign Roles</h3>
              	<div class="box box-success">
                	<div class="box-header">
                		<h3 class="box-title">Check</h3>
              		</div>
              		<div class="box-body">
                <!-- Minimal style -->

                <!-- checkbox -->
                		<div class="form-group">
                 			<ul>
                  
                  				@foreach($roles as $role)
                   		 			@if($role->role_name!=null)
                    					<li>
                      						<label>

												@if(isset($role) AND $role->roles_id == $role->assigned_roles_id)
													<input type="checkbox" class="" value="{{$role->roles_id}}" name="role[{{$role->roles_id}}]" checked>
													{{$role->role_name}}
												@else
													<input type="checkbox" class="" value="{{$role->roles_id}}" name="role[{{$role->roles_id}}]" >
													{{$role->role_name}}
												@endif 

                      						</label>
										</li> 
									@endif  
								@endforeach
                  			</ul>
                		</div>
              
                    	<!-- ./col -->
                		<input type="submit" class="btn btn-success btn-flat pull-right" value="Submit" id="btnSubmit">
      	</form>

      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif



      @endsection



      @section('scripts')
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
      <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
      <script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
      <script src="{{asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
      <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
      <script src="{{asset('dist/js/utils.js')}}"></script>

      <script type="text/javascript">
      $( document ).ready(function() {

       
        //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

});
  </script>


  <script type="text/javascript">
    // ***************from submit script**************************

  $( "#user_role_frm_data" ).submit(function(event){
    event.preventDefault();

      $("#btnSubmit").attr("disabled", true);
      $("#btnSubmit").val('Please wait..');
      var $form   = $( this ),
      url         = $form.attr( "action" );
      token = $("[name='_token']").val();
      $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : url, // the url where we want to POST
        data : $form.serialize(),
        dataType    : 'json', // what type of data do we expect back from the server
        encode      : true,
        _token : token
      })
      .done(function(data) {  
        if(data['success']) {
        // window.open('{{URL::to('/')}}/journal_voucher/'+(data.master_id), '_blank');
        
        // data['messages'];
        // var erreurs ='<div class="alert alert-success"><ul>';
        // erreurs += '<li>'+data.messages+'</li>';
        // erreurs += '</ul></div>';
        // $('#alert-success1').html(erreurs);  
        // $('#alert-success1').show(0).delay(4000).hide(0);
                
        $('#btnSubmit').attr("disabled", false);
        $("#btnSubmit").val('Submit');
          url="javascript:window.history.go(-1);";
        //window.location.replace(url+toastr.success(data.messages));
          url="javascript:window.history.go(-1);";
        toastr.success(data.messages)
      //  var audio = new Audio('http://localhost/info/accounts/public/audio/audio_file.mp3');
               // audio.play();
             
      window.location.replace("{{ URL::to('assigned_roles')}}");
       
      

      }else{
                  
                toastr.error(data.messages);
              //  var audio = new Audio('http://localhost/info/accounts/public/audio/audio_file1.mp3');
             //   audio.play();
        // var erreurs ='<div class="alert alert-danger"><ul>';
        // erreurs += '<li>'+data.messages+'</li>';
        // erreurs += '</ul></div>';
        // $('#alert-danger1').html(erreurs);  
        // $('#alert-danger1').show(0).delay(8000).hide(0);
        
        $('#btnSubmit').attr("disabled", false);
        $("#btnSubmit").val('Submit');


  }
    });
           
  });

  </script>



  @endsection


