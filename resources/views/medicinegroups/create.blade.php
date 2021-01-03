@extends('layouts.master')

@section('content')
    <form action="{{ route('medicinegroups.store') }}" method="post">
        @php $form_type ='create' @endphp
		@include('medicinegroups/_form')
    </form>
@stop