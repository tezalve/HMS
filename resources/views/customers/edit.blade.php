@extends('layouts.master')

@section('content')

    <h2>New Medicine</h2>

    <br><br>

    <form action="{{ route('customers.update', $customer->id) }}" method="post">
        @method('PUT')
        @php $form_type ='edit' @endphp
		@include('customers/_form')
    </form>
@stop