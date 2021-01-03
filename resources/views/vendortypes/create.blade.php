@extends('layouts.master')

@section('content')
    <form action="{{ route('vendortypes.store') }}" method="post">
        @php $form_type ='create' @endphp
		@include('vendortypes/_form')
    </form>
@stop