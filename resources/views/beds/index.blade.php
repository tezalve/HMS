@extends('layouts.master')
@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>Bed Information</h1>
            </div>
            <div class="col-lg-12 margin-tb">
                <h4><a class="" href="{{ route('beds.create') }}">Add a Bed</a></h4>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>ID</th>
            <th>Bed No</th>
            <th>Description</th>
            <th>Room Type</th>
            <th>Actions</th>
        </tr>
        @foreach ($bed as $bed)
            <tr>
                <td>{{ $bed->id }}</td>
                <td>{{ $bed->bed_no }}</td>
                <td>{{ $bed->description }}</td>
                <td>{{ $bed->bed_group_id }}</td>
                <td>
                    <form action="{{ route('beds.destroy', $bed->id) }}" method="POST">

                        <a href="{{ route('beds.show', $bed->id ) }}">Show</a>

                        <a href="{{ route('beds.edit', $bed->id ) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-primary" title="delete"></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@stop