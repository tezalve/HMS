@extends('layouts.master')

@section('content')
    <form action="{{ route('roles.store') }}" method="post">
        @php $form_type ='create' @endphp
		@include('roles/_form')
    </form>
    <!-- emo -->
@stop