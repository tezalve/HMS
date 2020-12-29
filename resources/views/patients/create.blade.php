@extends('layouts.master')
@section('content')
    <legend style="background: coral;">New Patient Registration</legend>

    <form action="{{ route('patients.store') }}" method="POST">
		@php $form_type ='create' @endphp
		@include('patients/_form')
	</form>
@stop