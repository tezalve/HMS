@extends('layouts.mister')
@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>Doctor Information</h1>
            </div>
            <div class="">
                <a class="" href="{{ route('doctors.create') }}">Add a Doctor</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif

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

                        <a href="{{ route('doctors.show', $doctor->id ) }}">Show</a>

                        <a href="{{ route('doctors.edit', $doctor->id ) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-primary" title="delete"></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@stop