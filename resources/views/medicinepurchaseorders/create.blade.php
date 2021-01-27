@extends('layouts.master')

@section('content')
    <legend>Medicine Order</legend>
    <form action="{{ route('medicinepurchaseorders.store') }}" method="post">
        @php $form_type ='create' @endphp
        @include('medicinepurchaseorders/_form')
    </form>
@stop