@extends('layouts.master')

@section('content')

	<legend style="background: coral; text-align: center;">Bed Information</legend>
	<form action="{{ route('beds.store') }}" method='POST'>
		@php $form_type ='create' @endphp
		@include('beds/_form')
	</form>
@stop