@extends('layouts.master')

@section('content')

    <h2>New Medicine</h2>

    <br><br>

    <form action="{{ route('medicinegenerics.update', $medicinegeneric->id) }}" method="post">
        @method('PUT')
        @php $form_type ='edit' @endphp
		@include('medicinegenerics/_form')
    </form>
@stop