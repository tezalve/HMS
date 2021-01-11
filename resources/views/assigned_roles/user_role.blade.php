    @extends('layouts.master')
    @section('includes')
    <!-- DataTables -->
     <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
    @stop        
    @section('content')
      <!-- SELECT2 EXAMPLE -->
          <legend>Roles Assign List</legend>
        <!-- /.box-header -->
        
        <form id="role-form">
        @csrf
            <!-- /.box-header -->
            <!-- <div class="box-body no-padding"> -->
            <div class="col-xs-12" style="padding: 10px;">            
              <!-- <table class="table table-striped" id="role_list"> -->
              <table id="role_list" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Users</th>
                    <th>Role</th>
                    <!-- <th>Edit</th> -->
                  </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                
                <tr>
                  <td><input value="{{$user->users_id}}" class="hidden">{{$user->username}}</td>
                  <td>
                    {{$user->name}}
                  </td>
                  <!-- <td><a href="{{URL::to('/')}}/permission/{{$user->users_id}}/user_role">
                  <span class="glyphicon glyphicon-edit"></span>
                  Edit</a></td> -->
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->

      </form>
      </div>
@endsection

  @section('scripts')
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>    
  <script>
    $(document).ready(function() {
      var table = $('#role_list').DataTable( {
              destroy:    true,
              paging:     true,
              searching:  true,
              ordering:   false,
              bInfo:      true,         
      });      
    });      
  </script>

@endsection


