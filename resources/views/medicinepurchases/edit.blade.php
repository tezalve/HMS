@extends('layouts.master')

@section('content')

    <h2>Purchase Medicine</h2>

    <br><br>

    <form action="{{ route('medicinepurchases.update', $medicinepurchase->id) }}" method="post">
        @method('PUT')
        @php $form_type ='edit' @endphp
		@include('medicinepurchases/_form')
    </form>
@stop