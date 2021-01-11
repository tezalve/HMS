@extends('layouts.master')

@section('content')

    <h2>New Unit</h2>

    <br><br>

    <form action="{{ route('roles.update', $role->id) }}" method="post">
        @method('PUT')
        @php $form_type ='edit' @endphp
		@include('roles/_form')
    </form>
@stop