@extends('layouts.master')

@section('content')

    <h2>Customer Type</h2>

    <br><br>

    <form action="{{ route('customertypes.update', $customertype->id) }}" method="post">
        @method('PUT')
        @php $form_type ='edit' @endphp
		@include('customertypes/_form')
    </form>
@stop