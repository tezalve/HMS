@extends('layouts.master')

@section('content')
    <form action="{{ route('vendors.store') }}" method="post">
        @php $form_type ='create' @endphp
		@include('vendors/_form')
    </form>
@stop