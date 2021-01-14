@extends('layouts.master')

@section('content')
    <form action="{{ route('medicinepurchases.store') }}" method="post">
        @php $form_type ='create' @endphp
		@include('medicinepurchases/_form')
    </form>
@stop