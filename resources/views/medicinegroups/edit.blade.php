@extends('layouts.master')

@section('content')

    <h2>New Medicine</h2>

    <br><br>

    <form action="{{ route('medicinegroups.update', $medicinegroup->id) }}" method="post">
        @method('PUT')
        @php $form_type ='edit' @endphp
		@include('medicinegroups/_form')
    </form>
@stop