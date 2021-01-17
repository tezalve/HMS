@extends('layouts.master')

@section('content')
    <form action="{{ route('medicinepurchaseorders.store') }}" method="post">
        @php $form_type ='create' @endphp
        @include('medicinepurchaseorders/_form')
    </form>
@stop