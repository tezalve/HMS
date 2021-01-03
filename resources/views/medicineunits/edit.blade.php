@extends('layouts.master')

@section('content')

    <h2>New Unit</h2>

    <br><br>

    <form action="{{ route('medicineunits.update', $medicineunit->id) }}" method="post">
        @method('PUT')
        @php $form_type ='edit' @endphp
		@include('medicineunits/_form')
    </form>
@stop