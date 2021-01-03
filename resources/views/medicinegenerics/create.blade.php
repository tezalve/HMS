@extends('layouts.master')

@section('content')
    <form action="{{ route('medicinegenerics.store') }}" method="post">
        @php $form_type ='create' @endphp
		@include('medicinegenerics/_form')
    </form>
@stop