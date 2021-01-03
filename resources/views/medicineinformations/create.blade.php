@extends('layouts.master')

@section('content')
    <form action="{{ route('medicineinformations.store') }}" method="post">
        @php $form_type ='create' @endphp
		@include('medicineinformations/_form')
    </form>
@stop