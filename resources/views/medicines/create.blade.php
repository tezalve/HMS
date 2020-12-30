@extends('layouts.master')

@section('content')
    <form action="{{ route('medicines.store') }}" method="post">
        @php $form_type ='create' @endphp
		@include('medicines/_form')
    </form>
@stop