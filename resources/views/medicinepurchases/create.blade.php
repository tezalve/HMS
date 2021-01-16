@extends('layouts.master')

@section('content')
    <form id="cform" action="{{ route('medicinepurchases.store') }}" method="post" onsubmit="return validateForm()">
        @php $form_type ='create' @endphp
		@include('medicinepurchases/_form')
    </form>
@stop