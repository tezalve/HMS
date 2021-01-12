@extends('layouts.master')

@section('content')
    <form action="{{ route('permissions.store') }}" method="post">
        @php $form_type ='create' @endphp
		@include('permissions/_form')
    </form>
    <!-- emo -->
@stop