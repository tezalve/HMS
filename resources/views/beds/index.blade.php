@extends('layouts.master')
@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>Bed Information</h1>
            </div>
            <br><br><br>
            <div class="col-lg-4 col-md-4 col-xs-12 pull-left">
                <div class="col-lg-12 entry_panel_body ">
                    <a href="{{ route('beds.create') }}"><input type="button" id="submit" name="submit" value="New Patient Registration" class="col-lg-7 col-md-7 col-xs-7 btn btn-save btn-sm button button-save pull-left" style="background: rgb(5, 142, 27); color: aliceblue;">	</a>
                </div>
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

                        <a class="btn btn-primary" href="{{ route('beds.show', $bed->id ) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('beds.edit', $bed->id ) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-primary" title="delete">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@stop