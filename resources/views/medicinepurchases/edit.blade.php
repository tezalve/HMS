@extends('layouts.master')

@section('content')

    <h2>New Medicine</h2>

    <br><br>

    <form action="{{ route('medicinepurchaseorders.update', $medicinepurchaseorder->id) }}" method="post">
        @method('PUT')
        @php $form_type ='edit' @endphp
		@include('medicinepurchaseorders/_form')
    </form>
@stop