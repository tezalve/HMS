@extends('layouts.master')
@section('content')

    <form action="{{ route('patients.update',$patient->id) }}" method="POST">
        @method('PUT')

        @php $form_type ='edit' @endphp
		@include('patients/_form')
	</form>

@stop