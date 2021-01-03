@extends('layouts.master')

@section('content')

    <h2>New Medicine</h2>

    <br><br>

    <form action="{{ route('medicineinformations.update', $medicineinformation->id) }}" method="post">
        @method('PUT')
        @php $form_type ='edit' @endphp
		@include('medicineinformations/_form')
    </form>
@stop