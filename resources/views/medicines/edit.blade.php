@extends('layouts.master')

@section('content')

    <h2>New Medicine</h2>

    <br><br>

    <form action="{{ route('medicines.update', $medicine->id) }}" method="post">
        @method('PUT')
        @php $form_type ='edit' @endphp
		@include('medicines/_form')
    </form>
@stop