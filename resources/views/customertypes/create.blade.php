@extends('layouts.master')

@section('content')
    <form action="{{ route('customertypes.store') }}" method="post">
        @php $form_type ='create' @endphp
		@include('customertypes/_form')
    </form>
@stop