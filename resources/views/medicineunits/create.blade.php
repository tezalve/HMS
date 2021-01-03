@extends('layouts.master')

@section('content')
    <form action="{{ route('medicineunits.store') }}" method="post">
        @php $form_type ='create' @endphp
		@include('medicineunits/_form')
    </form>
@stop