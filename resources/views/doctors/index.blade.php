@extends('layouts.master')
@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>Doctor Information</h1>
            </div>
            <br><br><br>
            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="col-lg-12 entry_panel_body ">
                    <a href="{{ route('doctors.create') }}"><input type="button" id="submit" name="submit" value="New Patient Registration" class="col-lg-7 col-md-7 col-xs-7 btn btn-save btn-sm button button-save pull-left" style="background: rgb(5, 142, 27); color: aliceblue;">	</a>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Address</th>
            <th>email</th>
            <th>gender</th>
            <th>Actions</th>
        </tr>
        @foreach ($doctor as $doctor)
            <tr>
                <td>{{ $doctor->id }}</td>
                <td>{{ $doctor->name }}</td>
                <td>{{ $doctor->address }}</td>
                <td>{{ $doctor->email }}</td>
                <td>{{ $doctor->gender }}</td>
                <td>
                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST">

                        <a class="btn btn-primary" href="{{ route('doctors.show', $doctor->id ) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('doctors.edit', $doctor->id ) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-primary" title="delete">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@stop