@extends('layouts.master')

@section('content')

    <h2>New Medicine</h2>

    <br><br>

    <form action="{{ route('vendors.update', $vendor->id) }}" method="post">
        @method('PUT')
        @php $form_type ='edit' @endphp
		@include('vendors/_form')
    </form>
@stop