@extends('layouts.master')

@section('content')

	<legend style="background: coral; text-align: center;">Bed Information</legend>
	<form action="{{ route('beds.update',$bed->id) }}" method='POST'>
        @method('PUT')
		@php $form_type ='edit' @endphp
		@include('beds/_form')
	</form>
    
@stop