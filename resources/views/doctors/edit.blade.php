@extends('layouts.master')
@section('content')

    <form action="{{ route('doctors.update',$doctor->id) }}" method="POST">
        @method('PUT')
		@php $form_type = 'create' @endphp
		@include('doctors/_form')
    </form>
@stop