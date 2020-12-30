@extends('layouts.master')
@section('content')

    <form action="{{ route('doctors.store') }}" method="POST" >
		@php $form_type = 'create' @endphp
		@include('doctors/_form')
    </form>
@stop