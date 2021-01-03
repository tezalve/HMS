@extends('layouts.master')

@section('content')
    <form action="{{ route('customers.store') }}" method="post">
        @php $form_type ='create' @endphp
		@include('customers/_form')
    </form>
@stop