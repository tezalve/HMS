@extends('layouts.master')

@section('content')

    <h2>Vendor Type</h2>

    <br><br>

    <form action="{{ route('vendortypes.update', $vendortype->id) }}" method="post">
        @method('PUT')
        @php $form_type ='edit' @endphp
		@include('vendortypes/_form')
    </form>
@stop